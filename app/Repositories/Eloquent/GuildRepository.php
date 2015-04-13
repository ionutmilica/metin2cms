<?php namespace Metin2CMS\Repositories\Eloquent;

use Illuminate\Support\Facades\DB;
use Metin2CMS\Entities\Guild;
use Metin2CMS\Repositories\GuildRepositoryInterface;

class GuildRepository extends AbstractRepository implements GuildRepositoryInterface {

    /**
     * @param Guild $model
     */
    public function __construct(Guild $model)
    {
        $this->model = $model;
    }

    /**
     * Create a new guild
     *
     * @param array $data
     * @return array
     */
    public function create(array $data)
    {
        $guild = $this->getNew();
        $guild->name = $data['name'];
        $guild->master = $data['owner'];
        $guild->level = $data['level'];
        $guild->save();

        return $this->toArray($guild);
    }

    /**
     * Find guild by owner
     *
     * @param $owner
     * @return mixed
     */
    public function findByOwner($owner)
    {
        return $this->toArray($this->model->where('master', $owner)->first());
    }

    /**
     * Get players for page $page with a given number of players per page
     *
     * @param $page
     * @param int $perPage
     * @return mixed
     */
    public function highscore($page, $perPage = 10)
    {
        $query = DB::connection('player')->table('guild');
        $query->select(array(
            'guild.id',
            'player.name as master_name',
            'guild.master',
            'player_index.empire',
            'guild.name as guild_name',
            'guild.win',
            'ladder_point',
            'guild.level'
        ));
        $query->whereNull('gmlist.mAuthority');
        $query->orWhere('gmlist.mAuthority', 'LOW_WIZARD');
        $query->orderBy('guild.ladder_point', 'DESC');
        $query->orderBy('guild.win', 'DESC');

        // Generates the final query
        $query = $this->guildQuery($query);

        return $query->paginate($perPage);
    }

    /**
     * Generatesx the whole sql
     *
     * @param $query
     * @return mixed
     */
    public function guildQuery($query)
    {
        DB::connection('player')->statement("SET @rank:=0");

        $query->leftJoin('player', 'guild.master', '=', 'player.id');
        $query->leftJoin('player_index', 'player_index.id', '=', 'player.account_id');
        $query->leftJoin('common.gmlist', 'gmlist.mName', '=', 'player.name');

        $sql = '('.$query->toSql().') as x';
        $sql = str_replace(array('%', '?'), array('"%%"', '"%s"'), $sql);
        $sql = vsprintf($sql, $query->getBindings());

        $query = DB::connection('player')->table('guild');
        $query->select(array(
            '*',
            DB::raw('@rank := @rank + 1 as rank')
        ));
        $query->from(DB::raw($sql));

        return $query;
    }
}
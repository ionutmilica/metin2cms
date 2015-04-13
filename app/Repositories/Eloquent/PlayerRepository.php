<?php namespace Metin2CMS\Repositories\Eloquent;

use Illuminate\Support\Facades\DB;
use Metin2CMS\Entities\Player;
use Metin2CMS\Repositories\PlayerRepositoryInterface;

class PlayerRepository extends AbstractRepository implements PlayerRepositoryInterface {

    /**
     * @param Player $model
     */
    public function __construct(Player $model)
    {
        $this->model = $model;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all()
    {
        return $this->toArray($this->model->all());
    }

    /**
     * Find player by name
     *
     * @param $name
     * @return bool
     */
    public function findByName($name)
    {
        return $this->toArray($this->model->where('name', $name)->first());
    }

    /**
     * Search for players
     *
     * @param int $perPage
     * @param array $data
     * @return mixed
     */
    public function search($perPage = 10, array $data)
    {
        $query = DB::connection('player')->table('player');
        $query->select(array(
            'player.id', 'name', 'status', 'ip', 'level', 'exp', 'gold', 'account_id',
            'account.login as account_name',
            'empire', 'gmlist.mAuthority as perm'
        ));

        if (isset($data['name']))
        {
            $escape = DB::connection('player')->getPdo()->quote('%'.$data['name'].'%');
            $query->whereRaw('player.name LIKE ' . $escape);
        }

        if (isset($data['ip']))
        {
            $query->where('player.ip', $data['ip']);
        }

        if (isset($data['account_id']))
        {
            $query->where('account.id', $data['account_id']);
        }

        $query = $this->playerQuery($query);

        return $query->paginate($perPage);
    }

    /**
     * Get players for page $page with a given number of players per page
     *
     * @param int $perPage
     * @return mixed
     */
    public function highScore($perPage = 10)
    {
        $query = DB::connection('player')->table('player');
        $query->select(array(
            'player.id', 'name', 'gold', 'level', 'exp', 'account_id',
            'account.login as account_name',
            'empire', 'gmlist.mAuthority as perm'
        ));
        $query->where('account.status', '!=', 'BLOCK');
        $query->whereNull('gmlist.mAuthority');
        $query->orWhere('gmlist.mAuthority', 'LOW_WIZARD');
        $query->orderBy('player.level', 'DESC');
        $query->orderBy('player.exp', 'DESC');

        // Generates the final query
        $query = $this->playerQuery($query);

        return $query->paginate($perPage);
    }

    /**
     * Generate a big sql from query builder. Useful when we paginate and search by fields
     *
     * @param $query
     * @return mixed
     */
    protected function playerQuery($query)
    {
        DB::connection('player')->statement("SET @rank:=0");

        $query->leftJoin('player_index', 'player_index.id', '=', 'player.account_id');
        $query->join('account.account', 'account.id', '=', 'player.account_id');
        $query->leftJoin('common.gmlist', 'gmlist.mName', '=', 'player.name');

        $sql = '('.$query->toSql().') as x';
        $sql = str_replace(array('%', '?'), array('%%', '"%s"'), $sql);
        $sql = vsprintf($sql, $query->getBindings());

        $query = DB::connection('player')->table('player');
        $query->select(array(
            '*',
            DB::raw('@rank := @rank + 1 as rank')
        ));
        $query->from(DB::raw($sql));

        return $query;
    }
}
<?php namespace Metin2CMS\Core\Repositories\Eloquent;

use Metin2CMS\Core\Entities\Guild;
use Metin2CMS\Core\Repositories\GuildRepositoryInterface;

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
     * @return mixed
     */
    public function countAll()
    {
        return $this->model->count();
    }
    /**
     * Get players for page $page with a given number of players per page
     *
     * @param $page
     * @param int $perPage
     * @return mixed
     */
    public function highScoreForPage($page, $perPage = 10)
    {
        $limitStart = ($page - 1) * $perPage;
        $limitEnd   = $perPage;

        $query = $this->getHighScoreQuery($limitStart.','.$limitEnd);

        return $this->toArray($this->model->hydrateRaw($query));
    }

    /**
     * Generate a query for a specified limit
     *
     * @param int $limit
     * @return string
     */
    public function getHighScoreQuery($limit = 100)
    {
        return "SELECT id, name as guild_name, level, win, ladder_point, master_name, master, empire, rang
        FROM (
            SELECT id, name, level, win, ladder_point, master_name, master, empire, @num := @num +1 AS rang
            FROM (
                SELECT player.id, player.name as master_name, guild.name, guild.level, guild.win, guild.ladder_point, guild.master, player_index.empire, @num :=0
                FROM player.guild
                LEFT JOIN player.player ON guild.master = player.id
                LEFT JOIN player.player_index ON player_index.id = player.account_id
                WHERE player.name NOT LIKE '[%]%'
                ORDER BY guild.ladder_point DESC , guild.level DESC
            ) AS t1
        ) AS t2
        LIMIT $limit";
    }
}
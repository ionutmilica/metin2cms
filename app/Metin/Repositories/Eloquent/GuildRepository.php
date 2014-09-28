<?php namespace Metin\Repositories\Eloquent;

use Metin\Entities\Guild;
use Metin\Repositories\GuildRepositoryInterface;

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
        return "SELECT
        guild.name as guild_name, guild.level, guild.win, guild.ladder_point, player_index.empire as empire
        FROM player.guild
        LEFT JOIN player.player ON guild.master = player.id
        LEFT JOIN player.player_index ON player_index.id = player.account_id
        WHERE player.name NOT LIKE '[%]%'
        ORDER BY guild.ladder_point DESC LIMIT ".$limit;
    }
}
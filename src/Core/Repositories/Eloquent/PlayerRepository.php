<?php namespace Metin2CMS\Core\Repositories\Eloquent;

use Metin2CMS\Core\Entities\Player;
use Metin2CMS\Core\Repositories\PlayerRepositoryInterface;

class PlayerRepository extends AbstractRepository implements PlayerRepositoryInterface {

    /**
     * @param Player $model
     */
    public function __construct(Player $model)
    {
        $this->model = $model;
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
    protected function getHighScoreQuery($limit = 100)
    {
        return "SELECT player.id, player.name, player.level, player_index.empire
                        FROM player.player
                        LEFT JOIN player.player_index ON player_index.id = player.account_id
                        LEFT JOIN player.guild_member ON guild_member.pid = player.id
                        INNER JOIN account.account
                        ON account.id = player.account_id
                        WHERE player.name NOT LIKE '[%]%' AND account.status != 'BLOCK'
                    ORDER BY player.level DESC, player.exp DESC LIMIT ".$limit;
    }
}
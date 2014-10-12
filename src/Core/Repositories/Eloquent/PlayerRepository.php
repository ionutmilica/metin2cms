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

    public function countAll()
    {
        return $this->model->count();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all()
    {
        return $this->toArray($this->model->all());
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
        return "SELECT id, name, level, exp, empire, job, rang
                FROM (
                    SELECT id, name, level, exp, empire, job, @num := @num +1 AS rang
                    FROM (
                        SELECT player.id, player.name, player.level, player.exp, player_index.empire, player.job, @num :=0
                        FROM player.player
                        LEFT JOIN player.player_index ON player_index.id = player.account_id
                        INNER JOIN account.account ON account.id=player.account_id
                        WHERE player.name NOT LIKE '[%]%' AND account.status != 'BLOCK'
                        ORDER BY player.level DESC , player.exp DESC
                    ) AS t1
                ) AS t2
                LIMIT $limit";
    }
}
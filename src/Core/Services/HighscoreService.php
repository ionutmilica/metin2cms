<?php namespace Metin2CMS\Core\Services;

use Illuminate\Foundation\Application;
use Metin2CMS\Core\Repositories\GuildRepositoryInterface;
use Metin2CMS\Core\Repositories\PlayerRepositoryInterface;

class HighscoreService {

    /**
     * @var \Metin2CMS\Core\Repositories\PlayerRepositoryInterface
     */
    private $player;
    /**
     * @var \Metin2CMS\Core\Repositories\GuildRepositoryInterface
     */
    private $guild;
    /**
     * @var \Illuminate\Foundation\Application
     */
    private $app;

    /**
     * @param Application $app
     * @param PlayerRepositoryInterface $player
     * @param GuildRepositoryInterface $guild
     */
    public function __construct(Application $app, PlayerRepositoryInterface $player, GuildRepositoryInterface $guild)
    {
        $this->player = $player;
        $this->guild = $guild;
        $this->app = $app;
    }

    /**
     * Get players mini top
     *
     * @param int $perPage
     * @param int $page
     * @internal param int $page
     * @return array
     */
    public function players($perPage = null, $page = null)
    {
        if ($page == null && $perPage == null)
        {
            return $this->player->highscoreForPage(1, 10);
        }

        $this->normalizePagination($page, $perPage);

        $items = $this->player->highscoreForPage($page, $perPage);

        $paginator = $this->app['paginator']->make($items, $this->player->countAll(), $perPage);

        return $paginator->toArray();
    }

    /**
     * Get guilds mini top
     *
     * @param int $page
     * @param int $perPage
     * @return array
     */
    public function guilds($perPage = null, $page = null)
    {
        if ($page == null && $perPage == null)
        {
            return $this->guild->highscoreForPage(1, 10);
        }

        $this->normalizePagination($page, $perPage);

        $items = $this->guild->highscoreForPage($page, $perPage);

        $paginator = $this->app['paginator']->make($items, $this->guild->countAll(), $perPage);

        return $paginator->toArray();
    }

    /**
     * @param $perPage
     * @param $page
     */
    protected function normalizePagination(&$page, &$perPage)
    {
        if ($perPage < 1 || $perPage > 20) $perPage = 10;
        if ($page < 1) $page = 1;
    }
}
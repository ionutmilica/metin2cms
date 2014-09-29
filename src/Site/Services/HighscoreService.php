<?php namespace Metin2CMS\Site\Services;

use Metin2CMS\Site\Repositories\GuildRepositoryInterface;
use Metin2CMS\Site\Repositories\PlayerRepositoryInterface;

class HighscoreService {

    /**
     * @var \Metin2CMS\Site\Repositories\PlayerRepositoryInterface
     */
    private $player;
    /**
     * @var \Metin2CMS\Site\Repositories\GuildRepositoryInterface
     */
    private $guild;

    public function __construct(PlayerRepositoryInterface $player, GuildRepositoryInterface $guild)
    {
        $this->player = $player;
        $this->guild = $guild;
    }

    public function playersTopMini()
    {
        return $this->player->highscoreForPage(1, 10);
    }

    public function guildsTopMini()
    {
        return $this->guild->highscoreForPage(1, 10);
    }
}
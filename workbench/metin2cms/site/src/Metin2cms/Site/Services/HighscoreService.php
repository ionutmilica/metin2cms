<?php namespace Metin2cms\Site\Services;

use Metin2cms\Site\Repositories\GuildRepositoryInterface;
use Metin2cms\Site\Repositories\PlayerRepositoryInterface;

class HighscoreService {

    /**
     * @var \Metin2cms\Site\Repositories\PlayerRepositoryInterface
     */
    private $player;
    /**
     * @var \Metin2cms\Site\Repositories\GuildRepositoryInterface
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
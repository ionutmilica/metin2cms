<?php namespace Metin\Services;

use Metin\Repositories\GuildRepositoryInterface;
use Metin\Repositories\PlayerRepositoryInterface;

class HighscoreService {

    /**
     * @var \Metin\Repositories\PlayerRepositoryInterface
     */
    private $player;
    /**
     * @var \Metin\Repositories\GuildRepositoryInterface
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
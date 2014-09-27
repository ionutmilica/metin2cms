<?php namespace Metin\Services;

use Metin\Repositories\PlayerRepositoryInterface;

class HighscoreService {

    /**
     * @var \Metin\Repositories\PlayerRepositoryInterface
     */
    private $player;

    public function __construct(PlayerRepositoryInterface $player)
    {
        $this->player = $player;
    }

    public function playersTopMini()
    {
        return $this->player->highscoreForPage(1, 10);
    }

    public function guildsTopMini()
    {

    }
}
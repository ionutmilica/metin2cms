<?php namespace Metin2CMS\Core\Services;

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

    public function __construct(PlayerRepositoryInterface $player, GuildRepositoryInterface $guild)
    {
        $this->player = $player;
        $this->guild = $guild;
    }

    /**
     * Get players mini top
     *
     * @return array
     */
    public function playersTopMini()
    {
        return $this->player->highscoreForPage(1, 10);
    }

    /**
     * Get guilds mini top
     *
     * @return array
     */
    public function guildsTopMini()
    {
        return $this->guild->highscoreForPage(1, 10);
    }
}
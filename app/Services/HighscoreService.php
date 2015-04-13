<?php namespace Metin2CMS\Services;

use Metin2CMS\Repositories\GuildRepositoryInterface;
use Metin2CMS\Repositories\PlayerRepositoryInterface;

class HighscoreService {

    /**
     * @var \Metin2CMS\Repositories\PlayerRepositoryInterface
     */
    private $player;
    /**
     * @var \Metin2CMS\Repositories\GuildRepositoryInterface
     */
    private $guild;

    /**
     * @param PlayerRepositoryInterface $player
     * @param GuildRepositoryInterface $guild
     */
    public function __construct(PlayerRepositoryInterface $player, GuildRepositoryInterface $guild)
    {
        $this->player = $player;
        $this->guild = $guild;
    }

    public function players($perPage = 10)
    {
        return $this->player->highscore($perPage);
    }

    /**
     * Get guilds mini top
     *
     * @param int $perPage
     * @return array
     */
    public function guilds($perPage = 10)
    {
        return $this->guild->highscore($perPage);
    }
}
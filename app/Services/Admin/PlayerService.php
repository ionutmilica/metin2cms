<?php namespace Metin2CMS\Services\Admin;

use Metin2CMS\Repositories\PlayerRepositoryInterface;

class PlayerService {

    private $player;

    public function __construct(PlayerRepositoryInterface $player)
    {
        $this->player  = $player;
    }

    /**
     * Get all staff members
     *
     * @param array $data
     * @param int $perPage
     * @return mixed
     */
    public function search(array $data = array(), $perPage = 10)
    {
        return $this->player->search($perPage, $data);
    }
}
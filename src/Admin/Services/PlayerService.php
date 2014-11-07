<?php namespace Metin2CMS\Admin\Services;

use Metin2CMS\Core\Repositories\PlayerRepositoryInterface;

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
     * @return mixed
     */
    public function search(array $data = array(), $perPage = 10)
    {
        return $this->player->search($perPage, $data);
    }
}
<?php namespace Metin2CMS\Services\Admin;

use Metin2CMS\Repositories\StaffRepositoryInterface;
use Metin2CMS\Repositories\AccountRepositoryInterface;
use Metin2CMS\Repositories\PlayerRepositoryInterface;
use Metin2CMS\Admin\Exceptions\CreateFailedException;

class StaffService {
    /**
     * @var StaffRepositoryInterface
     */
    private $staff;

    /**
     * @var AccountRepositoryInterfac
     */
    private $account;

    /**
     * @var PlayerRepositoryInterface
     */
    private $player;

    /**
     * @param StaffRepositoryInterface $staff
     * @param AccountRepositoryInterface $account
     * @param PlayerRepositoryInterface $player
     */
    public function __construct(StaffRepositoryInterface $staff, AccountRepositoryInterface $account, PlayerRepositoryInterface $player)
    {
        $this->staff   = $staff;
        $this->account = $account;
        $this->player  = $player;
    }

    /**
     * Get all staff members
     *
     * @param array $data
     * @return mixed
     */
    public function search(array $data)
    {
        return $this->staff->all();
    }

    /**
     * Delete staff member
     *
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        $staff = $this->staff->findById($id);

        if ( ! $staff)
        {
            return false;
        }

        return $this->staff->delete($id);
    }

    /**
     * Create a staff member
     *
     * @param array $data
     * @return bool
     * @throws CreateFailedException
     */
    public function create(array $data)
    {
        $account = $this->account->findByName($data['account']);

        if ( ! $account)
        {
            throw new CreateFailedException('This account does not exist!');
        }

        $player  = $this->player->findByName($data['player']);

        if ( ! $player)
        {
            throw new CreateFailedException('This player does not exist!');
        }

        return (bool) $this->staff->create($data);
    }
}
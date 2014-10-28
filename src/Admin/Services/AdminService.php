<?php namespace Metin2CMS\Admin\Services;

use Metin2CMS\Admin\Exceptions\LowPermissionException;
use Metin2CMS\Core\Repositories\AccountRepositoryInterface;

class AdminService {
    /**
     * @var AccountRepositoryInterface
     */
    private $account;

    /**
     * @param AccountRepositoryInterface $account
     */
    public function __construct(AccountRepositoryInterface $account)
    {
        $this->account = $account;
    }


    /**
     * Search in accounts
     *
     * @param array $data
     * @return mixed
     */
    public function search(array $data)
    {
        return $this->account->search($data);
    }

    /**
     * Get account information
     *
     * @param $id
     * @return mixed
     */
    public function getAccountData($id)
    {
        return $this->account->findById($id);
    }

    /**
     * Edit user account
     *
     * @param $id
     * @param array $data
     * @return bool
     */
    public function editAccount($id, array $data)
    {
        return (bool) $this->account->update(array('id' => $id), array(
            'login' => $data['username'],
            'email' => $data['email']
        ));
    }

    /**
     * Block an account
     *
     * @param $id
     * @param array $data
     * @throws LowPermissionException
     * @return bool
     */
    public function blockAccount($id, array $data)
    {
        $until = $data['expiration'];

        $account = $this->account->findById($id);

        if ($account['type'] == 9/** Admin */)
        {
            throw new LowPermissionException('You cannot block this account.', 'admin.account.block');
        }

        return (bool) $this->account->update(array('id' => $id), array(
            'status'  => 'BLOCK',
            'availDt' => $until,
        ));
    }
}
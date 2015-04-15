<?php namespace Metin2CMS\Services\Admin;

use Illuminate\Foundation\Application;
use Metin2CMS\Exceptions\Admin\LowPermissionException;
use Metin2CMS\Repositories\AccountRepositoryInterface;
use Metin2CMS\Repositories\HistoryRepositoryInterface;

class AdminService {
    /**
     * @var AccountRepositoryInterface
     */
    private $account;
    /**
     * @var HistoryRepositoryInterface
     */
    private $history;
    /**
     * @var
     */
    private $app;

    /**
     * @param Application $app
     * @param AccountRepositoryInterface $account
     * @param HistoryRepositoryInterface $history
     */
    public function __construct(Application $app, AccountRepositoryInterface $account, HistoryRepositoryInterface $history)
    {
        $this->app = $app;
        $this->account = $account;
        $this->history = $history;
    }


    /**
     * Search in accounts
     *
     * @param int $perPage
     * @param array $data
     * @return mixed
     */
    public function search(array $data = array(), $perPage = 10)
    {
        return $this->account->search($data, $perPage);
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
     * @return bool
     * @throws LowPermissionException
     */
    public function blockAccount($id, array $data)
    {
        $account = $this->account->findById($id);

        if ($account['type'] == 9/** Admin, @todo: Reduce hardcoding */)
        {
            throw new LowPermissionException('You cannot block this account.', '');
        }

        $data['account'] = $id;

        $wasBanned = $this->account->update(array('id' => $id), array(
            'status'  => 'BLOCK',
            'availDt' => $data['expiration'],
        ));

        if ($wasBanned)
        {
            $this->app['events']->fire('account.blocked', array($data));
        }

        return $wasBanned;
    }

    /**
     * Unblock an account
     *
     * @param $id
     * @return bool
     */
    public function unblockAccount($id)
    {
        $wasUnblocked = (bool) $this->account->update(array('id' => $id), array(
            'status'  => 'OK',
            'availDt' => '0000-00-00 00:00:00',
        ));

        if ($wasUnblocked)
        {
            $this->app['events']->fire('account.unblocked', array(
                array('account' => $id),
            ));
        }

        return $wasUnblocked;
    }
}
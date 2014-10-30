<?php namespace Metin2CMS\Admin\Services;

use Metin2CMS\Admin\Exceptions\LowPermissionException;
use Metin2CMS\Core\Repositories\AccountRepositoryInterface;
use Metin2CMS\Core\Repositories\HistoryRepositoryInterface;

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
     * @param AccountRepositoryInterface $account
     * @param HistoryRepositoryInterface $history
     */
    public function __construct(AccountRepositoryInterface $account, HistoryRepositoryInterface $history)
    {
        $this->account = $account;
        $this->history = $history;
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
            throw new LowPermissionException('You cannot block this account.', '');
        }

        $wasBanned = (bool) $this->account->update(array('id' => $id), array(
            'status'  => 'BLOCK',
            'availDt' => $until,
        ));

        // Creates a new event in history for account that was banned
        if ($wasBanned)
        { // TO be extracted
            $this->history->create(array(
                'account' => $id,
                'event'   => 'blocked',
                'data'    => sprintf('Blocked until %s with the reason: %s', $until, $data['reason'])
            ));
        }

        return $this;
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
            $this->history->create(array(
                'account' => $id,
                'event'   => 'unblocked',
                'data'    => ''
            ));
        }

        return $wasUnblocked;
    }
}
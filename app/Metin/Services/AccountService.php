<?php

namespace Metin\Services;

use Exception;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Metin\Repositories\AccountRepositoryInterface;
use Metin\Repositories\ReminderRepositoryInterface;

class AccountService {

    protected $account;

    protected $app;

    protected $reminder;

    public function __construct(AccountRepositoryInterface $account, Application $app, ReminderRepositoryInterface $reminder)
    {
        $this->app = $app;
        $this->account = $account;
        $this->reminder = $reminder;
    }

    /**
     * Create user account
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        //@TODO: Make use of events for this kind of configurations
        $data['status'] = 'BLOCK';

        $this->app['events']->fire('account.creating', array(&$data));

        $account = $this->account->create($data);

        if ($account)
        {
            $this->app['events']->fire('account.created', array($account));

            return $account;
        }
    }

    /**
     * Authenticate the user
     *
     * @param array $data
     * @return bool
     * @throws \Exception
     */
    public function authenticate(array $data)
    {
        $this->app['events']->fire('account.auth.before', array($data));

        $auth = Auth::attempt(array(
            'username' => $data['username'],
            'password' => $data['password']
        ));

        if ( ! $auth)
        {
            $this->app['events']->fire('account.auth.failed', array($data));

            throw new LoginFailedException('Login failed');
        }

        $this->app['events']->fire('account.auth.successful', array($data));

        return true;
    }

    /**
     * Generate a new password for the user
     *
     * @param array $data
     * @return mixed
     * @throws \Exception
     */
    public function remind(array $data)
    {
        $account = $this->account->findByName($data['username']);

        if ( ! $account || $account['email'] != $data['email'])
        {
            throw new \Exception('Can\'t find account by this user and email.');
        }

        $token    = str_random(64);
        $password = str_random(10);

        return $this->reminder->generatePassword($data, $token, $password);
    }

    /**
     * Confirm the generated user password
     *
     * @param $token
     * @return bool
     * @throws \Exception
     */
    public function confirmNewPassword($token)
    {
        $reminder = $this->reminder->findByToken($token);

        if ( ! $reminder || $reminder['token'] != $token)
        {
            throw new \Exception('This token is invalid.');
        }

        $change = $this->account->changePassword($reminder);

        if ($change)
        {
            // Delete token
            $this->reminder->deleteToken($token);
            
            return true;
        }
    }
}

// Exceptions - Considering about moving them in the futures
class LoginFailedException extends Exception {}
class RemindFailedException extends Exception {}
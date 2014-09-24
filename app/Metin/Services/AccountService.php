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
        $data['confirmation_token'] = str_random(64);

        $this->app['events']->fire('account.creating', array(&$data));

        $account = $this->account->create($data);

        if ($account)
        {
            $this->app['events']->fire('account.created', array($account));

            return $account;
        }
    }

    /**
     * Confirm user account
     *
     * @param $user
     * @param $token
     * @return bool
     */
    public function confirmAccount($user, $token)
    {
        return (bool) $this->account->update(array('login' => $user, 'confirmation_token' => $token), array(
            'confirmation_token' => '',
            'status' => 'OK'
        ));
    }

    /**
     * Authenticate the user
     *
     * @param array $data
     * @return bool
     * @throws LoginFailedException
     */
    public function authenticate(array $data)
    {
        $this->app['events']->fire('account.auth.before', array($data));

        $remember = isset($data['remember']) && $data['remember'] != null ? true : false;

        if ($this->account->isBlocked($data['username']))
        {
            throw new LoginFailedException('Your account is blocked.');
        }

        if ($this->account->isDisabled($data['username']))
        {
            throw new LoginFailedException('Your account is not activated yet.');
        }

        $auth = Auth::attempt(array(
            'username' => $data['username'],
            'password' => $data['password']
        ), $remember);

        if ( ! $auth)
        {
            $this->app['events']->fire('account.auth.failed', array($data));

            throw new LoginFailedException('Username or password is incorrect.');
        }

        $this->app['events']->fire('account.auth.successful', array($data));

        return true;
    }

    public function logout()
    {
        return Auth::logout();
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
<?php

namespace Metin\Services;

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;
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

            throw new \Exception('Login failed');
        }

        $this->app['events']->fire('account.auth.successful', array($data));

        return true;
    }

    public function remind(array $data)
    {
        $account = $this->account->findByName($data['username']);

        if ( ! $account || $account['email'] != $data['email'])
        {
            throw new \Exception('Can\'t find account by this user and email.');
        }

        // Create token
        //$token = Hash::make($data['email'] . uniqid(microtime(0)));

        $token    = str_random(64);
        $password = str_random(10);

        $generate = $this->reminder->generatePassword($data, $token, $password);

        if ($generate) {
            // send email
            return 'gata';
        }
        
    }
}
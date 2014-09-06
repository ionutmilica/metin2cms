<?php

namespace Metin\Services;

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Metin\Repositories\AccountRepositoryInterface;

class AccountService {

    protected $account;

    protected $app;

    public function __construct(AccountRepositoryInterface $account, Application $app)
    {
        $this->app = $app;
        $this->account = $account;
    }

    public function create(array $data)
    {
        $data['password'] = mysqlHash($data['password']);
        $data['status'] = 'BLOCK';

        $this->app['events']->fire('account.creating', array($data));

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
}
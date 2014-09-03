<?php

namespace Metin\Services;

use Illuminate\Support\Facades\Auth;
use Metin\Repositories\AccountRepositoryInterface;
use App;

class AccountService {

    protected $account;

    public function __construct(AccountRepositoryInterface $account)
    {
        $this->account = $account;
    }

    public function create(array $data)
    {
        App::make('Metin\Services\Forms\Registration')->validate($data);

        $data['password'] = mysqlHash($data['password']);
        $data['status'] = 'BLOCK';

        /** Todo: Configuration for activation **/

        $account = $this->account->create($data);

        if ($account)
        {
            // send email

            return $account;
        }
    }

    public function authenticate(array $data)
    {
        App::make('Metin\Services\Forms\Login')->validate($data);

        $auth = Auth::attempt(array(
            'username' => $data['username'],
            'password' => $data['password']
        ));

        if ( ! $auth)
        {
            throw new \Exception('Login failded');
        }

        return true;
    }
}
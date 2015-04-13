<?php

use Illuminate\Database\Seeder;
use Metin2CMS\Repositories\AccountRepositoryInterface;

class AccountTableSeeder extends Seeder {

    /**
     * @var Metin2CMS\Repositories\AccountRepositoryInterface
     */
    private $account;

    protected $accounts = array(
        array(
            'login' => 'demo',
            'password' => 'dev',
            'email'    => 'demo@demo.com',
            'status'   => 'OK'
        ),
        array(
            'login' => 'ionut',
            'password' => 'dev',
            'email'    => 'ionut.milica@gmail.com',
            'status'   => 'OK'
        ),
        array(
            'login' => 'vlad',
            'password' => 'dev',
            'email'    => 'no@email.com',
            'status'   => 'OK'
        )
    );

    public function __construct(AccountRepositoryInterface $account)
    {
        $this->account = $account;
    }

    public function run()
    {
        foreach ($this->accounts as $account)
        {
            $this->account->create($account);
        }
    }
}
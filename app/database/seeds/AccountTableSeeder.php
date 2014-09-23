<?php

use Metin\Repositories\AccountRepositoryInterface;

class AccountTableSeeder extends Seeder {

    /**
     * @var Metin\Repositories\AccountRepositoryInterface
     */
    private $account;

    protected $accounts = array(
        array(
            'username' => 'demo',
            'password' => 'demo',
            'email'    => 'demo@demo.com',
            'status'   => 'OK'
        ),
        array(
            'username' => 'ionut',
            'password' => 'dev',
            'email'    => 'ionut.milica@gmail.com',
            'status'   => 'OK'
        ),
        array(
            'username' => 'vlad',
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
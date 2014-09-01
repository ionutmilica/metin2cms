<?php

namespace Metin\Services;

use Metin\Repositories\AccountRepositoryInterface;
use App;

class AccountService {

    protected $account;

    protected $app;

    public function __construct(App $app,AccountRepositoryInterface $account)
    {
        $this->account = $account;
        $this->app = $app;
    }

    public function create(array $data)
    {
        $validator = $this->app->make('Metin\Services\Forms\Registration');

        $validator->validate($data);

        $account = $this->account->create($data);

        if ($account)
        {
            // send email

            return $account;
        }
    }
}
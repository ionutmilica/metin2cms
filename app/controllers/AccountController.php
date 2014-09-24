<?php

use Metin\Services\AccountService;

class AccountController extends BaseController {

    protected $account;

    public function __construct(AccountService $account)
    {
        $this->account = $account;
    }

    public function index()
    {
        dd(Auth::user());
    }
}

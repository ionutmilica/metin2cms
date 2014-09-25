<?php

use Illuminate\Support\Facades\View;
use Metin\Services\AccountService;

class AccountController extends BaseController {

    protected $account;

    public function __construct(AccountService $account)
    {
        $this->account = $account;
    }

    public function index()
    {
        return View::make('account.index')->withUser(Auth::user());
    }
}

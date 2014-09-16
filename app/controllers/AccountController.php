<?php

use Metin\Validation\FormValidationException;
use Metin\Services\AccountService;

class AccountController extends BaseController {

    protected $account;

    public function __construct(AccountService $account)
    {
        $this->account = $account;
    }

    public function index()
    {
        var_dump(Auth::user());
    }

    public function create()
    {
        $view = View::make('site.registration.index');

        return $view;
    }

    public function doCreate()
    {
        if ($this->account->create(Input::all()))
        {
            return Redirect::route('account.index');
        }
    }

    public function auth()
    {
        $view = View::make('site.auth.index');

        return $view;
    }

    public function doAuth()
    {
        if ($this->account->authenticate(Input::all()))
        {
            return Redirect::route('account.index');
        }
    }
}

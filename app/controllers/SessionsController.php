<?php

use Illuminate\Support\Facades\Redirect;
use Metin\Services\AccountService;
use Metin\Services\Forms\Login;
use Metin\Services\LoginFailedException;

class SessionsController extends BaseController {

    /**
     * @var Metin\Services\AccountService
     */
    protected $account;
    /**
     * @var Metin\Services\Forms\Login
     */
    protected $loginForm;

    public function __construct(AccountService $account, Login $loginForm)
    {
        $this->account = $account;
        $this->loginForm = $loginForm;
    }

    public function index()
    {
        $view = View::make('account.login.form');
        return $view;
    }

    /**
     *
     * @return Illuminate\Http\Response
     */
    public function doLogin()
    {
        $input = Input::only('username', 'password', 'remember');

        $this->loginForm->validate($input);

        try
        {
            $this->account->authenticate($input);

            return Redirect::route('home');
        }
        catch (LoginFailedException $e)
        {
            return Redirect::route('account.login')->withInput()->withErrors(array(
                'auth' => $e->getMessage()
            ));
        }
    }

    public function logout()
    {
        $this->account->logout();

        return Redirect::route('home');
    }
}
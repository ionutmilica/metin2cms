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
        $view = View::make('site.login.index');
        return $view;
    }

    /**
     *
     * @return Illuminate\Http\Response
     */
    public function doLogin()
    {
        $input = Input::only('username', 'password');

        $this->loginForm->validate($input);

        try
        {
            $this->account->authenticate($input);

            return Redirect::route('home');
        }
        catch (LoginFailedException $e)
        {
            return Redirect::route('account.login')->withInput()->withErrors(array(
                'Username or password is incorrect.'
            ));
        }
    }

    public function logout()
    {
        $this->account->logout();

        return Redirect::route('home');
    }
}
<?php

use Illuminate\Support\Facades\Redirect;
use Metin\Services\AccountService;
use Metin\Services\Forms\Login;

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

            return Redirect::route('account.index');
        }
        catch (Exception $e)
        {
            return Redirect::route('account.login')->withInput()->withErrors(array(
                'Username or password is incorrect.'
            ));
        }
    }
}
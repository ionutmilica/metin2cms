<?php namespace Themes\Official\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Metin2CMS\Core\Services\AccountService;
use Metin2CMS\Core\Services\Forms\Login;

class SessionsController extends BaseController {

    /**
     * @var \Metin2CMS\Core\Services\AccountService
     */
    protected $account;
    /**
     * @var \Metin2CMS\Core\Services\Forms\Login
     */
    protected $loginForm;

    /**
     * @param AccountService $account
     * @param Login $loginForm
     */
    public function __construct(AccountService $account, Login $loginForm)
    {
        parent::__construct();

        $this->account   = $account;
        $this->loginForm = $loginForm;
    }

    public function index()
    {
        return $this->view('account.login.form');
    }

    /**
     * Make auth
     *
     * @return \Illuminate\Http\Response
     */
    public function doLogin()
    {
        $input = Input::only('username', 'password', 'remember');

        $this->loginForm->validate($input);

        $this->account->authenticate($input);

        return Redirect::route('account.index');
    }

    /**
     * Clear sessions
     *
     * @return mixed
     */
    public function logout()
    {
        $this->account->logout();

        return Redirect::route('home');
    }
}
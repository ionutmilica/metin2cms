<?php namespace Metin2cms\Site\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Metin2cms\Site\Services\AccountService;
use Metin2cms\Site\Services\Forms\Login;
use Metin2cms\Site\Services\LoginFailedException;

class SessionsController extends BaseController {

    /**
     * @var Metin2cms\Site\Services\AccountService
     */
    protected $account;
    /**
     * @var Metin2cms\Site\Services\Forms\Login
     */
    protected $loginForm;

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

            return Redirect::route('account.index');
        }
        catch (LoginFailedException $e)
        {
            return $this->redirectWithError('account.login', $e->getMessage());
        }
    }

    public function logout()
    {
        $this->account->logout();

        return Redirect::route('home');
    }
}
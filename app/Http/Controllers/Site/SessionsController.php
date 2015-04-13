<?php namespace Metin2CMS\Http\Controllers\Site;

use Illuminate\Support\Facades\Redirect;
use Metin2CMS\Http\Requests\AuthRequest;
use Metin2CMS\Services\AccountService;

class SessionsController extends BaseController {

    /**
     * Account service
     *
     * @var \Metin2CMS\Services\AccountService
     */
    protected $account;

    /**
     * @param AccountService $account
     */
    public function __construct(AccountService $account)
    {
        parent::__construct();

        $this->account   = $account;
    }

    public function index()
    {
        return $this->view('account.login.form');
    }

    /**
     * Auth the user to the system
     *
     * @param AuthRequest $request
     * @return \Illuminate\Http\Response
     * @throws \Metin2CMS\Exceptions\Core\LoginFailedException
     */
    public function doLogin(AuthRequest $request)
    {
        $input = $request->only('username', 'password', 'remember');

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
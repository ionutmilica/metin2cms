<?php namespace Metin2CMS\Admin\Controllers;

use Illuminate\Support\Facades\Redirect;
use Metin2CMS\Core\Services\AccountService;

class AccountController extends BaseController {
    /**
     * @var AccountService
     */
    private $account;

    /**
     * @param AccountService $account
     */
    public function __construct(AccountService $account)
    {
        parent::__construct();
        $this->account = $account;
    }
    /**
     * @return mixed
     */
    public function index()
    {
        return $this->view('account.index');
    }

    /**
     * @return bool
     */
    public function logout()
    {
        $this->account->logout();

        return Redirect::guest('/');
    }
}

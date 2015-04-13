<?php namespace Metin2CMS\Http\Controllers\Admin;

use Illuminate\Support\Facades\Redirect;
use Metin2CMS\Services\AccountService;

class HomeController extends BaseController {
    /**
     * @var AccountService
     */
    private $account;

    /**
     * @param AccountService $account
     */
    public function __construct(AccountService $account)
    {
        $this->account = $account;
    }
    /**
     * @return mixed
     */
    public function index()
    {
        return $this->view('layouts.master');
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

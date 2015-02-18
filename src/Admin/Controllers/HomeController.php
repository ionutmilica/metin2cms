<?php namespace Metin2CMS\Admin\Controllers;

use Illuminate\Support\Facades\Redirect;
use Metin2CMS\Core\Services\AccountService;

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

        var_dump($account->authenticate([
            'username' => 'ionut',
            'password' => 'dev',
            'remember' => true,
        ]));
       // var_dump(\Auth::user());
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

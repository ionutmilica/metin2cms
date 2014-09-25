<?php

use Illuminate\Support\Facades\View;
use Metin\Services\AccountService;
use Metin\Services\Forms\Password;
use Metin\Services\PasswordFailedException;

class AccountController extends BaseController {

	/**
     * @var Metin\Services\AccountService
     */
    protected $account;

    /**
     * @var Metin\Services\Forms\Password
     */
    protected $passwordForm;

    public function __construct(AccountService $account, Password $passwordForm)
    {
        $this->account      = $account;
        $this->passwordForm = $passwordForm;
    }

    public function index()
    {
        return View::make('account.index')->withUser(Auth::user());
    }

    public function password()
    {
    	return View::make('account.password.form');
    }

    public function doPassword()
    {
    	$input = Input::only('old_password', 'new_password', 'new_password_again');

        $this->passwordForm->validate($input);

        try
        {
            if($this->account->password($input, Auth::user()))
            {
            	return View::make('account.password.success');
            }
        }
        catch (PasswordFailedException $e)
        {
            return Redirect::route('account.password')->withInput()->withErrors(array(
                'password' => $e->getMessage()
            ));
        }
    }
}

<?php

use Illuminate\Support\Facades\View;
use Metin\Services\AccountService;
use Metin\Services\Forms\Password;
use Metin\Services\Forms\Email;
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

    /**
     * @var Metin\Services\Forms\Password
     */
    protected $emailForm;

    public function __construct(AccountService $account, Password $passwordForm, Email $emailForm)
    {
        $this->account      = $account;
        $this->passwordForm = $passwordForm;
        $this->emailForm    = $emailForm;
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
            return $this->redirectWithError('account.password', $e->getMessage());
        }
    }

    public function email()
    {
        return View::make('account.email.form');
    }

    public function doEmail()
    {
        $input = Input::only('email');

        $this->emailForm->validate($input);

        try
        {
            if ($this->account->email($input, Auth::user()))
            {
                return View::make('account.email.success');
            }
        }
        catch (EmailFailedException $e)
        {
            return $this->redirectWithError('account.email', $e->getMessage());
        }

    }
}

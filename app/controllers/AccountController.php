<?php

use Metin\Services\AccountService;
use Metin\Services\EmailFailedException;
use Metin\Services\Forms\Password;
use Metin\Services\Forms\Email;
use Metin\Services\PasswordFailedException;
use Metin\Services\SafeboxException;

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
        $this->beforeFilter('auth');

        $this->account      = $account;
        $this->passwordForm = $passwordForm;
        $this->emailForm    = $emailForm;
    }

    public function index()
    {
        return view('account.index')->withUser(Auth::user());
    }

    public function password()
    {
        return view('account.password.form');
    }

    public function doPassword()
    {
        $input = Input::only('old_password', 'new_password', 'new_password_again');

        $this->passwordForm->validate($input);

        try
        {
            if($this->account->password($input, Auth::user()))
            {
                return view('account.password.success');
            }
        }
        catch (PasswordFailedException $e)
        {
            return $this->redirectWithError('account.password', $e->getMessage());
        }
    }

    public function email()
    {
        return view('account.email.form');
    }

    public function doEmail()
    {
        $input = Input::only('old_email', 'new_email');

        $this->emailForm->validate($input);

        try
        {
            if ($this->account->email(Auth::user()->id, $input))
            {
                return view('account.email.success');
            }
        }
        catch (EmailFailedException $e)
        {
            return $this->redirectWithError('account.email', $e->getMessage());
        }

    }

    public function safebox()
    {
        return view('account.safebox.form');
    }

    public function doSafebox()
    {
        try
        {
            $this->account->safebox(Auth::user()->id);

            return view('account.safebox.success');
        }
        catch (SafeboxException $e)
        {
            return view('account.safebox.fail');
        }
    }
}

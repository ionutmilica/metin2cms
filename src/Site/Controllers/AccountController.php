<?php namespace Metin2CMS\Site\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Metin2CMS\Site\Services\AccountService;
use Metin2CMS\Site\Services\EmailFailedException;
use Metin2CMS\Site\Services\Forms\Password;
use Metin2CMS\Site\Services\Forms\Email;
use Metin2CMS\Site\Services\PasswordFailedException;
use Metin2CMS\Site\Services\SafeboxException;

class AccountController extends BaseController {

    /**
     * @var \Metin2CMS\Site\Services\AccountService
     */
    protected $account;

    /**
     * @var \Metin2CMS\Site\Services\Forms\Password
     */
    protected $passwordForm;

    /**
     * @var \Metin2CMS\Site\Services\Forms\Email
     */
    protected $emailForm;

    public function __construct(AccountService $account, Password $passwordForm, Email $emailForm)
    {
        parent::__construct();
        
        $this->beforeFilter('auth');

        $this->account      = $account;
        $this->passwordForm = $passwordForm;
        $this->emailForm    = $emailForm;
    }

    public function index()
    {
        return $this->view('account.index')->withUser(Auth::user());
    }

    public function password()
    {
        return $this->view('account.password.form');
    }

    public function doPassword()
    {
        $input = Input::only('old_password', 'new_password', 'new_password_again');

        $this->passwordForm->validate($input);

        try
        {
            if($this->account->password($input, Auth::user()))
            {
                return $this->view('account.password.success');
            }
        }
        catch (PasswordFailedException $e)
        {
            return $this->redirectWithError('account.password', $e->getMessage());
        }
    }

    public function email()
    {
        return $this->view('account.email.form');
    }

    public function doEmail()
    {
        $input = Input::only('old_email', 'new_email');

        $this->emailForm->validate($input);

        try
        {
            if ($this->account->email(Auth::user()->id, $input))
            {
                return $this->view('account.email.success');
            }
        }
        catch (EmailFailedException $e)
        {
            return $this->redirectWithError('account.email', $e->getMessage());
        }

    }

    public function safebox()
    {
        return $this->view('account.safebox.form');
    }

    public function doSafebox()
    {
        try
        {
            $this->account->safebox(Auth::user()->id);

            return $this->view('account.safebox.success');
        }
        catch (SafeboxException $e)
        {
            return $this->view('account.safebox.fail');
        }
    }
}

<?php namespace Metin2CMS\Http\Controllers\Site;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Metin2CMS\Http\Requests\ChangeEmailRequest;
use Metin2CMS\Http\Requests\ChangePasswordRequest;
use Metin2CMS\Services\AccountService;
use Metin2CMS\Services\Forms\Password;
use Metin2CMS\Services\Forms\Email;

class AccountController extends BaseController {

    /**
     * @var \Metin2CMS\Services\AccountService
     */
    protected $account;

    public function __construct(AccountService $account)
    {
        parent::__construct();
        
        $this->beforeFilter('auth');

        $this->account = $account;
    }

    /**
     * Account main page
     *
     * @return mixed
     */
    public function index()
    {
        return $this->view('account.index')->withUser(Auth::user());
    }

    /**
     * Change password form
     *
     * @return mixed
     */
    public function password()
    {
        return $this->view('account.password.form');
    }

    /**
     * Change password
     *
     * @param ChangePasswordRequest $request
     * @return mixed
     * @throws \Metin2CMS\Exceptions\Core\PasswordFailedException
     */
    public function doPassword(ChangePasswordRequest $request)
    {
        $input = $request->only('old_password', 'new_password', 'new_password_again');

        $this->account->password($input, Auth::user());

        return $this->view('account.password.success');
    }

    /**
     * Change email form
     *
     * @return mixed
     */
    public function email()
    {
        return $this->view('account.email.form');
    }

    /**
     * Change email
     *
     * @param ChangeEmailRequest $request
     * @return mixed
     * @throws \Metin2CMS\Exceptions\Core\EmailFailedException
     */
    public function doEmail(ChangeEmailRequest $request)
    {
        $input = $request->only('old_email', 'new_email');

        $this->account->email(Auth::user()->id, $input);

        return $this->view('account.email.success');
    }

    /**
     * Deletion code form
     *
     * @return mixed
     */
    public function delCode()
    {
        return $this->view('account.deletion_code.form');
    }

    /**
     * Send deletion code
     *
     * @return mixed
     */
    public function doDelCode()
    {
        $this->account->deletionCode(Auth::user()->id);

        return $this->view('account.safebox.success');
    }

    /**
     * Get safebox code form
     *
     * @return mixed
     */
    public function safebox()
    {
        return $this->view('account.safebox.form');
    }

    /**
     * Get safebox code
     *
     * @return mixed
     */
    public function doSafebox()
    {
        $this->account->safebox(Auth::user()->id);

        return $this->view('account.safebox.success');
    }
}

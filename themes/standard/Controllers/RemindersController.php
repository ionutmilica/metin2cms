<?php namespace Themes\Standard\Controllers;

use Illuminate\Support\Facades\Input;
use Metin2CMS\Core\Services\AccountService;
use Metin2CMS\Core\Services\Forms\Recovery;
use Metin2CMS\Core\Services\RemindFailedException;

class RemindersController extends BaseController {

    /**
     * @var \Metin2CMS\Core\Services\AccountService
     */
    protected $account;
    /**
     * @var Recovery
     */
    private $recovery;

    /**
     * @param AccountService $account
     * @param Recovery $recovery
     */
    public function __construct(AccountService $account, Recovery $recovery)
    {
        parent::__construct();

        $this->account = $account;
        $this->recovery = $recovery;
    }

    /**
     * Display password reset form
     *
     * @return mixed
     */
    public function reminder()
    {
        return $this->view('account.password-reset.form');
    }

    /**
     * Generate a new password and send a confirmation email
     *
     * @return mixed
     */
    public function doReminder()
    {
        $input = Input::only('username', 'email');

        $this->recovery->validate($input);
        $this->account->remind($input);

        return $this->view('account.password-reset.success');
    }

    /**
     * Confirm the generated password
     *
     * @param $user
     * @param $token
     * @return mixed
     */
    public function confirm($user, $token)
    {
       $this->account->confirmNewPassword($user, $token);

       return $this->view('account.password-reset.confirm');
    }
}

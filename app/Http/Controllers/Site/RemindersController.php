<?php namespace Metin2CMS\Http\Controllers\Site;

use Metin2CMS\Http\Requests\RecoverPasswordRequest;
use Metin2CMS\Services\AccountService;

class RemindersController extends BaseController {

    /**
     * @var \Metin2CMS\Services\AccountService
     */
    protected $account;

    /**
     * @param AccountService $account
     */
    public function __construct(AccountService $account)
    {
        parent::__construct();

        $this->account = $account;
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
     * @param RecoverPasswordRequest $request
     * @return mixed
     * @throws \Metin2CMS\Exceptions\Core\RemindFailedException
     */
    public function doReminder(RecoverPasswordRequest $request)
    {
        $input = $request->only('username', 'email');

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

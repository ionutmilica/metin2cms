<?php

use Metin\Services\AccountService;
use Metin\Services\RemindFailedException;

class RemindersController extends BaseController {

    /**
     * @var Metin\Services\AccountService
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
        return view('account.password-reset.form');
    }

    /**
     * Generate a new password and send a confirmation email
     *
     * @return mixed
     */
    public function doReminder()
    {
        $input = Input::all();

        App::make('Metin\Services\Forms\Recovery')->validate($input);

        try
        {
            if ($this->account->remind($input) === true) 
            {
                return view('account.password-reset.success');
            }
        }
        catch(RemindFailedException $e)
        {
            return $this->redirectWithError('account.password-reset', $e->getMessage());
        }
    }

    /**
     * Confir the generated password
     *
     * @param $token
     * @return mixed
     */
    public function confirm($token)
    {
       try
       {
           if ($this->account->confirmNewPassword($token))
           {
                return view('account.password-reset.confirm');
           }
       }
       catch (RemindFailedException $e)
       {
           return $this->redirectWithError('home', $e->getMessage());
       }
    }
}

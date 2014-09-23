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
        $this->account = $account;
    }

    /**
     * Display password reset form
     *
     * @return mixed
     */
    public function reminder()
    {
        return View::make('site.reminder.index');
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
                return View::make('site.reminder.sent');
            }
        }
        catch(RemindFailedException $e)
        {
            return Redirect::route('account.recover')->withInput()->withErrors(array(
                'credentials' => 'Incorrect email or username for your account.'
            ));
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
                return View::make('site.reminder.confirm');
           }
       }
       catch (Exception $e)
       {
           return Redirect::route('home')->withInput()->withErrors(array(
                'credentials' => 'Incorrect token.'
            ));
       }
    }
}

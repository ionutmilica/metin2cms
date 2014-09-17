<?php

use Metin\Services\AccountService;

class RemindersController extends BaseController {

    protected $account;

    public function __construct(AccountService $account)
    {
        $this->account = $account;
    }

    public function reminder()
    {
        return View::make('site.reminder.index');
    }

    public function doReminder()
    {
        $input = Input::all();

        App::make('Metin\Services\Forms\Recovery')->validate($input);

        try
        {
            $this->account->remind($input);
        }
        catch(Exception $e)
        {
            return Redirect::route('account.recover')->withInput()->withErrors(array(
                'credentials' => 'Incorrect email or username for your account.'
            ));
        }
    }

    public function confirm($token)
    {
        return View::make('site.reminder.confirm');
    }

    public function doConfirm()
    {

    }
}

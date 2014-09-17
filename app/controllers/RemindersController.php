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

    }

    public function confirm($token)
    {
        return View::make('site.reminder.confirm');
    }

    public function doConfirm()
    {

    }
}

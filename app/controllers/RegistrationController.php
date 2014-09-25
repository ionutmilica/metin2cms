<?php

use Illuminate\Support\Facades\View;
use Metin\Services\AccountService;
use Metin\Services\Forms\Registration;

class RegistrationController extends Controller {

    /**
     * @var Metin\Services\Forms\Registration
     */
    protected $registrationForm;

    /**
     * @var Metin\Services\AccountService
     */
    protected $account;

    /**
     * @param Registration $registrationForm
     * @param AccountService $account
     */
    public function __construct(Registration $registrationForm, AccountService $account)
    {
        $this->registrationForm = $registrationForm;
        $this->account = $account;
    }

    /**
     * Display user creation form
     *
     * @return mixed
     */
    public function create()
    {
        return View::make('account.register.form');
    }

    /**
     * Create the user
     *
     * @return mixed
     */
    public function store()
    {
        $input = Input::only('username', 'password', 'password_confirmation', 'email');

        $this->registrationForm->validate($input);

        if ($this->account->create($input))
        {
            return View::make('account.register.success');
        }
    }

    /**
     * Confirm account creation
     *
     * @param $user
     * @param $token
     * @return
     */
    public function confirm($user, $token)
    {
        $this->account->confirmAccount($user, $token);

        return View::make('account.register.confirm');
    }
}
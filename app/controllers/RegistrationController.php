<?php

use Metin\Services\AccountService;
use Metin\Services\Forms\Registration;

class RegistrationController extends Controller {

    /**
     * Service that validates the input for registration
     *
     * @var
     */
    protected $registrationForm;

    /**
     * With account service we can create the user account.
     *
     * @var
     */
    protected $account;

    public function __construct(Registration $registrationForm, AccountService $account)
    {
        $this->registrationForm = $registrationForm;
        $this->account = $account;

        Event::listen('account.created', function($user) {
            var_dump($user);

        });
    }

    public function create()
    {


        return View::make('site.registration.index');
    }

    public function store()
    {
        $input = Input::only('username', 'password', 'password_confirmation', 'email');

        $this->registrationForm->validate($input);

        // If the validation succeds this we'll go to the next operation

        if ($this->account->create($input))
        {
            echo 'Account created !';
        }
    }

    public function confirm($token)
    {
        echo 'Your token is: ' . $token;
    }
}
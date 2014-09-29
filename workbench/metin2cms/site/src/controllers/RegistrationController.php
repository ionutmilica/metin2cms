<?php namespace Metin2cms\Site\Controllers;

use Illuminate\Support\Facades\Input;
use Metin2cms\Site\Services\AccountService;
use Metin2cms\Site\Services\Forms\Registration;

class RegistrationController extends BaseController {

    /**
     * @var Metin2cms\Site\Services\Forms\Registration
     */
    protected $registrationForm;

    /**
     * @var Metin2cms\Site\Services\AccountService
     */
    protected $account;

    /**
     * @param Registration $registrationForm
     * @param AccountService $account
     */
    public function __construct(Registration $registrationForm, AccountService $account)
    {
        parent::__construct();

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
        return $this->view('account.register.form');
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
            return $this->view('account.register.success');
        }
    }

    /**
     * Confirm account creation
     *
     * @param $user
     * @param $token
     * @return mixed
     */
    public function confirm($user, $token)
    {
        $this->account->confirmAccount($user, $token);

        return $this->view('account.register.confirm');
    }
}
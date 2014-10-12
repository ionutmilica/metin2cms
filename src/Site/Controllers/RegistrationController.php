<?php namespace Metin2CMS\Site\Controllers;

use Illuminate\Support\Facades\Input;
use Metin2CMS\Core\Services\AccountService;
use Metin2CMS\Core\Services\Forms\Registration;

class RegistrationController extends BaseController {

    /**
     * @var \Metin2CMS\Core\Services\Forms\Registration
     */
    protected $registrationForm;

    /**
     * @var \Metin2CMS\Core\Services\AccountService
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

        $this->account->create($input);

        return $this->view('account.register.success');
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
        if ($this->account->confirmAccount($user, $token))
        {
            return $this->view('account.register.fail');
        }

        return $this->view('account.register.confirm');
    }
}
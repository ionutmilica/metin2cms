<?php namespace Metin2CMS\Http\Controllers\Site;

use Metin2CMS\Http\Requests\RegistrationRequest;
use Metin2CMS\Services\AccountService;

class RegistrationController extends BaseController {

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
     * @param RegistrationRequest $request
     * @return mixed
     */
    public function store(RegistrationRequest $request)
    {
        $input = $request->only('username', 'password', 'password_confirmation', 'email');

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
        if ( ! $this->account->confirmAccount($user, $token))
        {
            return $this->view('account.register.fail');
        }

        return $this->view('account.register.confirm');
    }
}
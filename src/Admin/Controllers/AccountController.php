<?php namespace Metin2CMS\Admin\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Paginator;
use Illuminate\Support\Facades\Redirect;
use Metin2CMS\Api\Transformers\AccountTransformer;
use Metin2CMS\Core\Services\AccountService;

class AccountController extends BaseController {
    /**
     * @var AccountService
     */
    private $account;
    /**
     * @var AccountTransformer
     */
    private $transformer;

    /**
     * @param AccountService $account
     * @param AccountTransformer $transformer
     */
    public function __construct(AccountService $account, AccountTransformer $transformer)
    {
        $this->account = $account;
        $this->transformer = $transformer;
    }
    /**
     * Get all accounts
     *
     * @todo Clean this somehow
     * @return mixed
     */
    public function index()
    {
        $accounts = $this->account->search(Input::all());
        $accounts = $this->transformer->transformPagination($accounts);
        $accounts = Paginator::make($accounts['data'], $accounts['total'], $accounts['perPage'])
                            ->appends(array('username' => Input::get('username')));

        return $this->view('account.index', compact('accounts'));
    }

    /**
     * @return bool
     */
    public function logout()
    {
        $this->account->logout();

        return Redirect::guest('/');
    }
}

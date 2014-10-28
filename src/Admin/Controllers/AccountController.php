<?php namespace Metin2CMS\Admin\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Paginator;
use Illuminate\Support\Facades\Redirect;
use Metin2CMS\Api\Transformers\AccountTransformer;
use Metin2CMS\Core\Services\AccountService;
use Metin2CMS\Core\Services\Forms\Edit;

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
     * @var \Metin2CMS\Core\Services\Forms\Edit
     */
    protected $editForm;

    /**
     * @param AccountService $account
     * @param AccountTransformer $transformer
     * @param Edit $editForm
     */
    public function __construct(AccountService $account, AccountTransformer $transformer, Edit $editForm)
    {
        $this->account     = $account;
        $this->transformer = $transformer;
        $this->editForm    = $editForm;
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
     * View account data for edit
     *
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        $account = $this->account->getAccountData($id);

        if ($account)
        {
            return $this->view('account.edit', compact('account', 'id'));
        }

        return Redirect::route('admin.account.index');

    }

    /**
     * Edit account
     *
     * @param $id
     * @return mixed
     */
    public function doEdit($id)
    {
        $input = Input::only('username', 'email');

        $this->editForm->validate($input);

        $this->account->editAccount($id, $input);

        return Redirect::route('admin.account.edit', compact($id));
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

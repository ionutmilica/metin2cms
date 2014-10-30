<?php namespace Metin2CMS\Admin\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Paginator;
use Illuminate\Support\Facades\Redirect;
use Metin2CMS\Admin\Forms\Edit;
use Metin2CMS\Admin\Forms\Block;
use Metin2CMS\Admin\Services\AdminService;
use Metin2CMS\Api\Transformers\AccountTransformer;
use Metin2CMS\Core\Services\AccountService;
use Metin2CMS\Core\Extensions\History\History;

class AccountController extends BaseController {
    /**
     * @var AdminService
     */
    private $admin;

    /**
     * @var History
     */
    private $history;

    /**
     * @var AccountTransformer
     */
    private $transformer;

    /**
     * @var Edit
     */
    protected $editForm;
    /**
     * @var Block
     */
    private $blockForm;
    /**
     * @var AccountService
     */
    private $account;

    /**
     * @param AdminService $admin
     * @param AccountService $account
     * @param AccountTransformer $transformer
     * @param Edit $editForm
     * @param Block $blockForm
     * @internal param AccountService $account
     */
    public function __construct(AdminService $admin, AccountService $account, AccountTransformer $transformer,
                                Edit $editForm,
                                Block $blockForm,
                                History $history)
    {
        $this->admin       = $admin;
        $this->transformer = $transformer;
        $this->editForm    = $editForm;
        $this->blockForm   = $blockForm;
        $this->account     = $account;
        $this->account     = $account;
        $this->history     = $history;
    }
    /**
     * Get all accounts
     *
     * @todo Clean this somehow
     * @return mixed
     */
    public function index()
    {
        $accounts = $this->admin->search(Input::all());
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
    public function editForm($id)
    {
        $account = $this->admin->getAccountData($id);

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

        $this->admin->editAccount($id, $input);

        return Redirect::route('admin.account.edit', compact($id));
    }

    /**
     * Account block form
     *
     * @param $id
     * @return mixed
     */
    public function blockForm($id)
    {
        $account = $this->admin->getAccountData($id);

        if ($account)
        {
            return $this->view('account.block', compact('account', 'id'));
        }

        return Redirect::route('admin.account.index');
    }

    /**
     * Block an account
     *
     * @param $id
     * @return mixed
     * @throws \Metin2CMS\Core\Validation\FormValidationException
     */
    public function doBlock($id)
    {
        $input = Input::only('reason', 'expiration');

        $this->blockForm->validate($input);

        $this->admin->blockAccount($id, $input);

        return Redirect::route('admin.account.index');
    }

    /**
     * Unblock account
     *
     * @param $id
     * @return mixed
     */
    public function doUnblock($id)
    {
        $account = $this->admin->getAccountData($id);

        if ($account)
        {
            $this->admin->unblockAccount($id);
        }

        return Redirect::route('admin.account.index');
    }

    public function history($id)
    {
        $history = $this->history->find($id);

        if ($history)
        {
            return $this->view('account.history', compact('history', 'id'));
        }

        return Redirect::route('admin.account.index');
    }

    /**
     * @return bool
     */
    public function logout()
    {
        $this->admin->logout();

        return Redirect::guest('/');
    }
}

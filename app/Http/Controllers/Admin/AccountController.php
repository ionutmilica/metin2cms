<?php namespace Metin2CMS\Http\Controllers\Admin;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Metin2CMS\Services\AccountService;
use Metin2CMS\Http\Requests\Admin\BlockAccountRequest;
use Metin2CMS\Http\Requests\Admin\EditAccountRequest;
use Metin2CMS\Services\Admin\AdminService;
use Metin2CMS\Services\HistoryService;

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
     * @var AccountService
     */
    private $account;

    /**
     * @param AdminService $admin
     * @param AccountService $account
     * @param HistoryService $history
     * @internal param AccountService $account
     */
    public function __construct(AdminService $admin, AccountService $account, HistoryService $history)
    {
        $this->admin       = $admin;
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
     * @param EditAccountRequest $request
     * @param $id
     * @return mixed
     */
    public function doEdit(EditAccountRequest $request, $id)
    {
        $input = $request->only('username', 'email');

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
     * @param BlockAccountRequest $request
     * @param $id
     * @return mixed
     * @throws \Metin2CMS\Admin\Exceptions\LowPermissionException
     */
    public function doBlock(BlockAccountRequest $request, $id)
    {
        $input = $request->only('reason', 'expiration');

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

    /**
     * History for every account
     *
     * @param $id
     * @return mixed
     */
    public function history($id)
    {
        $history = $this->history->find($id);

        return $this->view('account.history', compact('history', 'id'));
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

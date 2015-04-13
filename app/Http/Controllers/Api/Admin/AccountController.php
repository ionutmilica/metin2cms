<?php namespace Metin2CMS\Controllers\Api\Admin;

use Illuminate\Support\Facades\Input;
use Metin2CMS\Api\Controllers\ApiController;
use Metin2CMS\Api\Transformers\AccountTransformer;
use Metin2CMS\Services\AccountService;

class AccountController extends ApiController {

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

    public function all()
    {
        $accounts = $this->account->search(Input::all());

        return $this->transformer->transformPagination($accounts);
    }
}
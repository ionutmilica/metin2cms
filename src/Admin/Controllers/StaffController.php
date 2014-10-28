<?php namespace Metin2CMS\Admin\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Paginator;
use Illuminate\Support\Facades\Redirect;
use Metin2CMS\Admin\Forms\Edit;
use Metin2CMS\Admin\Forms\Block;
use Metin2CMS\Admin\Services\AdminService;
use Metin2CMS\Api\Transformers\AccountTransformer;
use Metin2CMS\Core\Services\AccountService;

class StaffController extends BaseController {

    public function __construct()
    {

    }

    public function index()
    {
        return $this->view('staff.index');
    }
}

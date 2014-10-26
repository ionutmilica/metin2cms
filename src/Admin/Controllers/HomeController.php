<?php namespace Metin2CMS\Admin\Controllers;

class HomeController extends BaseController {

    public function __construct()
    {
        $this->beforeFilter('admin.auth');
    }
    /**
     * @return mixed
     */
    public function index()
    {
        return '<h1>Welcome to Admin panel !</h1>';
    }
}

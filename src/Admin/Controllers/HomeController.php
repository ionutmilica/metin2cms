<?php namespace Metin2CMS\Admin\Controllers;

class HomeController extends BaseController {

    public function __construct()
    {
    }
    /**
     * @return mixed
     */
    public function index()
    {
        return $this->view('layouts.master');
    }
}

<?php namespace Metin2cms\Site\Controllers;

class HomeController extends BaseController {

    public function __construct()
    {
        parent::__construct();
    }

	public function index()
    {
        return $this->view('pages/home');
    }
}

<?php

class HomeController extends BaseController {

    public function __construct()
    {
        parent::__construct();
    }

	public function index()
    {
        return view('pages.home');
    }
}

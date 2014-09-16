<?php

class HomeController extends BaseController {

    public function __construct()
    {
    }

	public function index()
    {
        return View::make('pages.home');
    }
}

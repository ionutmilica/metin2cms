<?php

class HomeController extends BaseController {

    public function __construct()
    {
       // Auth::extend('test', function () {});
    }

	public function index()
    {
        return 'Welcome !!!';
    }
}

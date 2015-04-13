<?php namespace Metin2CMS\Http\Controllers\Site;

class HomeController extends BaseController {

    /**
     *
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return mixed
     */
    public function index()
    {
        return $this->view('pages/home');
    }
}

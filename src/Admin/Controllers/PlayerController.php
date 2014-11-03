<?php namespace Metin2CMS\Admin\Controllers;

class PlayerController extends BaseController {

    public function __construct()
    {
    }

    public function index()
    {
        return $this->view('player.index');
    }
}

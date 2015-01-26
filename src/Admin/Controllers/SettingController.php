<?php namespace Metin2CMS\Admin\Controllers;

use Ionutmilica\Themes\Facades\Theme;

class SettingController extends BaseController {

    public function __construct()
    {

    }

    public function general()
    {
        $themes = Theme::all();

        return $this->view('settings.general', compact('themes'));
    }
}

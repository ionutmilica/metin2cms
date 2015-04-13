<?php namespace Metin2CMS\Http\Controllers\Admin;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class SettingController extends BaseController {

    public function __construct()
    {

    }

    public function general()
    {
        $themes = Theme::all();
        $current = Theme::getActive();

        return $this->view('settings.general', compact('themes', 'current'));
    }

    public function doGeneral()
    {
        $input = Input::all();

        Theme::setActive($input['theme']);

        return Redirect::back();
    }
}

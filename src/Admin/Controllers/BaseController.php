<?php namespace Metin2CMS\Admin\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

class BaseController extends Controller {

    /**
     * Redirect back with old input and the specified data.
     *
     * @param  array $data
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function redirectBack($data = array())
    {
        return Redirect::back()->withInput()->with($data);
    }

    /**
     * Redirect user to a specific route with global error and input
     *
     * @param $route
     * @param $error
     * @return mixed
     */
    public function redirectWithError($route, $error)
    {
        return Redirect::route($route)->withInput()->withErrors(array(
            'global' => $error
        ));
    }

    /**
     * @param $name
     * @param array $data
     * @return mixed
     */
    protected function view($name, array $data = array())
    {
        return View::make($name, $data);
    }
}

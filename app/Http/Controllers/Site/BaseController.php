<?php namespace Metin2CMS\Http\Controllers\Site;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Ionutmilica\Themes\Facades\Theme;

class BaseController extends Controller {

    public function __construct()
    {
        $this->beforeFilter('csrf', array('on' => 'post'));

        // This should be moved. Think about a nice location
        View::share('playersMini', app('Metin2CMS\Services\HighscoreService')->players());
        View::share('guildsMini', app('Metin2CMS\Services\HighscoreService')->guilds());
    }

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
        return View::make('standard::'.$name, $data);
    }
}

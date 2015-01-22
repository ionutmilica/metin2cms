<?php namespace Themes\Standard;

use Illuminate\Support\ServiceProvider;

class ThemeServiceProvider extends ServiceProvider {

    public function boot()
    {

    }

    public function register()
    {
        $this->registerRoutes();
        $this->registerFilters();
    }

    /**
     * Register routes file and append a default namespace to it
     */
    public function registerRoutes()
    {
        $this->app['router']->group(array('namespace' => 'Themes\Standard\Controllers'), function ()
        {
            require __DIR__ . '/routes.php';
        });
    }

    /**
     * Register filters file
     */
    public function registerFilters()
    {
        require __DIR__ . '/filters.php';
    }
}
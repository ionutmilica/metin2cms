<?php namespace Metin2CMS\Core;

use Illuminate\Support\ServiceProvider;
use Metin2CMS\Core\Extensions\MetinAuthProvider;

class CoreServiceProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->package('metin2cms/core', 'metin2cms/core', __DIR__);

        $this->bootAuthProvider();

        $this->registerFilters();

        $this->loadModules();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $repositories = array(
            'Account', 'Player', 'Reminder', 'Guild', 'Safebox', 'Staff'
        );

        foreach ($repositories as $repository)
        {
            $this->registerRepo($repository);
        }
    }

    /**
     * Helper for repository registration
     *
     * @param $name
     */
    public function registerRepo($name)
    {
        $this->app->bind(
            'Metin2CMS\Core\Repositories\\'.$name.'RepositoryInterface',
            'Metin2CMS\Core\Repositories\Eloquent\\'.$name.'Repository'
        );
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }

    /**
     * Boot the auth provider
     */
    protected function bootAuthProvider()
    {
        $this->app['auth']->extend('metin', function ($app)
        {
            return new MetinAuthProvider(
                $this->app->make('Metin2CMS\Core\Entities\Account')
            );
        });
    }

    /**
     * An module loader.
     * We may extract a class for it in the future but for now it's ok.
     *
     * @return bool
     */
    protected function loadModules()
    {
        $loader = require base_path() . '/vendor/autoload.php';
        $modules = require base_path() . '/src/list.php';

        foreach ($modules as $name => $module)
        {
            if ($module['status'] == true)
            {
                $nameSpace = $module['namespace'];

                // Register the namespace to the composer

                $loader->setPsr4($nameSpace . "\\", __DIR__ . "/../".$name);

                // Register service provider
                $serviceProviderClass = sprintf('\%s\%sServiceProvider', $nameSpace, $name);

                $this->app->register(new $serviceProviderClass($this->app));
            }
        }

        return true;
    }

    /**
     * Register the filters
     */
    public function registerFilters()
    {
        $this->app['router']->filter('admin.auth', function()
        {
            if ( ! $this->app['auth']->check() || ! $this->app['auth']->user()->isAdmin())
            {
                return $this->app['redirect']->guest('/');
            }
        });
    }
}

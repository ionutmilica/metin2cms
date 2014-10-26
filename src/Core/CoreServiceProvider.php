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

        $this->loadModules();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'Metin2CMS\Core\Repositories\AccountRepositoryInterface',
            'Metin2CMS\Core\Repositories\Eloquent\AccountRepository'
        );

        $this->app->bind(
            'Metin2CMS\Core\Repositories\PlayerRepositoryInterface',
            'Metin2CMS\Core\Repositories\Eloquent\PlayerRepository'
        );

        $this->app->bind(
            'Metin2CMS\Core\Repositories\ReminderRepositoryInterface',
            'Metin2CMS\Core\Repositories\Eloquent\ReminderRepository'
        );

        $this->app->bind(
            'Metin2CMS\Core\Repositories\GuildRepositoryInterface',
            'Metin2CMS\Core\Repositories\Eloquent\GuildRepository'
        );

        $this->app->bind(
            'Metin2CMS\Core\Repositories\SafeboxRepositoryInterface',
            'Metin2CMS\Core\Repositories\Eloquent\SafeboxRepository'
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
}

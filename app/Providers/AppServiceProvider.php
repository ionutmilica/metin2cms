<?php namespace Metin2CMS\Providers;

use Illuminate\Support\ServiceProvider;
use Metin2CMS\Extensions\Auth\MetinAuthProvider;

class AppServiceProvider extends ServiceProvider {

    /**
     * All repositories
     *
     * @var array
     */
    protected $repositories = [
        'Account',
        'AccountMeta',
        'Player',
        'Reminder',
        'Guild',
        'Safebox',
        'Staff',
        'History'
    ];

    /**
     * Repository driver
     *
     * @var string
     */
    protected $repositoryDriver = 'Eloquent';

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        require __DIR__ . '/../helpers.php';

        $this->loadViewsFrom(base_path('resources/views/admin'), 'admin');

        $this->bootAuthProvider();

        require __DIR__ . '/../hooks.php';
    }



    /**
     * Boot the new auth for metin sites
     */
    protected function bootAuthProvider()
    {
        $this->app['auth']->extend('metin', function ($app) {
            return new MetinAuthProvider(
                $app->make('Metin2CMS\Entities\Account')
            );
        });
    }

    /**
     * Register any application services.
     *
     * This service provider is a great spot to register your various container
     * bindings with the application. As you can see, we are registering our
     * "Registrar" implementation here. You can add your own bindings too!
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'Illuminate\Contracts\Auth\Registrar',
            'Metin2CMS\Services\Registrar'
        );

        foreach ($this->repositories as $name)
        {
            $this->app->bind(
                'Metin2CMS\Repositories\\'.$name.'RepositoryInterface',
                'Metin2CMS\Repositories\\'.$this->repositoryDriver.'\\'.$name.'Repository'
            );
        }
    }

}

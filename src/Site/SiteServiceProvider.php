<?php namespace Metin2CMS\Site;

use Illuminate\Support\ServiceProvider;
use Metin2CMS\Site\Extensions\MetinAuthProvider;

class SiteServiceProvider extends ServiceProvider {

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
		$this->package('metin2cms/site', 'metin2cms/site', __DIR__);

        // Load default routes
        require __DIR__ . '/routes.php';

        // Load default filters

        require __DIR__ . '/filters.php';

        $this->bootAuthProvider();
    }

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
        $this->app->bind(
            'Metin2CMS\Site\Repositories\AccountRepositoryInterface',
            'Metin2CMS\Site\Repositories\Eloquent\AccountRepository'
        );

        $this->app->bind(
            'Metin2CMS\Site\Repositories\PlayerRepositoryInterface',
            'Metin2CMS\Site\Repositories\Eloquent\PlayerRepository'
        );

        $this->app->bind(
            'Metin2CMS\Site\Repositories\ReminderRepositoryInterface',
            'Metin2CMS\Site\Repositories\Eloquent\ReminderRepository'
        );

        $this->app->bind(
            'Metin2CMS\Site\Repositories\GuildRepositoryInterface',
            'Metin2CMS\Site\Repositories\Eloquent\GuildRepository'
        );

        $this->app->bind(
            'Metin2CMS\Site\Repositories\SafeboxRepositoryInterface',
            'Metin2CMS\Site\Repositories\Eloquent\SafeboxRepository'
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
                $this->app->make('Metin2CMS\Site\Entities\Account')
            );
        });
    }
}

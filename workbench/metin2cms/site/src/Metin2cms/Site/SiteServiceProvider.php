<?php namespace Metin2cms\Site;

use Illuminate\Support\ServiceProvider;
use Metin2cms\Site\Extensions\MetinAuthProvider;

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
		$this->package('metin2cms/site');

        $this->bootAuthProvider();

        require __DIR__ . '/../../filters.php';
        require __DIR__ . '/../../routes.php';
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
        $this->app->bind(
            'Metin2cms\Site\Repositories\AccountRepositoryInterface',
            'Metin2cms\Site\Repositories\Eloquent\AccountRepository'
        );

        $this->app->bind(
            'Metin2cms\Site\Repositories\PlayerRepositoryInterface',
            'Metin2cms\Site\Repositories\Eloquent\PlayerRepository'
        );

        $this->app->bind(
            'Metin2cms\Site\Repositories\ReminderRepositoryInterface',
            'Metin2cms\Site\Repositories\Eloquent\ReminderRepository'
        );

        $this->app->bind(
            'Metin2cms\Site\Repositories\GuildRepositoryInterface',
            'Metin2cms\Site\Repositories\Eloquent\GuildRepository'
        );

        $this->app->bind(
            'Metin2cms\Site\Repositories\SafeboxRepositoryInterface',
            'Metin2cms\Site\Repositories\Eloquent\SafeboxRepository'
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
                $this->app->make('Metin2cms\Site\Entities\Account')
            );
        });
    }
}

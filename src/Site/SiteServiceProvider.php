<?php namespace Metin2CMS\Site;

use Illuminate\Support\ServiceProvider;

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

        $this->registerRoutes();

        require __DIR__ . '/filters.php';
    }

    public function registerRoutes()
    {
        $this->app['router']->group(array('namespace' => 'Metin2CMS\Site\Controllers'), function()
        {
            require __DIR__ . '/routes.php';
        });
    }

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
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

}

<?php namespace Metin2CMS\Admin;

use Illuminate\Support\ServiceProvider;

class AdminServiceProvider extends ServiceProvider {

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
		$this->package('metin2cms/admin', 'metin2cms/admin', __DIR__);

        $this->registerViews();

        // Load default routes
        require __DIR__ . '/routes.php';

        // Load default filters

        require __DIR__ . '/filters.php';
    }

    /**
     * Register admin views
     */
    public  function registerViews()
    {
        $this->app['view']->addLocation(__DIR__ . '/../../themes/admin');
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

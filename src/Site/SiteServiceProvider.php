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

        // Load default routes
        require __DIR__ . '/routes.php';

        // Load default filters

        require __DIR__ . '/filters.php';

        $this->registerViews();
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

    /**
     * Register a new path for theme usage
     */
    public function registerViews()
    {
        $theme = $this->app['config']->get('theme.current');

        $this->app['view']->addLocation(__DIR__ . '/../../themes/'.$theme);
    }

}

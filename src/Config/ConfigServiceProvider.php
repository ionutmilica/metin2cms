<?php namespace Metin2CMS\Config;

use Illuminate\Support\ServiceProvider;

class ConfigServiceProvider extends ServiceProvider {

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
		$this->package('metin2cms/config', 'metin2cms/config', __DIR__);

		$this->registerViews();
		
        require __DIR__ . '/hooks.php';
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

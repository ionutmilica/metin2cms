<?php namespace Metin2CMS\Admin;

use Illuminate\Support\ServiceProvider;
use Metin2CMS\Admin\Handlers\AccountEventHandler;

class AdminServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

    protected $subscribers = array(
        'Metin2CMSAccountEventHandler'
    );

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('metin2cms/admin', 'metin2cms/admin', __DIR__);

        $this->registerViews();

        $this->registerSubscribers();

        $this->registerRoutes();

        // Load default filters

        require __DIR__ . '/filters.php';
    }

    /**
     * Register admin routes
     */
    public function registerRoutes()
    {
        $this->app['router']->group(array(
            'namespace' => 'Metin2CMS\Admin\Controllers',
            'prefix' => 'admin',
            'before' => 'admin.auth'), function()
        {
            require __DIR__ . '/routes.php';
        });
    }

    /**
     * Register admin views
     */
    public  function registerViews()
    {
        $this->app['view.finder']->addNamespace('admin', array(__DIR__ . '/../../themes/admin'));
    }

    /**
     * Register admin event subscribers
     */
    public function registerSubscribers()
    {
        $app = $this->app;

        $this->app['events']->subscribe(new AccountEventHandler($app));
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

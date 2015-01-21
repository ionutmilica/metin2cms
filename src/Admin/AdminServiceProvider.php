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

        $this->registerResources();

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
     * Register admin event subscribers
     */
    public function registerSubscribers()
    {
        $app = $this->app;

        $this->app['events']->subscribe(new AccountEventHandler($app));
    }

    /**
     * Register admin resources
     */
    public function registerResources()
    {
        $this->app['view.finder']->addNamespace('admin', $this->getResourcePath('views'));
        $this->app['config']->addNamespace('admin', $this->getResourcePath('config'));
        $this->app['translator']->addNamespace('admin', $this->getResourcePath('lang'));
    }

    /**
     * Prepare a path for the resources
     *
     * @param $resource
     * @return string
     */
    protected function getResourcePath($resource)
    {
        return __DIR__ . '/Resources/'.$resource.'/';
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

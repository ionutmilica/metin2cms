<?php namespace Metin2CMS\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel {

    /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware = [
        'Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode',
        'Illuminate\Cookie\Middleware\EncryptCookies',
        'Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse',
        'Illuminate\Session\Middleware\StartSession',
        'Illuminate\View\Middleware\ShareErrorsFromSession',
        'Metin2CMS\Http\Middleware\VerifyCsrfToken',
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => 'Metin2CMS\Http\Middleware\Authenticate',
        'auth.admin' => 'Metin2CMS\Http\Middleware\AdminAuthenticate',
        'auth.basic' => 'Illuminate\Auth\Middleware\AuthenticateWithBasicAuth',
        'guest' => 'Metin2CMS\Http\Middleware\RedirectIfAuthenticated',
    ];

}

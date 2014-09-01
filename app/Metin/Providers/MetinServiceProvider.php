<?php

namespace Metin\Providers;

use Illuminate\Support\ServiceProvider;
use Metin\Extensions\MetinAuthProvider;

class MetinServiceProvider extends ServiceProvider {

    public function boot()
    {
        $this->app['auth']->extend('metin', function ($app)
        {
            return new MetinAuthProvider(
                $this->app->make('Metin\Entities\Account')
            );
        });
    }

    public function register()
    {
    }
}
<?php

namespace Metin\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider {

    public function register()
    {
        $this->app->bind(
            'Metin\Repositories\AccountRepositoryInterface',
            'Metin\Repositories\Eloquent\AccountRepository'
        );
    }
}
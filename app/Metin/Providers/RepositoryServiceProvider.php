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

        $this->app->bind(
            'Metin\Repositories\PlayerRepositoryInterface',
            'Metin\Repositories\Eloquent\PlayerRepository'
        );

        $this->app->bind(
            'Metin\Repositories\ReminderRepositoryInterface',
            'Metin\Repositories\Eloquent\ReminderRepository'
        );

        $this->app->bind(
            'Metin\Repositories\SafeboxRepositoryInterface',
            'Metin\Repositories\Eloquent\SafeboxRepository'
        );
    }
}
<?php namespace Themes\Standard;

use Illuminate\Support\ServiceProvider;

class ThemeServiceProvider extends ServiceProvider {

    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/resources/views/', 'standard');
    }

    public function register()
    {
    }

}
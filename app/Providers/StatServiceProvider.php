<?php

namespace App\Providers;

use App\Services\StatRobot;
use Illuminate\Support\ServiceProvider;

class StatServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton(StatRbotot::class, function($app) {
            return new StatRobot($app->make('App\Robot'));
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

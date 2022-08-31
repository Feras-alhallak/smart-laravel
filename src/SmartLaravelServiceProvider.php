<?php

namespace Ferasalhallak\SmartLaravel;

use Illuminate\Support\ServiceProvider;

class SmartLaravelServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * Used to initialize some routes or add an event listener.
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * Used to bind our package to the classes inside the app container
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        $this->publishes([
            __DIR__.'/../docker' => base_path('/'),
        ]);

    }
}

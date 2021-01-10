<?php

namespace RakibDevs\Covid19;

use Illuminate\Support\ServiceProvider;

class Covid19ServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->make('RakibDevs\Covid19\Covid19');
        $this->publishes([
            __DIR__ . '/config/covid.php' => config_path('covid.php'),
        ]);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Parsedown;

class ParsedownServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->singleton(Parsedown::class, function() {
            return new Parsedown();
        });
    }
}

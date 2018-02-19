<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Workhorse;

class WorkhorseServiceProvider extends ServiceProvider
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
        $this->app->singleton(Workhorse::class, function () {
            return new Workhorse();
        });
    }
}

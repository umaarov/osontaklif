<?php

namespace App\Providers;

use App\Services\HhService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    final function register(): void
    {
        $this->app->singleton(HhService::class, function ($app) {
            return new HhService();
        });
    }

    final function boot(): void
    {
        //
    }
}

<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Railway menggunakan reverse proxy yang menghandle SSL termination.
        // Tanpa ini, Laravel akan generate URL http:// yang diblokir browser (Mixed Content Error).
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }
    }
}

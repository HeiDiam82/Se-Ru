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
        // Memaksa HTTPS jika APP_URL diset ke https:// (berguna jika APP_ENV di Railway masih local)
        if (str_contains(env('APP_URL'), 'https://') || $this->app->environment('production')) {
            URL::forceScheme('https');
        }
    }
}

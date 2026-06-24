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
        // Ensure route()/url() always have a {locale} default — even outside the
        // locale-prefixed route group (e.g. error pages). The SetLocale
        // middleware overrides this per request.
        URL::defaults(['locale' => app()->getLocale()]);
    }
}

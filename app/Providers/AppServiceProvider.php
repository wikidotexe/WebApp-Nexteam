<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        // Jika ingin setting khusus saat local bisa ditaruh di sini
        if (config('app.env') === 'local') {
            // Contoh: paksa HTTPS di local (opsional)
            $this->app['request']->server->set('HTTP', true);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Paksa Laravel generate URL dengan HTTPS jika bukan local environment
        if (config('app.env') !== 'local') {
            URL::forceScheme('http');
        }

        // Gunakan Bootstrap 5 untuk pagination
        Paginator::useBootstrapFive();
    }
}

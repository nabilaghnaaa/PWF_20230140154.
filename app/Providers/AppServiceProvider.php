<?php

namespace App\Providers;

use Dedoc\Scramble\Scramble;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

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
        /*
        |--------------------------------------------------------------------------
        | Scramble API Documentation
        |--------------------------------------------------------------------------
        | Konfigurasi agar Scramble hanya membaca route dengan prefix api/.
        */
        Scramble::configure()
            ->routes(function (Route $route) {
                return Str::startsWith($route->uri, 'api/');
            });

        /*
        |--------------------------------------------------------------------------
        | Gate: View API Docs
        |--------------------------------------------------------------------------
        | Agar dokumentasi API bisa dilihat saat production.
        */
        Gate::define('viewApiDocs', function () {
            return true;
        });

        /*
        |--------------------------------------------------------------------------
        | Gate: Export Product
        |--------------------------------------------------------------------------
        | Hanya admin yang boleh export data product.
        */
        Gate::define('export-product', function ($user) {
            return $user->role === 'admin';
        });

        /*
        |--------------------------------------------------------------------------
        | Gate: Manage Products
        |--------------------------------------------------------------------------
        | Membatasi akses CRUD product hanya untuk admin.
        */
        Gate::define('manage-products', function ($user) {
            return $user->role === 'admin';
        });
    }
}
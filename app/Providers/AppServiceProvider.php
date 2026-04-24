<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
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
    // GATE: Export Product
    // Hanya admin yang boleh export data product
    Gate::define('export-product', function ($user) {
        return $user->role === 'admin';
    });

    // GATE: Manage Products
    // Membatasi akses CRUD product hanya untuk admin
    Gate::define('manage-products', function ($user) {
        return $user->role === 'admin';
    });
}
}
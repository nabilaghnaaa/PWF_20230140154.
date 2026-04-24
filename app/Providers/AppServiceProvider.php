<?php // Deklarasi blok PHP untuk kode server-side

namespace App\Providers; // Menentukan namespace untuk class ini

use Illuminate\Support\Facades\Gate; // Import Gate facade untuk authorization
use Illuminate\Support\Facades\Auth; // Import Auth facade untuk autentikasi
use Illuminate\Support\ServiceProvider; // Import class ServiceProvider dari Laravel

class AppServiceProvider extends ServiceProvider // Deklarasi class AppServiceProvider yang extends ServiceProvider
{ // Buka blok class
    /**
     * Register any application services.
     */
    public function register(): void // Fungsi untuk register service ke container (return void)
    { // Buka blok fungsi
        // // Tidak ada service yang di-register
    } // Tutup blok fungsi

    /**
     * Bootstrap any application services.
     */
    public function boot(): void // Fungsi untuk bootstrap service (dijalankan setelah semua service di-register, return void)
    { // Buka blok fungsi
        // GATE: Export Product
        // Hanya admin yang boleh export data product
        Gate::define('export-product', function ($user) { // Definisi gate 'export-product' - mengecek apakah user boleh export product
            return $user->role === 'admin'; // Return true jika user memiliki role admin
        }); // Tutup define gate

        // GATE: Manage Products
        // Membatasi akses CRUD product hanya untuk admin
        Gate::define('manage-products', function ($user) { // Definisi gate 'manage-products' - mengecek apakah user boleh manage product (CRUD)
            return $user->role === 'admin'; // Return true jika user memiliki role admin
        }); // Tutup define gate
    } // Tutup blok fungsi
} // Tutup blok class
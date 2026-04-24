<?php // Deklarasi blok PHP untuk kode server-side

namespace App\Providers; // Menentukan namespace untuk class ini

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider; // Import AuthServiceProvider dari Laravel
use Illuminate\Support\Facades\Gate; // Import Gate facade untuk authorization
use App\Models\Product; // Import model Product
use App\Policies\ProductPolicy; // Import policy ProductPolicy

class AuthServiceProvider extends ServiceProvider // Deklarasi class AuthServiceProvider yang extends ServiceProvider
{ // Buka blok class
    /**
     * The policy mappings for the application.
     */
    protected $policies = [ // Deklarasi property policies untuk mapping model ke policy
        Product::class => ProductPolicy::class, // Map model Product ke policy ProductPolicy
    ]; // Tutup array policies

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void // Fungsi untuk bootstrap authentication/authorization services (return void)
    { // Buka blok fungsi
        $this->registerPolicies(); // Daftarkan semua policies yang sudah didefinisikan

        // Gate export-product (admin only)
        Gate::define('export-product', function ($user) { // Definisi gate 'export-product' - mengecek apakah user boleh export product
            return $user->role === 'admin'; // Return true jika user memiliki role admin
        }); // Tutup define gate
    } // Tutup blok fungsi
} // Tutup blok class
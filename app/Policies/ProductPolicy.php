<?php // Deklarasi blok PHP untuk kode server-side

namespace App\Policies; // Menentukan namespace untuk class ini

use App\Models\Product; // Import model Product
use App\Models\User; // Import model User
use Illuminate\Auth\Access\Response; // Import class Response dari Laravel Auth

class ProductPolicy // Deklarasi class ProductPolicy untuk mengelola authorization produk
{ // Buka blok class
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool // Fungsi untuk mengecek apakah user boleh melihat semua product (return boolean)
    { // Buka blok fungsi
        return false; // Return false - user tidak boleh melihat semua product
    } // Tutup blok fungsi

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Product $product): bool // Fungsi untuk mengecek apakah user boleh melihat detail product (return boolean)
    { // Buka blok fungsi
        return false; // Return false - user tidak boleh melihat detail product
    } // Tutup blok fungsi

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool // Fungsi untuk mengecek apakah user boleh membuat product baru (return boolean)
    { // Buka blok fungsi
        return false; // Return false - user tidak boleh membuat product baru
    } // Tutup blok fungsi

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Product $product) // Fungsi untuk mengecek apakah user boleh update product
    { // Buka blok fungsi
        // Admin bisa edit apa saja. 
        // Jika user biasa, mereka hanya bisa edit jika mereka pemiliknya.
        if ($user->role === 'admin') { // Cek apakah user memiliki role admin
            return true; // Jika admin, return true - admin boleh edit semua product
        } // Tutup if
        
        return $user->id === $product->user_id; // Return true jika user ID sama dengan user_id product (user adalah pemilik)
    } // Tutup blok fungsi

    public function delete(User $user, Product $product) // Fungsi untuk mengecek apakah user boleh menghapus product
    { // Buka blok fungsi
        if ($user->role === 'admin') { // Cek apakah user memiliki role admin
            return true; // Jika admin, return true - admin boleh hapus semua product
        } // Tutup if
        
        return $user->id === $product->user_id; // Return true jika user ID sama dengan user_id product (user adalah pemilik)
    } // Tutup blok fungsi

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Product $product): bool // Fungsi untuk mengecek apakah user boleh restore product yang dihapus (return boolean)
    { // Buka blok fungsi
        return false; // Return false - user tidak boleh restore product
    } // Tutup blok fungsi

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Product $product): bool // Fungsi untuk mengecek apakah user boleh permanent delete product (return boolean)
    { // Buka blok fungsi
        return false; // Return false - user tidak boleh permanent delete product
    } // Tutup blok fungsi
} // Tutup blok class

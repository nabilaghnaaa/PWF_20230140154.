<?php // Deklarasi blok PHP untuk kode server-side

namespace App\Models; // Menentukan namespace untuk class ini

use Illuminate\Database\Eloquent\Model; // Import class Model dari Laravel Eloquent
use App\Models\User; // Import model User
use App\Models\Category; // Import model Category

class Product extends Model // Deklarasi class Product yang extends Model
{ // Buka blok class
    protected $fillable = ['name', 'qty', 'price', 'user_id', 'category_id']; // Tentukan field yang boleh di-assign secara mass assignment

    public function user() // Fungsi untuk mendapatkan relasi - Product milik seorang User (many-to-one)
    { // Buka blok fungsi
        return $this->belongsTo(User::class); // Return relasi belongsTo ke model User
    } // Tutup blok fungsi

    // RELASI KE CATEGORY
    public function category() // Fungsi untuk mendapatkan relasi - Product milik satu Category (many-to-one)
    { // Buka blok fungsi
        return $this->belongsTo(Category::class); // Return relasi belongsTo ke model Category
    } // Tutup blok fungsi
} // Tutup blok class
<?php // Deklarasi blok PHP untuk kode server-side

namespace App\Models; // Menentukan namespace untuk class ini

use Illuminate\Database\Eloquent\Model; // Import class Model dari Laravel Eloquent
use App\Models\Product; // Import model Product

class Category extends Model // Deklarasi class Category yang extends Model
{ // Buka blok class
    // FIELD YANG BOLEH DI-INSERT / UPDATE
    protected $fillable = ['name']; // Tentukan field yang boleh di-assign secara mass assignment (hanya field name)

    // RELASI: Category memiliki banyak Product
    public function products() // Fungsi untuk mendapatkan relasi - Category memiliki banyak Product (one-to-many)
    { // Buka blok fungsi
        return $this->hasMany(Product::class); // Return relasi hasMany ke model Product
    } // Tutup blok fungsi
} // Tutup blok class
<?php // Deklarasi blok PHP untuk kode server-side

namespace App\Models; // Menentukan namespace untuk class ini

use Illuminate\Database\Eloquent\Factories\HasFactory; // Import trait HasFactory untuk factory testing
use Illuminate\Database\Eloquent\Model; // Import class Model dari Laravel Eloquent

class Todo extends Model // Deklarasi class Todo yang extends Model
{ // Buka blok class
    use HasFactory; // Gunakan trait HasFactory untuk factory support
    
    protected $fillable = [ // Tentukan field yang boleh di-assign secara mass assignment
        'title', // Field title boleh di-assign
        'description', // Field description boleh di-assign
        'is_completed', // Field is_completed boleh di-assign
        'user_id', // Field user_id boleh di-assign
    ]; // Tutup array fillable

    public function user() // Fungsi untuk mendapatkan relasi - Todo milik seorang User (many-to-one)
    { // Buka blok fungsi
        return $this->belongsTo(User::class); // Return relasi belongsTo ke model User
    } // Tutup blok fungsi
} // Tutup blok class
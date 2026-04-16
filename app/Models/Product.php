<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // 1. Daftarkan kolom yang boleh diisi secara massal
    protected $fillable = ['name', 'quantity', 'price', 'user_id'];

    // 2. Buat relasi ke model User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
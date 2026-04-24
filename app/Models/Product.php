<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Category;

class Product extends Model
{
    protected $fillable = ['name', 'qty', 'price', 'user_id', 'category_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // RELASI KE CATEGORY
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Category extends Model
{
    // FIELD YANG BOLEH DI-INSERT / UPDATE
    protected $fillable = ['name'];

    // RELASI: Category memiliki banyak Product
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
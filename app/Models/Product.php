<?php // Deklarasi blok PHP untuk kode server-side

namespace App\Models; // Menentukan namespace untuk class ini

use Illuminate\Database\Eloquent\Model; // Import class Model dari Laravel Eloquent
use App\Models\User; // Import model User
use App\Models\Category; // Import model Category

class Product extends Model
{
    protected $fillable = [
        'user_id',
        'category_id',
        'name',
        'price',
        'stock',
        'description',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
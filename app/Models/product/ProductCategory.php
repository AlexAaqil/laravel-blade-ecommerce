<?php

namespace App\Models\product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $fillable = [
        'title',
        'slug',
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }
}

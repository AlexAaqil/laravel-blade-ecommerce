<?php

namespace App\Models\product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductMeasurement extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $fillable = [
        'unit',
        'value',
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'measurement_id');
    }
}

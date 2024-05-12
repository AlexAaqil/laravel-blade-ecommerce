<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductMeasurement extends Model
{
    use HasFactory;

    protected $fillable = [
        'measurement_name',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'measurement_id');
    }
}

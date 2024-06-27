<?php

namespace App\Models\product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'image',
        'ordering',
        'product_id',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getProductImageUrl() {
        if(!empty($this->image)) {
            return url('storage/' . $this->image);
        }
        else {
            return asset('assets/images/default_image.jpg');
        }
    }
}

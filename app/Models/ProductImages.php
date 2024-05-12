<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImages extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'product_id',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getProductImageURL() {
        if(!empty($this->image)) {
            return url('storage/'.$this->image);
        }
        else {
            return asset('assets/images/default_product.jpg');
        }
    }
}

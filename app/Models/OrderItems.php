<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItems extends Model
{
    use HasFactory;

    public function sale()
    {
        return $this->belongsTo(Sale::class, 'order_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

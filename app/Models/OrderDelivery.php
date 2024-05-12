<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDelivery extends Model
{
    use HasFactory;

    public function order()
    {
        return $this->belongsTo(Sale::class, 'order_id');
    }
}

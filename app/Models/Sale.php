<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'order_type',
        'discount_code',
        'discount',
        'total_amount',
        'payment_status',
        'payment_method',
        'amount_paid',
        'user_id',
    ];

    public function order_delivery()
    {
        return $this->hasOne(OrderDelivery::class, 'order_id');
    }

    public function order_items()
    {
        return $this->hasMany(OrderItems::class, 'order_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    static public function getOrders()
    {
        return self::select('sales.*')
        ->where('order_type', 1)
        ->orderBy('id','desc')
        ->get();
    }
}

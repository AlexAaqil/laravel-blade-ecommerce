<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryArea extends Model
{
    use HasFactory;

    protected $fillable = [
        'delivery_location_id',
        'area_name',
        'price',
    ];

    public function delivery_location()
    {
        return $this->belongsTo(DeliveryLocation::class, 'delivery_location_id');
    }
}

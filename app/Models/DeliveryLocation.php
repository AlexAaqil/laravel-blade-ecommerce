<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DeliveryLocation extends Model
{
    use HasFactory;

    protected $fillable = [
        'location_name',
    ];

    public function delivery_areas()
    {
        return $this->hasMany(DeliveryArea::class);
    }
}

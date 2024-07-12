<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference_number',
        'sale_type',
        'total_amount',
        'discount',
        'discount_id',
        'user_id',
    ];
}

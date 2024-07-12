<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'payment_method',
        'merchant_request_id',
        'checkout_request_id',
        'transaction_reference',
        'response_code',
        'response_description',
        'payment_details',
        'amount_paid',
        'payment_date',
        'sale_id',
    ];
}

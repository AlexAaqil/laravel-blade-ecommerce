<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'order_reference',
        'email',
        'merchant_request_id',
        'checkout_request_id',
        'result_code',
        'result_description',
        'phone_number',
        'amount_paid',
        'transaction_receipt_number',
        'payment_status',
    ];
}

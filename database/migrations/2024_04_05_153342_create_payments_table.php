<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('order_reference');
            $table->string('email');
            $table->string('merchant_request_id');
            $table->string('checkout_request_id');
            $table->unsignedSmallInteger('result_code');
            $table->string('result_description');
            $table->string('phone_number');
            $table->decimal('amount_paid', 10, 2);
            $table->string('transaction_receipt_number');
            $table->unsignedTinyInteger('payment_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};

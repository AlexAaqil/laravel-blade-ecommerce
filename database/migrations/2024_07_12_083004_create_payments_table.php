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
            $table->string('status');
            $table->string('payment_method');
            $table->string('merchant_request_id');
            $table->string('checkout_request_id');
            $table->string('transaction_reference');
            $table->string('response_code');
            $table->string('response_description');
            $table->json('payment_details')->nullable();
            $table->decimal('amount_paid', 10, 2)->nullable()->default(0.00);
            $table->date('payment_date')->nullable();
            
            $table->foreignId('sale_id')->constrained('sales')->onDelete('cascade');
            
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

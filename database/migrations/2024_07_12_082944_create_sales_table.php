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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('reference_number')->unique();
            $table->unsignedTinyInteger('sale_type')->default(0); // 0 - ecommerce, 1 - in_store
            $table->decimal('total_amount', 10,2)->default(0.00);
            $table->decimal('discount', 10,2)->default(0.00);
            
            $table->foreignId('discount_id')->nullable()->constrained('discounts')->onDelete('set null');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};

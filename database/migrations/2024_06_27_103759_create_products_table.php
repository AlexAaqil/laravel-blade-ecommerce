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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_code')->nullable();
            $table->string('title')->unique();
            $table->string('slug')->index();
            $table->boolean('is_featured')->default(0);
            $table->boolean('is_visible')->default(1);
            $table->decimal('buying_price', 10, 2)->default(0.00);
            $table->decimal('selling_price', 10, 2)->default(0.00);
            $table->unsignedSmallInteger('ordering')->default(100);
            $table->unsignedSmallInteger('stock_count')->default(0);
            $table->unsignedSmallInteger('safety_stock')->default(0);
            $table->text('description')->nullable();
            $table->decimal('discount_amount', 10, 2)->nullable()->default(0.00);
            $table->unsignedSmallInteger('discount_percentage')->nullable()->default(0);

            $table->foreignId('measurement_id')->nullable()->constrained('product_measurements')->onDelete('set null');
            $table->foreignId('category_id')->nullable()->constrained('product_categories')->onDelete('set null');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

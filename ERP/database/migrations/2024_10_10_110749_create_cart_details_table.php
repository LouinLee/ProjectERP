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
        Schema::create('cart_details', function (Blueprint $table) {
            $table->string('cartdetail_code')->primary();
            $table->string('cart_code');
            $table->string('product_code');
            $table->integer('quantity');
            $table->decimal('subtotal', 15, 2);
            $table->timestamps();

            $table->foreign('cart_code')->references('cart_code')->on('carts')->onDelete('cascade');
            $table->foreign('product_code')->references('product_code')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_details');
    }
};

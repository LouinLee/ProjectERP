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
        Schema::create('order_details', function (Blueprint $table) {
            $table->string('orderdetail_code')->primary();
            $table->string('order_code');
            $table->string('product_code');
            $table->integer('quantity');
            $table->decimal('subtotal', 15, 2);
            $table->timestamps();

            $table->foreign('order_code')->references('order_code')->on('orders')->onDelete('cascade');
            $table->foreign('product_code')->references('product_code')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};

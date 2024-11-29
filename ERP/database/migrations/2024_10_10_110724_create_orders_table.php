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
        Schema::create('orders', function (Blueprint $table) {
            $table->string('order_code')->primary();
            $table->string('cart_code');
            $table->string('customer_code');
            $table->decimal('total_price', 15, 2);
            $table->string('status');
            $table->date('date');
            $table->timestamps();

            $table->foreign('cart_code')->references('cart_code')->on('carts')->onDelete('cascade');
            $table->foreign('customer_code')->references('customer_code')->on('customers')->onDelete('cascade');     
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};

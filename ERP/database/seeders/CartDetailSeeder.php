<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CartDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = DB::table('products')->pluck('price', 'product_code')->toArray();

        $cart_details = [
            [
                'cartdetail_code' => 'CD001',
                'cart_code' => 'CA001',
                'product_code' => 'PR001',
                'quantity' => 2,
                'subtotal' => 2 * $products['PR001'],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'cartdetail_code' => 'CD002',
                'cart_code' => 'CA001',
                'product_code' => 'PR002',
                'quantity' => 3,
                'subtotal' => 3 * $products['PR002'],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'cartdetail_code' => 'CD003',
                'cart_code' => 'CA001',
                'product_code' => 'PR003',
                'quantity' => 2,
                'subtotal' => 2 * $products['PR003'],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'cartdetail_code' => 'CD004',
                'cart_code' => 'CA002',
                'product_code' => 'PR004',
                'quantity' => 2,
                'subtotal' => 2 * $products['PR004'],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'cartdetail_code' => 'CD005',
                'cart_code' => 'CA002',
                'product_code' => 'PR005',
                'quantity' => 3,
                'subtotal' => 3 * $products['PR005'],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'cartdetail_code' => 'CD006',
                'cart_code' => 'CA003',
                'product_code' => 'PR003',
                'quantity' => 4,
                'subtotal' => 4 * $products['PR003'],
                'created_at' => now(),
                'updated_at' => now(),
            ],            [
                'cartdetail_code' => 'CD007',
                'cart_code' => 'CA003',
                'product_code' => 'PR001',
                'quantity' => 5,
                'subtotal' => 5 * $products['PR001'],
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Insert entries into the d_masuks table
        DB::table('cart_details')->insert($cart_details);
    }
}

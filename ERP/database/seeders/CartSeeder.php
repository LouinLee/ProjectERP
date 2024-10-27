<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = DB::table('customers')->pluck('customer_code')->toArray();

        // Membuat beberapa entri masuk
        $carts = [
            [
                'cart_code' => 'CA001',
                'customer_code' => $customers[array_rand($customers)], // Randomly select customer_code,
                'total_price' => 50000,
                'date' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'cart_code' => 'CA002',
                'customer_code' => $customers[array_rand($customers)], // Randomly select customer_code,
                'total_price' => 60000,
                'date' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'cart_code' => 'CA003',
                'customer_code' => $customers[array_rand($customers)], // Randomly select customer_code,
                'total_price' => 70000,
                'date' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('carts')->insert($carts);
    }
}

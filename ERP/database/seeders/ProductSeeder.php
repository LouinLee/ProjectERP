<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'product_code' => 'PR001',
                'product_name' => 'Product A',
                'unit' => 'pieces',
                'price' => 15000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_code' => 'PR002',
                'product_name' => 'Product B',
                'unit' => 'pieces',
                'price' => 10000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_code' => 'PR003',
                'product_name' => 'Product C',
                'unit' => 'pieces',
                'price' => 20000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_code' => 'PR004',
                'product_name' => 'Product D',
                'unit' => 'pieces',
                'price' => 5000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_code' => 'PR005',
                'product_name' => 'Product E',
                'unit' => 'pieces',
                'price' => 15000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Insert products into the barang table
        DB::table('products')->insert($products);
    }
}

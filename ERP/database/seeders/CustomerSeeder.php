<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;


class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 10; $i++) {
            DB::table('customers')->insert([
                'customer_code' => 'CU' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'customer_name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'address' => $faker->address,
                'phone_number' => $faker->phoneNumber,
                'password' => Hash::make('password'), // Default password
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

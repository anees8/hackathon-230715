<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Database\Seeders\SKUSeeder;
use Database\Seeders\SizeSeeder;
use Database\Seeders\TailorSeeder;
use Database\Seeders\OrderSeeder;
use Database\Seeders\DeliverySeeder;
use Database\Seeders\ProductTypeSeeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::create([
            'name' => 'admin',
            'email' => 'admin@yopmail.com',
            'password' => Hash::make('admin@123'), // password
        ]);

        $this->call([

            SizeSeeder::class,
            ProductTypeSeeder::class,
            SKUSeeder::class,
            TailorSeeder::class,
            OrderSeeder::class,
            DeliverySeeder::class,
            
        ]);

    }


}

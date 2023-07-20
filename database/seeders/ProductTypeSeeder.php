<?php

namespace Database\Seeders;
use App\Models\ProductType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       
        $product_types = [
            ['name' => 'shirt'],
            ['name' => 'tshirt'],
            ['name' => 'pant'],
            // Add more dummy sizes as needed
            ];

            foreach ($product_types as $product_type) {
                ProductType::create($product_type);
            }
    }
}

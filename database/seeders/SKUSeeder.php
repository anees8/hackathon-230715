<?php

namespace Database\Seeders;
use App\Models\Sku;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SKUSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $skus = [
            ['price' => 345.00, 'size_id' => 1],
            ['price' => 395.00, 'size_id' => 2],
            ['price' => 445.00, 'size_id' => 3],
            ['price' => 495.00, 'size_id' => 4],
            ['price' => 545.00, 'size_id' => 5],
            // Add more dummy SKUs as needed
        ];

        foreach ($skus as $sku) {
            Sku::create($sku);
        }
    }
}

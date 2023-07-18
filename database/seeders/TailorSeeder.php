<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tailor;

class TailorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tailors = [
            [
                'name' => 'John Doe',
                'commission_limit' => 1111.00,
                'daily_commission' => 0.00,
                'created_at' => now(),
            ],
            [
                'name' => 'Jane Smith',
                'commission_limit' => 1111.00,
                'daily_commission' => 0.00,
                'created_at' => now(),
            ],
            // Add more dummy tailors as needed
        ];

        foreach ($tailors as $tailor) {
            Tailor::create($tailor);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tailor;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

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
                'phone' => '9876543210',
                'password' => Hash::make('tailor@123'),
                'address' => '32/23 T Street F District , India',
                'commission_limit' => 1111.00,
                'total_commission' => 0.00,
                'created_at' => now(),
            ],
            [
                'name' => 'Jane Smith',
                'phone' => '9876543211',
                'password' => Hash::make('tailor@123'),
                'address' => '32/40 Z Street G District , India',
                'commission_limit' => 1111.00,
                'total_commission' => 0.00,
                'created_at' => now(),
            ],
            // Add more dummy tailors as needed
        ];
        
        foreach ($tailors as $tailor) {
            Tailor::create($tailor);
        }

        DB::table('tailor_product_type')->insert([

            ['tailor_id'=>1,'product_type_id'=>1],
            ['tailor_id'=>1,'product_type_id'=>2],
            ['tailor_id'=>1,'product_type_id'=>3],
            ['tailor_id'=>2,'product_type_id'=>1],
            ['tailor_id'=>2,'product_type_id'=>3],
        ]);


        
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Order;
use Faker\Factory as Faker;
use App\Models\Sku;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $faker = Faker::create();

        $orderCount = 1000; // Number of orders to generate per day
        $cartValue = 750; // Average cart value

        for ($i = 0; $i < $orderCount; $i++) {

            
            $order = new Order();
            $skuCount = rand(1, 5); 
            $order->cart_value = $cartValue;
            $order->sku_id = $skuCount;
            $qty = rand(1, 10); 
            $order->quantity =$qty ;
            $order->save();
            
            usleep(1000); // Wait for 1 millisecond between orders (adjust as needed)
        }
 
        

    }
}

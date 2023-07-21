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

        $skus = Sku::all();

        for ($i = 0; $i < $orderCount; $i++) {

            $sku = $skus->random();
            $order = new Order();
    
            $quantity = rand(1,3); 
            $totalPrice = $sku->price * $quantity;
            
            $order->sku_id =  $sku->id;
          
            $order->quantity =$quantity ;
            $order->total = $totalPrice;
            $order->save();
            
            usleep(1000); // Wait for 1 millisecond between orders (adjust as needed)
        }
 
        

    }
}

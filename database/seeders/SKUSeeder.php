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
            ['name' => 'Styched Font Yellow shirt','description'=>'Our graphic T-Shirts are, by far, the best that you can get your hands on! Easiest on the pocket and the best fabric that you can buy - Styched T-Shirts represent the youth - uncompromising, inspiring, young, unconventional and in a relentless pursuit to achieve greatness. A unique fusion technique...
','sku_code' => 'SKU43830667116788','price' => 350.00, 'product_type_id'=>1,'size_id' => 1],
            ['name' => 'Styched Font Yellow shirt','description'=>'Our graphic T-Shirts are, by far, the best that you can get your hands on! Easiest on the pocket and the best fabric that you can buy - Styched T-Shirts represent the youth - uncompromising, inspiring, young, unconventional and in a relentless pursuit to achieve greatness. A unique fusion technique...
','sku_code' => 'SKU43830667116788','price' => 350.00, 'product_type_id'=>1,'size_id' => 2],
            ['name' => 'Styched Font Yellow shirt','description'=>'Our graphic T-Shirts are, by far, the best that you can get your hands on! Easiest on the pocket and the best fabric that you can buy - Styched T-Shirts represent the youth - uncompromising, inspiring, young, unconventional and in a relentless pursuit to achieve greatness. A unique fusion technique...
','sku_code' => 'SKU43830667116788','price' => 350.00, 'product_type_id'=>1,'size_id' => 3],
            ['name' => 'Styched Font Yellow shirt','description'=>'Our graphic T-Shirts are, by far, the best that you can get your hands on! Easiest on the pocket and the best fabric that you can buy - Styched T-Shirts represent the youth - uncompromising, inspiring, young, unconventional and in a relentless pursuit to achieve greatness. A unique fusion technique...
','sku_code' => 'SKU43830667116788','price' => 350.00, 'product_type_id'=>1,'size_id' => 4],
            ['name' => 'Styched Font Yellow shirt','description'=>'Our graphic T-Shirts are, by far, the best that you can get your hands on! Easiest on the pocket and the best fabric that you can buy - Styched T-Shirts represent the youth - uncompromising, inspiring, young, unconventional and in a relentless pursuit to achieve greatness. A unique fusion technique...
','sku_code' => 'SKU43830667116788','price' => 350.00, 'product_type_id'=>1,'size_id' => 5],
            ['name' => 'Aag Laga Denge Graphic Printed Black Tshirt','description'=>'Our graphic T-Shirts are, by far, the best that you can get your hands on! Easiest on the pocket and the best fabric that you can buy - Styched T-Shirts represent the new India - uncompromising, inspiring, young, unconventional and in a relentless pursuit to achieve greatness. The T-Shirts are...
','sku_code' => 'SKU39389597630648','price' => 450.00, 'product_type_id'=>2,'size_id' => 1],
            ['name' => 'Aag Laga Denge Graphic Printed Black Tshirt','description'=>'Our graphic T-Shirts are, by far, the best that you can get your hands on! Easiest on the pocket and the best fabric that you can buy - Styched T-Shirts represent the new India - uncompromising, inspiring, young, unconventional and in a relentless pursuit to achieve greatness. The T-Shirts are...
','sku_code' => 'SKU39389597630648','price' => 450.00, 'product_type_id'=>2,'size_id' => 2],
            ['name' => 'Aag Laga Denge Graphic Printed Black Tshirt','description'=>'Our graphic T-Shirts are, by far, the best that you can get your hands on! Easiest on the pocket and the best fabric that you can buy - Styched T-Shirts represent the new India - uncompromising, inspiring, young, unconventional and in a relentless pursuit to achieve greatness. The T-Shirts are...
','sku_code' => 'SKU39389597630648','price' => 450.00, 'product_type_id'=>2,'size_id' => 3],
            ['name' => 'Aag Laga Denge Graphic Printed Black Tshirt','description'=>'Our graphic T-Shirts are, by far, the best that you can get your hands on! Easiest on the pocket and the best fabric that you can buy - Styched T-Shirts represent the new India - uncompromising, inspiring, young, unconventional and in a relentless pursuit to achieve greatness. The T-Shirts are...
','sku_code' => 'SKU39389597630648','price' => 450.00, 'product_type_id'=>2,'size_id' => 4],
            ['name' => 'Aag Laga Denge Graphic Printed Black Tshirt','description'=>'Our graphic T-Shirts are, by far, the best that you can get your hands on! Easiest on the pocket and the best fabric that you can buy - Styched T-Shirts represent the new India - uncompromising, inspiring, young, unconventional and in a relentless pursuit to achieve greatness. The T-Shirts are...
','sku_code' => 'SKU39389597630648','price' => 450.00, 'product_type_id'=>2,'size_id' => 5],
            // Add more dummy SKUs as needed
        ];

        foreach ($skus as $sku) {
            Sku::create($sku);
        }
    }
}

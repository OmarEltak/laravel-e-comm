<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductsImage;

class ProductsImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productImageRecords = [
            [ 'product_id' => 1, 'image' => '1722876982.jpg', 'status' => 1]
        ];
        ProductsImage::insert($productImageRecords);
    }
    
}

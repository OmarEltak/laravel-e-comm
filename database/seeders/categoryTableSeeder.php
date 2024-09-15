<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\category;

class categoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoryRecords = [
            ['id' => 1, 'parent_id' => 0, 'section_id' => 1, 'category_name' => 'T-Shirts', 'category_discount' => 0, 'description' => '', 'url' => 't-shirts', 'meta_title' => '', 'meta_description' => '', 'meta_keywords' => '', 'status' => 1, 'category_image' => ''],
            ['id' => 2, 'parent_id' => 1, 'section_id' => 1, 'category_name' => 'Casual T-Shirts', 'category_discount' => 0, 'description' => '', 'url' => 'casual-t-shirts', 'meta_title' => '', 'meta_description' => '', 'meta_keywords' => '', 'status' => 1, 'category_image' => ''],
        ];
        
        Category::insert($categoryRecords);
        
    }
}

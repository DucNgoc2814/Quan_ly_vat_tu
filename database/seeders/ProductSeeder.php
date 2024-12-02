<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            ['id' => 1, 'category_id' => 1, 'unit_id' => 9, 'slug' => 2, 'image' => '12312321', 'brand_id' => 2, 'name' => 'Xi măng Portland', 'description' => 'Xi măng Portland chất lượng cao, phù hợp cho các công trình xây dựng.', 'is_active' => 1],
            ['id' => 2, 'category_id' => 2, 'unit_id' => 7, 'slug' => 1, 'image' => '12312321', 'brand_id' => 2, 'name' => 'Gạch men 30x30', 'description' => 'Gạch men với kích thước 30x30 cm, phù hợp cho lát sàn và tường.', 'is_active' => 1],
            ['id' => 3, 'category_id' => 3, 'unit_id' => 3, 'slug' => 2, 'image' => '12312321', 'brand_id' => 2, 'name' => 'Sắt thép thanh 10mm', 'description' => 'Sắt thép chịu lực tốt, sử dụng cho các công trình xây dựng.', 'is_active' => 1],
            ['id' => 4, 'category_id' => 4, 'unit_id' => 3, 'slug' => 1, 'image' => '12312321', 'brand_id' => 2, 'name' => 'Vật liệu cách nhiệt XPS', 'description' => 'Vật liệu cách nhiệt XPS giúp giữ nhiệt và chống ẩm cho công trình.', 'is_active' => 1],
            ['id' => 5, 'category_id' => 5, 'unit_id' => 6, 'slug' => 2, 'image' => '12312321', 'brand_id' => 2, 'name' => 'Ống PVC', 'description' => 'Ống PVC chất lượng cao, phù hợp cho hệ thống cấp thoát nước.', 'is_active' => 1],
        ]);
    }   
}

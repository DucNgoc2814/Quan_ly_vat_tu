<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
           DB::table('categories')->insert([
            [
                'id'=>1,
                'name' => 'Xi măng',
                'sku' => 'CEM001',
                'image' => 'images/cement.jpg',
                'description' => 'Xi măng chất lượng cao cho xây dựng.',
            ],
            [
                'id'=>2,
                'name' => 'Gạch',
                'sku' => 'BRI002',
                'image' => 'images/bricks.jpg',
                'description' => 'Gạch xây dựng với nhiều kích cỡ và loại khác nhau.',
            ],
            [
                'id'=>3,
                'name' => 'Sắt thép',
                'sku' => 'STE003',
                'image' => 'images/steel.jpg',
                'description' => 'Sắt thép chịu lực cho các công trình xây dựng.',
            ],
            [
                'id'=>4,
                'name' => 'Vật liệu cách nhiệt',
                'sku' => 'INS004',
                'image' => 'images/insulation.jpg',
                'description' => 'Vật liệu cách nhiệt cho các công trình xây dựng.',
            ],
            [
                'id'=>5,
                'name' => 'Hệ thống ống nước',
                'sku' => 'PIP005',
                'image' => 'images/pipes.jpg',
                'description' => 'Ống nước và phụ kiện cho hệ thống cấp thoát nước.',
            ],
        ]);
    }
}

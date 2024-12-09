<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImportOrderDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create('vi_VN');
        
        // Tạo chi tiết đơn nhập hàng cho mỗi đơn nhập
        for ($importOrderId = 1; $importOrderId <= 100; $importOrderId++) {
            // Mỗi đơn nhập có 1-5 sản phẩm
            $numberOfProducts = rand(1, 5);
            
            for ($j = 0; $j < $numberOfProducts; $j++) {
                $variation = DB::table('variations')->find(rand(1, 100));
                $quantity = rand(10, 100);
                $price = rand(40000, 7000000); // Giá nhập thấp hơn giá bán
                
                DB::table('import_order_details')->insert([
                    'import_order_id' => $importOrderId,
                    'variation_id' => $variation->id,
                    'quantity' => $quantity,
                    'price' => $price,
                ]);
            }
        }
    }
}

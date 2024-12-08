<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create('vi_VN');
        
        // Tạo chi tiết đơn hàng cho mỗi đơn hàng
        for ($orderId = 1; $orderId <= 100; $orderId++) {
            // Mỗi đơn hàng có 1-5 sản phẩm
            $numberOfProducts = rand(1, 5);
            
            for ($j = 0; $j < $numberOfProducts; $j++) {
                $variation = DB::table('variations')->find(rand(1, 100));
                $quantity = rand(1, 10);
                
                DB::table('order_details')->insert([
                    'order_id' => $orderId,
                    'variation_id' => $variation->id,
                    'quantity' => $quantity,
                    'price' => $variation->retail_price,
                ]);
            }
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderCanceledSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orderCanceleds = [
            [
                'order_id' => 1,
                'note' => 'Khách hàng yêu cầu hủy do không còn nhu cầu.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => 2,
                'note' => 'Lỗi trong quá trình thanh toán.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => 3,
                'note' => 'Sản phẩm không còn trong kho.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => 4,
                'note' => 'Khách hàng thay đổi địa chỉ giao hàng.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($orderCanceleds as $orderCanceled) {
            DB::table('order_canceleds')->insert($orderCanceled);
        }
    }
}

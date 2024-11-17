<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderStatuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orderStatuses = [
            [
                'name' => 'Tạo đơn hàng',
                'description' => 'Đơn hàng đang được chờ xử lý',
            ],
            [
                'name' => 'Xác nhận',
                'description' => 'Đơn hàng đã được xác nhận',
            ],
            [
                'name' => 'Đang giao',
                'description' => 'Đơn hàng đang trong quá trình vận chuyển',
            ],
            [
                'name' => 'Thành công',
                'description' => 'Đơn hàng đã được giao thành công',
            ],
            [
                'name' => 'Hủy',
                'description' => 'Đơn hàng đã bị hủy',
            ],
        ];

        foreach ($orderStatuses as $status) {
            DB::table('order_statuses')->insert($status);
        }
    }
}

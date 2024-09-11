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
                'name' => 'Pending',
                'description' => 'Đơn hàng đang chờ xử lý.',
            ],
            [
                'name' => 'Processing',
                'description' => 'Đơn hàng đang được xử lý.',
            ],
            [
                'name' => 'Shipped',
                'description' => 'Đơn hàng đã được gửi đi.',
            ],
            [
                'name' => 'Delivered',
                'description' => 'Đơn hàng đã được giao đến khách hàng.',
            ],
            [
                'name' => 'Cancelled',
                'description' => 'Đơn hàng đã bị hủy.',
            ],
        ];

        foreach ($orderStatuses as $status) {
            DB::table('order_status')->insert($status);
        }
    }
}

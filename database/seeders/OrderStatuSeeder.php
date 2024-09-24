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
                'name' => 'Chờ xử lý',
                'description' => 'Chờ xử lý',
            ],
            [
                'name' => 'Đang xử lý',
                'description' => 'Đang xử lý',
            ],
            [
                'name' => 'Đang giao',
                'description' => 'Đang giao',
            ],
            [
                'name' => 'Thành công',
                'description' => 'Thành công',
            ],
            [
                'name' => 'Hủy',
                'description' => 'Hủy',
            ],
        ];

        foreach ($orderStatuses as $status) {
            DB::table('order_statuses')->insert($status);
        }
    }
}

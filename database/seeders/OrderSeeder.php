<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orders = [
            [
                'id' => 1,
                'customer_id' => 5,
                'status_id' => 1,
                'slug' => 'order-001',
                'customer_name' => 'Nguyễn Văn A',
                'email' => 'nguyenvana@example.com',
                'number_phone' => '0123456789',
                'province' => 'Tỉnh Hải Dương',
                'district' => 'Huyện Tứ Kỳ',
                'ward' => 'Xã Hưng Đạo',
                'address' => '123 Đường ABC, Quận 1, TP. Hồ Chí Minh',
                'total_amount' => 300000,
                'paid_amount' => 150000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id'=> 2,
                'customer_id' => 2,
                'status_id' => 2,
                'slug' => 'order-002',
                'customer_name' => 'Trần Thị B',
                'email' => 'tranthib@example.com',
                'number_phone' => '0987654321',
                'province' => 'Thành phố Hà Nội',
                'district' => 'Quận Hoàn Kiếm',
                'ward' => 'Phường Phúc Tân',
                'address' => '456 Đường XYZ',
                'total_amount' => 450000,
                'paid_amount' => 450000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id'=> 3,
                'customer_id' => 3,
                'status_id' => 3,
                'slug' => 'order-003',
                'customer_name' => 'Lê Văn C',
                'email' => 'levanc@example.com',
                'number_phone' => '0912345678',
                'province' => 'Thành phố Hồ Chí Minh',
                'district' => 'Quận 8',
                'ward' => 'Phường 04',
                'address' => '789 Đường DEF',
                'total_amount' => 120000,
                'paid_amount' => 60000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($orders as $order) {
            DB::table('orders')->insert($order);
        }
    }
}

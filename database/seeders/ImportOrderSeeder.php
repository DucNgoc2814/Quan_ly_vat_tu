<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImportOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $importOrders = [
            [
                'payment_id' => 1, 
                'supplier_id' => 1,
                'slug' => 'order-1',
                'customer_name' => 'Nguyễn Văn A',
                'email' => 'nguyenvana@example.com',
                'number_phone' => '0123456789',
                'address' => '123 Đường ABC, Quận 1, TP. Hồ Chí Minh',
                'total_amount' => 200000,
                'paid_amount' => 100000,
                'payable_amount' => 100000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'payment_id' => 2,
                'supplier_id' => 2,
                'slug' => 'order-2',
                'customer_name' => 'Trần Thị B',
                'email' => 'tranthib@example.com',
                'number_phone' => '0987654321',
                'address' => '456 Đường XYZ, Quận 2, TP. Hồ Chí Minh',
                'total_amount' => 500000,
                'paid_amount' => 300000,
                'payable_amount' => 200000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($importOrders as $order) {
            DB::table('import_orders')->insert($order);
        }
    }
}

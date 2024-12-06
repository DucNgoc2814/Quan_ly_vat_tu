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
                'supplier_id' => 1,
                'slug' => 'order-1',
                'status' => 1,
                'cancel_reason' => null,
                'total_amount' => 200000,
                'paid_amount' => 100000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'supplier_id' => 2,
                'slug' => 'order-2',
                'status' => 4,
                'cancel_reason' => 'không muốn',
                'total_amount' => 500000,
                'paid_amount' => 300000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($importOrders as $order) {
            DB::table('import_orders')->insert($order);
        }
    }
}

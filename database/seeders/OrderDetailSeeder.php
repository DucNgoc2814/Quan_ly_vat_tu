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
        $orderDetails = [
            [
                'order_id' => 1,
                'variation_id' => 1,
                'quantity' => 3,
                'price' => 50000,
            ],
            [
                'order_id' => 1,
                'variation_id' => null,
                'quantity' => 1,
                'price' => 75000,
            ],
            [
                'order_id' => 2,
                'variation_id' => 2,
                'quantity' => 2,
                'price' => 100000,
            ],
            [
                'order_id' => 2,
                'variation_id' => null,
                'quantity' => 5,
                'price' => 20000,
            ],
        ];

        foreach ($orderDetails as $detail) {
            DB::table('order_details')->insert($detail);
        }
    }
}

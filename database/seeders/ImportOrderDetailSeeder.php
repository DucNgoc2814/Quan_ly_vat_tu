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
        $importOrderDetails = [
            [
                'import_order_id' => 1,
                'product_id' => 1,
                'variation_id' => 1,     
                'quantity' => 10,
                'price' => 50000,
            ],
            [
                'import_order_id' => 1,
                'product_id' => 2,
                'variation_id' => null,
                'quantity' => 5,
                'price' => 75000,
            ],
            [
                'import_order_id' => 2,
                'product_id' => 3,
                'variation_id' => 2,
                'quantity' => 20,
                'price' => 100000,
            ],
        ];

        foreach ($importOrderDetails as $detail) {
            DB::table('import_order_details')->insert($detail);
        }
    }
}

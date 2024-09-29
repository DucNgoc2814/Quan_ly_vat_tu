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
                'id' => 1,
                'import_order_id' =>  1,
                'variation_id' =>  1,
                'quantity' =>  1,
                'price' =>  100
            ],
        ];

        foreach ($importOrderDetails as $detail) {
            DB::table('import_order_details')->insert($detail);
        }
    }
}

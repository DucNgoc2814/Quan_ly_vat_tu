<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InventorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $inventories = [
            [
                'product_id' => 1,
                'stock' => 100,
            ],
            [
                'product_id' => 2,
                'stock' => 50,
            ],
            [
                'product_id' => 3,
                'stock' => 200,
            ],
            [
                'product_id' => 4,
                'stock' => 0,
            ],
        ];

        foreach ($inventories as $inventory) {
            DB::table('inventories')->insert($inventory);
        }
    }
}

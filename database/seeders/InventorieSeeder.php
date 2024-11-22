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
                'name' => 1,
            ]
        ];

        foreach ($inventories as $inventory) {
            DB::table('inventories')->insert($inventory);
        }
    }
}

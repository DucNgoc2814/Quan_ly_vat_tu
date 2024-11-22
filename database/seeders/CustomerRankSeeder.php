<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CustomerRankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table(table: 'customer_ranks')->insert([
            [
                'id' => 1,
                'name' => 'Loại 1',
                'discount' => 0.5,
                'amount' => 10000000,
            ],
            [
                'id' => 2,
                'name' => 'Loại 2',
                'discount' => 1,
                'amount' => 50000000,
            ],
            [
                'id' => 3,
                'name' => 'Loại 3',
                'discount' => 1.5,
                'amount' => 200000000,
            ],
            [
                'id' => 4,
                'name' => 'Loại 4',
                'discount' => 2,
                'amount' => 500000000,
            ],
            [
                'id' => 5,
                'name' => 'Loại 5',
                'discount' => 3,
                'amount' => 1000000000,
            ],

        ]);
    }
}

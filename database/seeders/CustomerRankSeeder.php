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
                'name' => 'DISOCUNT10',
                'discount' => 10,
                'amount' => 1000000,
            ],
            [
                'id' => 2,
                'name' => 'DISOCUNT100',
                'discount' => 30,
                'amount' => 2000000,
            ],
        ]);
    }
}

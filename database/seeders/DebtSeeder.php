<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DebtSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('debts')->insert([
            [
                'debt_type_id' => 1, 
                'order_id' => 1,
            ],
            [
                'debt_type_id' => 2,
                'order_id' => 2,
            ],
            [
                'debt_type_id' => 1,
                'order_id' => 3,
            ],
        ]);
    }
}

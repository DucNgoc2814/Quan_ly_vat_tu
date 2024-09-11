<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TripDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('trip_details')->insert([
            [
                'id' => 1,
                'order_id' => 1,
                'trip_id' => 1,
                'total_amount' => 100
            ],
        ]);
    }
}

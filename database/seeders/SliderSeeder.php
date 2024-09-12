<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sliders')->insert([
            [
                'url' => '',
                'description' => 'ABC',
                'date_start' => '2024-05-05',
                'date_end' => '2024-05-06',
                'status' => true,
            ],
        ]);
    }
}

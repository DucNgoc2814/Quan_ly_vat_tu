<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('requests')->insert([
            [
                'employee_send' => 1,
                'employee_get' => 1,
                'title' => 'GGG',
                'content' => 'NGUYEN VAN A',
            ],
        ]);
    }
}

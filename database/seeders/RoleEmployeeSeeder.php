<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleEmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('role_employees')->insert([
            [
                'id' => 1,
                'name' => 'Nhan Vien',
                'wage' => 5000000,
            ],
            [
                'id' => 2,
                'name' => 'Quan ly kho',
                'wage' => 6000000,
            ],
            [
                'id' => 3,
                'name' => 'Ke toan',
                'wage' => 7000000,
            ],
        ]);
    }
}

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
                'name' => 'Tổng giám đốc',
                'wage' => 50000,
            ],
            [
                'id' => 2,
                'name' => 'Quản lý kho',
                'wage' => 40000,
            ],
            [
                'id' => 3,
                'name' => 'Kế toán',
                'wage' => 30000,
            ],
            [
                'id' => 4,
                'name' => 'Lái xe',
                'wage' => 20000,
            ],
        ]);
    }
}

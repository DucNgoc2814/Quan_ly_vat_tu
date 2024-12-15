<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleEmployeeSeeder extends Seeder
{
    public function run()
    {
        DB::table('role_employees')->insert([
            [
                'id' => 1,
                'name' => 'Admin',
                'wage' => 10000000
            ],
            [
                'id' => 2,
                'name' => 'Nhân viên kho', 
                'wage' => 8000000
            ],
            [
                'id' => 3,
                'name' => 'Nhân viên giao hàng',
                'wage' => 8000000 
            ]
        ]);
    }
}
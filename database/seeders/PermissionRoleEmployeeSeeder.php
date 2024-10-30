<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionRoleEmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table(table: 'permission_role_employees')->insert([
            [
                'permission_id' => 1,
                'role_employee_id' => 1,
            ],
            [
                'permission_id' => 2,
                'role_employee_id' => 1,
            ],
            [
                'permission_id' => 3,
                'role_employee_id' => 1,
            ],
            [
                'permission_id' => 4,
                'role_employee_id' => 1,
            ],
            [
                'permission_id' => 5,
                'role_employee_id' => 1,
            ],
            [
                'permission_id' => 6,
                'role_employee_id' => 1,
            ],
            [
                'permission_id' => 7,
                'role_employee_id' => 1,
            ],
            [
                'permission_id' => 8,
                'role_employee_id' => 1,
            ],
            [
                'permission_id' => 9,
                'role_employee_id' => 1,
            ],
            [
                'permission_id' => 10,
                'role_employee_id' => 1,
            ],
            [
                'permission_id' => 11,
                'role_employee_id' => 1,
            ],
            [
                'permission_id' => 12,
                'role_employee_id' => 1,
            ],
            [
                'permission_id' => 13,
                'role_employee_id' => 1,
            ],
        ]);
    }
}

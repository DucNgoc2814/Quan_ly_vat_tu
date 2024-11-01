<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionRoleEmployeeSeeder extends Seeder
{
    /**
     * Chạy database seeds.
     */
    public function run(): void
    {
        // Tạo mảng dữ liệu để insert
        $data = [];

        // Tạo 68 bản ghi với permission_id từ 1-68 và role_employee_id = 1
        for($i = 1; $i <= 73; $i++) {
            $data[] = [
                'permission_id' => $i,
                'role_employee_id' => 1,
            ];
        }

        // Insert dữ liệu vào bảng permission_role_employees
        DB::table('permission_role_employees')->insert($data);
    }
}

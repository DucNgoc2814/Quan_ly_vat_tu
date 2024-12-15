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
        // Lấy danh sách các permission_id hiện có
        $existingPermissionIds = DB::table('permissions')
            ->pluck('id')
            ->toArray();

        if (empty($existingPermissionIds)) {
            throw new \Exception('Không tìm thấy permissions nào. Vui lòng chạy PermissionSeeder trước.');
        }

        // Tạo mảng dữ liệu để insert
        $data = [];

        // Thêm permissions cho role_employee_id = 1
        foreach ($existingPermissionIds as $permissionId) {
            $data[] = [
                'permission_id' => $permissionId,
                'role_employee_id' => 1,
            ];
        }

        // Insert dữ liệu vào bảng permission_role_employees
        DB::table('permission_role_employees')->insert($data);
    }
}
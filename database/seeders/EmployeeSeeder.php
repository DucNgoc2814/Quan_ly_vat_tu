<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employees = [
            [
                'id' => 1,
                'role_id' => 1,
                'name' => 'Nguyễn Văn A',
                'email' => 'nguyenvana@example.com',
                'image' => 'nguyenvana.jpg',
                'cccd' => 123456789,
                'date' => 20220101,
                'description' => 'Nhân viên phát triển phần mềm.',
                'is_active' => true,
            ],
            [
                'id' => 2,
                'role_id' => 2,
                'name' => 'Trần Thị B',
                'email' => 'tranthib@example.com',
                'image' => 'tranthib.jpg',
                'cccd' => 987654321,
                'date' => 20220315,
                'description' => 'Nhân viên kế toán.',
                'is_active' => true,
            ],
            [
                'id' => 3,
                'role_id' => 3,
                'name' => 'Phạm Văn C',
                'email' => 'phamvanc@example.com',
                'image' => null,
                'cccd' => 135792468,
                'date' => 20220120,
                'description' => 'Nhân viên quản lý dự án.',
                'is_active' => false,
            ],
        ];

        foreach ($employees as $employee) {
            DB::table('employees')->insert(array_merge($employee, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}

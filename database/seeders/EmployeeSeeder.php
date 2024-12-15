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
                'name' => 'Phùng Đức Ngọc',
                'email' => 'admin@gmail.com',
                'image' => 'nguyenvana.jpg',
                'number_phone' => '012345677',
                'cccd' => 123456789,
                'date' => 20220101,
                'description' => 'Admin.',
                'is_active' => true,
                'password' => bcrypt('123456789'),
            ],
            [
                'id' => 4,
                'role_id' => 3,
                'name' => 'Nguyễn Văn Dũng',
                'email' => 'nguyenvandung@example.com',
                'image' => null,
                'number_phone' => '0123456784',
                'cccd' => 246813559,
                'date' => 20220121,
                'description' => 'Nhân viên lái xe.',
                'is_active' => true,
                'password' => bcrypt('123456789'),
            ],
            [
                'id' => 5,
                'role_id' => 3,
                'name' => 'Lê Văn Hùng',
                'email' => 'levanhung@example.com',
                'image' => null,
                'number_phone' => '0123456785',
                'cccd' => 357924681,
                'date' => 20220122,
                'description' => 'Nhân viên lái xe.',
                'is_active' => true,
                'password' => bcrypt('123456789'),
            ],
            [
                'id' => 6,
                'role_id' => 3,
                'name' => 'Phạm Văn Mạnh',
                'email' => 'phamvanmanh@example.com',
                'image' => null,
                'number_phone' => '0123456786',
                'cccd' => 468135792,
                'date' => 20220123,
                'description' => 'Nhân viên lái xe.',
                'is_active' => true,
                'password' => bcrypt('123456789'),
            ],
            [
                'id' => 7,
                'role_id' => 2,
                'name' => 'Trần Thị Hương',
                'email' => 'tranthihuong@example.com',
                'image' => null,
                'number_phone' => '0123456787',
                'cccd' => 579246813,
                'date' => 20220124,
                'description' => 'Nhân viên kho.',
                'is_active' => true,
                'password' => bcrypt('123456789'),
            ],
            [
                'id' => 8,
                'role_id' => 2,
                'name' => 'Nguyễn Thị Lan',
                'email' => 'nguyenthilan@example.com',
                'image' => null,
                'number_phone' => '0123456788',
                'cccd' => 681357924,
                'date' => 20220125,
                'description' => 'Nhân viên kho.',
                'is_active' => true,
                'password' => bcrypt('123456789'),
            ],
            [
                'id' => 9,
                'role_id' => 2,
                'name' => 'Hoàng Văn Thành',
                'email' => 'hoanvanthanh@example.com',
                'image' => null,
                'number_phone' => '0123456789',
                'cccd' => 792468135,
                'date' => 20220126,
                'description' => 'Nhân viên kho.',
                'is_active' => true,
                'password' => bcrypt('123456789'),
            ],
            [
                'id' => 10,
                'role_id' => 2,
                'name' => 'Đỗ Thị Mai',
                'email' => 'dothimai@example.com',
                'image' => null,
                'number_phone' => '0123456790',
                'cccd' => 813579246,
                'date' => 20220127,
                'description' => 'Nhân viên kho.',
                'is_active' => true,
                'password' => bcrypt('123456789'),
            ],
            [
                'id' => 11,
                'role_id' => 2,
                'name' => 'Vũ Văn Đức',
                'email' => 'vuvanduc@example.com',
                'image' => null,
                'number_phone' => '0123456791',
                'cccd' => 924681357,
                'date' => 20220128,
                'description' => 'Nhân viên kho.',
                'is_active' => true,
                'password' => bcrypt('123456789'),
            ],
            [
                'id' => 12,
                'role_id' => 2,
                'name' => 'Bùi Thị Ngọc',
                'email' => 'buithingoc@example.com',
                'image' => null,
                'number_phone' => '0123456792',
                'cccd' => 135792468,
                'date' => 20220129,
                'description' => 'Nhân viên kho.',
                'is_active' => true,
                'password' => bcrypt('123456789'),
            ],
            [
                'id' => 13,
                'role_id' => 2,
                'name' => 'Lý Văn Tùng',
                'email' => 'lyvantung@example.com',
                'image' => null,
                'number_phone' => '0123456793',
                'cccd' => 246813579,
                'date' => 20220130,
                'description' => 'Nhân viên kho.',
                'is_active' => true,
                'password' => bcrypt('123456789'),
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

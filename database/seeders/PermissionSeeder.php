<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table(table: 'permissions')->insert([
            [
                'id' => 1,
                'name' => 'Quản lý điều khiển',
            ],
            [
                'id' => 2,
                'name' => 'Quản lý danh mục',
            ],
            [
                'id' => 3,
                'name' => 'Quản lý thanh trượt',
            ],
            [
                'id' => 4,
                'name' => 'Quản lý sản phẩm',
            ],
            [
                'id' => 5,
                'name' => 'Quản lý phản hồi',
            ],
            [
                'id' => 6,
                'name' => 'Quản lý tài khoản',
            ],
            [
                'id' => 7,
                'name' => 'Quản lý hợp đồng',
            ],
            [
                'id' => 8,
                'name' => 'Quản lý xe',
            ],
            [
                'id' => 9,
                'name' => 'Quản lý nhân viên',
            ],
            [
                'id' => 10,
                'name' => 'Quản lý đơn hàng',
            ],
            [
                'id' => 11,
                'name' => 'Quản lý công nợ',
            ],
            [
                'id' => 12,
                'name' => 'Quản lý lịch sử thanh toán',
            ],
            [
                'id' => 13,
                'name' => 'Quản lý chuyến đi',
            ],
        ]);
    }
}

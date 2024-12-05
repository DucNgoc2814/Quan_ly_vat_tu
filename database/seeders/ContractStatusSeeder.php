<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContractStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hardData = [
            ['1', 'Trống'],
            ['2', 'Đã duyệt'],
            ['3', 'Đã hủy'],
            ['4', 'Đang chờ xác nhận'],
            ['5', 'Chờ khách hàng xác nhận'],
            ['6', 'Đang tiến hành'],
            ['7', 'Khách hàng không đồng ý với hợp đồng'],
            ['8', 'Hoàn thành'],
            ['9', 'Quá hạn'],
        ];
        foreach ($hardData as $data) {
            DB::table('contract_statuses')->insert([
                'id' => $data[0],
                'name' => $data[1],
            ]);
        }
    }
}

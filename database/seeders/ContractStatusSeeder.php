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
            ['1','Đang chờ duyệt'],
            ['2','Đã duyệt'],
            ['3','Đã hủy'],
            ['4','Quá hạn'],
            ['5','Đã hoàn thành']
        ];
        foreach ($hardData as $data) {
            DB::table('contract_statuses')->insert([
                'id' => $data[0],
                'name' => $data[1],
            ]);
        }
    }
}

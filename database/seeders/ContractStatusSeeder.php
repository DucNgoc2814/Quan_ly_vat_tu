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
            ['1','Đang chờ duyệt','Hợp đồng mới tạo, đang chờ phê duyệt từ cấp trên.'],
            ['2','Đã duyệt','Hợp đồng đã được phê duyệt và sẵn sàng thực hiện.'],
            ['3','Đã hủy','Hợp đồng bị hủy và không tiếp tục thực hiện.'],
            ['4','Quá hạn','Hợp đồng đã quá hạn mà chưa hoàn thành.'],
            ['5','Đã hoàn thành','Hợp đồng đã hoàn thành tất cả các yêu cầu.']
        ];
        foreach ($hardData as $data) {
            DB::table('contract_statuses')->insert([
                'id' => $data[0],
                'name' => $data[1],
                'description' => $data[2],
            ]);
        }
    }
}

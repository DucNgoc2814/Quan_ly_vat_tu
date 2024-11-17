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
            ['1','Trống','Hợp đồng mới tạo, đang chờ phê duyệt từ cấp trên.'],
            ['2','Đã duyệt','Hợp đồng đã được phê duyệt và sẵn sàng thực hiện.'],
            ['3','Đã hủy','Hợp đồng bị hủy và không tiếp tục thực hiện.'],
            ['4','Đang chờ xác nhận','Hợp đồng đã quá hạn mà chưa hoàn thành.'],
            ['5','Chờ khách hàng xác nhận','Hợp đồng đã hoàn thành tất cả các yêu cầu.'],
            ['6','Khách hàng đã xác nhận','Hợp đồng đã hoàn thành tất cả các yêu cầu.'],
            ['7','Khách hàng không đồng ý với hợp đồng','Hợp đồng đã hoàn thành tất cả các yêu cầu.'],
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

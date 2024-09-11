<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContractTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('contract_types')->insert([
            ['id' => 1, 'name' => 'Hợp đồng thanh toán', 'description' => 'Hợp đồng thanh toán Online'],
            ['id' => 2, 'name' => 'Hợp đồng thanh toán', 'description' => 'Hợp đồng thanh toán Offline'],
            ['id' => 3, 'name' => 'Hợp đồng thi công', 'description' => 'Hợp đồng liên quan đến việc thi công công trình xây dựng.'],
            ['id' => 4, 'name' => 'Hợp đồng cung cấp vật tư', 'description' => 'Hợp đồng liên quan đến việc cung cấp vật tư xây dựng cho dự án.'],
            ['id' => 5, 'name' => 'Hợp đồng thuê thiết bị', 'description' => 'Hợp đồng thuê thiết bị xây dựng cho công trình.'],
            ['id' => 6, 'name' => 'Hợp đồng bảo trì', 'description' => 'Hợp đồng bảo trì và sửa chữa công trình xây dựng.'],
            ['id' => 7, 'name' => 'Hợp đồng tư vấn', 'description' => 'Hợp đồng liên quan đến dịch vụ tư vấn xây dựng và kỹ thuật.'],

        ]);
    }
}

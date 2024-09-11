<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('payments')->insert([
            ['id' => 1, 'name' => 'Thanh toán bằng tiền mặt'],
            ['id' => 2, 'name' => 'Thanh toán qua thẻ momo'],
            ['id' => 3, 'name' => 'Thanh toán qua chuyển khoản ngân hàng'],
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DebtTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('debt_types')->insert([
            [
                'name' => 'Nợ vay',
                'description' => 'Khoản nợ phát sinh từ các khoản vay.',
            ],
            [
                'name' => 'Nợ tín dụng',
                'description' => 'Khoản nợ phát sinh từ các giao dịch tín dụng.',
            ],
            [
                'name' => 'Nợ hóa đơn',
                'description' => 'Khoản nợ phát sinh từ hóa đơn chưa thanh toán.',
            ],
            [
                'name' => 'Nợ thanh toán chậm',
                'description' => 'Khoản nợ do thanh toán chậm theo thỏa thuận.',
            ],
            [
                'name' => 'Nợ thuê',
                'description' => 'Khoản nợ phát sinh từ hợp đồng cho thuê chưa thanh toán.',
            ],
        ]);
    }
}

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
            ['id' => 1, 'name' => 'Tiền mặt'],
            ['id' => 2, 'name' => 'Momo'],
            ['id' => 3, 'name' => 'Chuyển Khoản'],
        ]);
    }
}

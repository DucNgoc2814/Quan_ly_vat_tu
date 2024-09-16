<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //\
        DB::table(table: 'customers')->insert([
            [
                'id' => 1,
                'customer_rank_id' => 1,
                'name' => 'Nguyen Van A',
                'email' => 'nguyenvana3@gmail.com',
                'password' => 'abc12345678',
                'number_phone' => '012345678',
                'image' => '',
                'amount' => 10000000,
                'is_active' => true,
            ],
            [
                'id' => 2,
                'customer_rank_id' => 1,
                'name' => 'Nguyen Van A',
                'email' => 'nguyenvana@gmail.com',
                'password' => 'abc12345678',
                'number_phone' => '012345672',
                'image' => '',
                'amount' => 10000000,
                'is_active' => true,
            ],
            [
                'id' => 3,
                'customer_rank_id' => 1,
                'name' => 'Nguyen Van A',
                'email' => 'nguyenvana2@gmail.com',
                'password' => 'abc12345678',
                'number_phone' => '012345671',
                'image' => '',
                'amount' => 10000000,
                'is_active' => true,
            ],
            [
                'id' => 4,
                'customer_rank_id' => 2,
                'name' => 'Nguyen Van A',
                'email' => 'nguyenvan123a@gmail.com',
                'password' => 'abc12345678',
                'number_phone' => '012345677',
                'image' => '',
                'amount' => 10000000,
                'is_active' => true,
            ],
        ]);
    }
}

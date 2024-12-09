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
                'id' => 5,
                'customer_rank_id' => 1,
                'name' => 'Khánh',
                'email' => 'quockhanhh129@gmail.com',
                'password' => 'abc12345678',
                'number_phone' => '0123456789',
                'image' => '',
                'total_amount' => 10000000,
                'is_active' => true,
            ],
            [
                'id' => 2,
                'customer_rank_id' => 1,
                'name' => 'Quân',
                'email' => 'dqdev204@gmail.com',
                'password' => 'abc12345678',
                'number_phone' => '0123456729',
                'image' => '',
                'total_amount' => 10000000,
                'is_active' => true,
            ],
            [
                'id' => 3,
                'customer_rank_id' => 1,
                'name' => 'Ngọc',
                'email' => 'phungducngoc1@gmail.com',
                'password' => 'abc12345678',
                'number_phone' => '0123456719',
                'image' => '',
                'total_amount' => 10000000,
                'is_active' => true,
            ],
            [
                'id' => 4,
                'customer_rank_id' => 2,
                'name' => 'Nguyen Van A',
                'email' => 'nguyenvan123a@gmail.com',
                'password' => 'abc12345678',
                'number_phone' => '0123456779',
                'image' => '',
                'total_amount' => 10000000,
                'is_active' => true,
            ],
        ]);
    }
}

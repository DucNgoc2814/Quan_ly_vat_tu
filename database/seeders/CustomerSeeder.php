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
                'customer_rank_id' => 2,
                'name' => 'Nguyen Van A',
                'email' => 'nguyenvana@gmail.com',
                'password' => 'abc12345678',
                'image' => '',
                'date' => '2004-05-06',
                'is_active' => true,
            ],
            [
                'id' => 2,
                'customer_rank_id' => 2,
                'name' => 'Nguyen Van A',
                'email' => 'nguyenvana@gmail.com',
                'password' => 'abc12345678',
                'image' => '',
                'date' => '2004-05-06',
                'is_active' => true,
            ],
            [
                'id' => 3,
                'customer_rank_id' => 2,
                'name' => 'Nguyen Van A',
                'email' => 'nguyenvana@gmail.com',
                'password' => 'abc12345678',
                'image' => '',
                'date' => '2004-05-06',
                'is_active' => true,
            ],
            [
                'id' => 4,
                'customer_rank_id' => 2,
                'name' => 'Nguyen Van A',
                'email' => 'nguyenvana@gmail.com',
                'password' => 'abc12345678',
                'image' => '',
                'date' => '2004-05-06',
                'is_active' => true,
            ],
        ]);
    }
}

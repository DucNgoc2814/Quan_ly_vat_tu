<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('suppliers')->insert([
            [
                'id' => 1,
                'name' => 'Nhà cung cấp 1',
                'email'=> 'ncc1@gmail.com',
                'number_phone'=> '0999999991',
                'address'=> 'VIET NAM',
            ],
            [
                'id' => 2,
                'name' => 'Nhà cung cấp 2',
                'email'=> 'ncc2@gmail.com',
                'number_phone'=> '0999999992',
                'address'=> 'VIET NAM',
            ],
            [
                'id' => 3,
                'name' => 'Nhà cung cấp 3',
                'email'=> 'ncc3@gmail.com',
                'number_phone'=> '0999999993',
                'address'=> 'VIET NAM',
            ],
            [
                'id' => 4,
                'name' => 'Nhà cung cấp 4',
                'email'=> 'ncc4@gmail.com',
                'number_phone'=> '0999999994',
                'address'=> 'VIET NAM',
            ],
            [
                'id' => 5,
                'name' => 'Nhà cung cấp 5',
                'email'=> 'ncc5@gmail.com',
                'number_phone'=> '0999999995',
                'address'=> 'VIET NAM',
            ],

        ]);
    }
}

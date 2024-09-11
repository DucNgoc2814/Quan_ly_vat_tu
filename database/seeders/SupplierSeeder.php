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
                'name' => 'VINFAST',
                'email'=> 'vinfast@gmail.com',
                'number_phone'=> '0999999999',
                'address'=> 'VIET NAM',
            ],
            [
                'id' => 2,
                'name' => 'a',
                'email'=> 'vinfast@gmail.com',
                'number_phone'=> '0999999999',
                'address'=> 'VIET NAM',
            ],
        ]);
    }
}

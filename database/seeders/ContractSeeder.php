<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ContractSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("contracts")->insert([
            'contract_status_id' => 1,
            'contract_name' => 'HD123456',
            'customer_name' => 'Khanh',
            'customer_phone' => '0964583628',
            'customer_email' => 'k@gmail.com',
        ]);
    }
}

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
            'contract_number' => '1',
            'customer_name' => '1',
            'customer_email' => '1',
            'total_amount' => '1',
            'number_phone' => '1',
            'file' =>  'a',
        ]);
    }
}

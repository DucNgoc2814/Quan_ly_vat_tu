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
            'contract_type_id' => 1,
            'oder_id' => 1,
            'name' => 'ABC',
            'file' => 'abc.pdf',
            'note' => 'hanglo',
        ]);
    }
}

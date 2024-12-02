<?php

namespace Database\Seeders;

use App\Models\Customer;
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
        $customer = Customer::first();
        DB::table("contracts")->insert([
            'contract_status_id' => 1,
            'employee_id' => 1,
            'customer_id' => $customer->id,
            'contract_number' => 'CT001',
            'customer_name' => 'Nguyễn Văn A',
            'customer_phone'    => '0123456789',
            'customer_email' => 'nguyenvana@gmail.com',
            'total_amount' => 1000000,
            'file' => 'file.pdf',
            'file_pdf' => 'file.pdf',
            'timestart' => now(),
            'timeend' => now(),
            'verification_token' => 'token123',
        ]);
    }
}

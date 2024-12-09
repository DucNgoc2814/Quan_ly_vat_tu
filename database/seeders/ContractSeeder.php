<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Str;

class ContractSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create('vi_VN');
        
        // Lấy danh sách employee_id có sẵn
        $employeeIds = DB::table('employees')->pluck('id')->toArray();
        
        // Lấy danh sách customer_id có sẵn
        $customerIds = DB::table('customers')->pluck('id')->toArray();
        
        if (empty($employeeIds)) {
            throw new \Exception('Không có nhân viên nào trong hệ thống. Vui lòng chạy EmployeeSeeder trước.');
        }
        
        if (empty($customerIds)) {
            throw new \Exception('Không có khách hàng nào trong hệ thống. Vui lòng chạy CustomerSeeder trước.');
        }
        
        for ($i = 1; $i <= 100; $i++) {
            $timestart = $faker->dateTimeBetween('-6 months', 'now');
            $timeend = $faker->dateTimeBetween($timestart, '+6 months');
            
            // Lấy thông tin khách hàng ngẫu nhiên
            $customerId = $faker->randomElement($customerIds);
            $customer = DB::table('customers')->find($customerId);
            
            DB::table('contracts')->insert([
                'contract_status_id' => rand(1, 9),
                'employee_id' => $faker->randomElement($employeeIds),
                'customer_id' => $customerId,
                'contract_number' => 'HDB' . str_pad($i, 5, '0', STR_PAD_LEFT),
                'customer_name' => $customer->name,
                'customer_phone' => $customer->number_phone,
                'customer_email' => $customer->email,
                'total_amount' => rand(10000000, 1000000000),
                'paid_amount' => rand(0, 1000000000),
                'file' => 'contracts/contract_' . $i . '.pdf',
                'file_pdf' => 'contracts/contract_' . $i . '.pdf',
                'timestart' => $timestart,
                'timeend' => $timeend,
                'verification_token' => Str::random(60),
                'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
                'updated_at' => now(),
            ]);
        }
    }
}

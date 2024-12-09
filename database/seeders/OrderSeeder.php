<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create('vi_VN');
        
        // Lấy danh sách status_id có sẵn
        $statusIds = DB::table('order_statuses')->pluck('id')->toArray();
        
        // Lấy danh sách customer_id có sẵn
        $customerIds = DB::table('customers')->pluck('id')->toArray();
        
        if (empty($statusIds)) {
            throw new \Exception('Không có trạng thái đơn hàng nào trong hệ thống. Vui lòng chạy OrderStatuSeeder trước.');
        }
        
        if (empty($customerIds)) {
            throw new \Exception('Không có khách hàng nào trong hệ thống. Vui lòng chạy CustomerSeeder trước.');
        }
        
        for ($i = 1; $i <= 100; $i++) {
            // Lấy thông tin khách hàng ngẫu nhiên
            $customerId = $faker->randomElement($customerIds);
            $customer = DB::table('customers')->find($customerId);
            
            DB::table('orders')->insert([
                'customer_id' => $customerId,
                'contract_id' => null,
                'status_id' => $faker->randomElement($statusIds),
                'slug' => 'DHB' . str_pad($i, 5, '0', STR_PAD_LEFT),
                'customer_name' => $customer->name,
                'email' => $customer->email,
                'number_phone' => $customer->number_phone,
                'province' => $faker->city,
                'district' => $faker->city,
                'ward' => $faker->streetName,
                'address' => $faker->address,
                'total_amount' => $totalAmount = rand(1000000, 100000000),
                'paid_amount' => $totalAmount,
                'cancel_reason' => null,
                'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
                'updated_at' => now(),
            ]);
        }
    }
}

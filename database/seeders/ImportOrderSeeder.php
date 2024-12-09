<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImportOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create('vi_VN');
        
        // Lấy danh sách supplier_id có sẵn
        $supplierIds = DB::table('suppliers')->pluck('id')->toArray();
        
        if (empty($supplierIds)) {
            throw new \Exception('Không có nhà cung cấp nào trong hệ thống. Vui lòng chạy SupplierSeeder trước.');
        }
        
        for ($i = 1; $i <= 100; $i++) {
            $total_amount = rand(10000000, 1000000000);
            $paid_amount = rand(0, $total_amount);
            
            DB::table('import_orders')->insert([
                'supplier_id' => $faker->randomElement($supplierIds), // Chọn ngẫu nhiên từ danh sách supplier_id có sẵn
                'slug' => 'DHN' . str_pad($i, 5, '0', STR_PAD_LEFT),
                'status' => rand(1, 4),
                'cancel_reason' => null,
                'total_amount' => $total_amount,
                'paid_amount' => $paid_amount,
                'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
                'updated_at' => now(),
            ]);
        }
    }
}

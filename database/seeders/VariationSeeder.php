<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VariationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create('vi_VN');
        
        for ($i = 1; $i <= 100; $i++) {
            $avgImportPrice = rand(50000, 8000000);
            $retailPrice = $avgImportPrice * 1.3; // Giá bán lẻ cao hơn 30%
            $wholesalePrice = $avgImportPrice * 1.2; // Giá bán sỉ cao hơn 20%
            
            DB::table('variations')->insert([
                'id' => $i,
                'product_id' => rand(1, 100),
                'name' => $faker->words(3, true),
                'sku' => 'VAR' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'retail_price' => $retailPrice,
                'stock' => rand(10, 1000),
                'avgImportPrice' => $avgImportPrice,
                'latestImportPrice' => $avgImportPrice,
                'is_active' => true,
            ]);
        }
    }
}

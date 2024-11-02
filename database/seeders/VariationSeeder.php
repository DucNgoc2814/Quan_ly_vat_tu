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
        DB::table('variations')->insert([
            ['id' => 1, 'product_id' => 1, 'sku' => 'VAR001', 'name' => 'Xi măng Portland 50kg', 'stock' => 100, 'price_export' => 550000,  'is_active' => 1],
            ['id' => 2, 'product_id' => 2, 'sku' => 'VAR002', 'name' => 'Gạch men 30x30 trắng', 'stock' => 200, 'price_export' => 160000, 'is_active' => 1],
            ['id' => 3, 'product_id' => 3, 'sku' => 'VAR003', 'name' => 'Sắt thép thanh 10mm', 'stock' => 50, 'price_export' => 2100000, 'is_active' => 1],
            ['id' => 4, 'product_id' => 4, 'sku' => 'VAR004', 'name' => 'XPS 50mm', 'stock' => 80, 'price_export' => 850000, 'is_active' => 1],
            ['id' => 5, 'product_id' => 5, 'sku' => 'VAR005', 'name' => 'Ống PVC 25mm', 'stock' => 150, 'price_export' => 65000, 'is_active' => 1],
        ]);
    }
}

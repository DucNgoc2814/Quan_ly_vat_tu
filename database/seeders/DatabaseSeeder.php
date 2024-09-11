<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ContractStatusSeeder::class,
            DebtTypeSeeder::class,
            PaymentSeeder::class,
            ContractTypeSeeder::class,
            UnitSeeder::class,
            CategorySeeder::class,
            BrandSeeder::class,
            ProductSeeder::class,
            GallerySeeder::class,
            FeedbackSeeder::class,
            InventorieSeeder::class,
            AttributeSeeder::class,
            AttributeValueSeeder::class,
            VariationSeeder::class,
            VariationAttributeValueSeeder::class,
            LocationSeeder::class,
            OrderStatuSeeder::class,
            OrderSeeder::class,
            OrderDetailSeeder::class,
            CargoCarTypeSeeder::class,
            DebtSeeder::class,
            PaymentHistorySeeder::class,
            EmployeeSeeder::class,
            OrderCanceledSeeder::class,
            ImportOrderSeeder::class,
            ImportOrderDetailSeeder::class,
        ]);
    }
}

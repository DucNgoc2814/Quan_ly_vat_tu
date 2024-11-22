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
            AttributeValueVariationSeeder::class,
            OrderStatuSeeder::class,
            CustomerRankSeeder::class,
            CustomerSeeder::class,
            OrderSeeder::class,
            OrderDetailSeeder::class,
            CargoCarTypeSeeder::class,
            DebtSeeder::class,
            RoleEmployeeSeeder::class,
            EmployeeSeeder::class,
            ContractSeeder::class,
            PaymentHistorySeeder::class,
            SupplierSeeder::class,
            OrderCanceledSeeder::class,
            ImportOrderSeeder::class,
            ImportOrderDetailSeeder::class,
            PermissionSeeder::class,
            CargoCarSeeder::class,
            PermissionRoleEmployeeSeeder::class,
            PublisherProductSeeder::class,
            RequestSeeder::class,
            SliderSeeder::class,
            TripSeeder::class,
            TripDetailSeeder::class

        ]);
    }
}

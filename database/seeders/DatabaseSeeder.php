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
            PermissionSeeder::class,
            RoleEmployeeSeeder::class,
            PermissionRoleEmployeeSeeder::class,
            ContractStatusSeeder::class,
            PaymentSeeder::class,
            UnitSeeder::class,
            CategorySeeder::class,
            BrandSeeder::class,
            ProductSeeder::class,
            VariationSeeder::class,
            CustomerRankSeeder::class,
            CustomerSeeder::class,
            EmployeeSeeder::class,
            OrderStatuSeeder::class,
            SupplierSeeder::class,
            ContractSeeder::class,
            OrderSeeder::class,
            OrderDetailSeeder::class,
            ImportOrderSeeder::class,
            ImportOrderDetailSeeder::class,
            GallerySeeder::class,
            FeedbackSeeder::class,
            InventorieSeeder::class,
            AttributeSeeder::class,
            AttributeValueSeeder::class,
            AttributeValueVariationSeeder::class,
            PaymentHistorySeeder::class,
            OrderCanceledSeeder::class,
            CargoCarTypeSeeder::class,
            CargoCarSeeder::class,
            PublisherProductSeeder::class,
            SliderSeeder::class,
            TripSeeder::class,
            TripDetailSeeder::class
        ]);
    }
}

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
            //  <+====================Tình====================+>
            AttributeSeeder::class,
            AttributeValueSeeder::class,
            BrandSeeder::class,
            CategorySeeder::class,
            CargoCarTypeSeeder::class,
            CategorySeeder::class,
            ContractStatusSeeder::class,
            ContractTypeSeeder::class,
            PaymentSeeder::class,
            ProductSeeder::class,
            UnitSeeder::class,
            VariationAttributeValueSeeder::class,
            VariationSeeder::class
            // <+====================Tình====================+>
        ]);
    }
}

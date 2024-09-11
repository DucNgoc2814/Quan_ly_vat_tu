<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            DebtTypeSeeder::class,
            GallerySeeder::class,
            FeedbackSeeder::class,
            InventorieSeeder::class,
            LocationSeeder::class,
            OrderStatuSeeder::class,
            OrderSeeder::class,
            OrderDetailSeeder::class,
            DebtSeeder::class,
            PaymentHistorySeeder::class,
            EmployeeSeeder::class,
            OrderCanceledSeeder::class,
            ImportOrderSeeder::class,
            ImportOrderDetailSeeder::class,
        ]);
    }
}

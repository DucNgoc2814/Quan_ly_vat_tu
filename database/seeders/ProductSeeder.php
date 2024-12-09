<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create('vi_VN');
        
        for ($i = 1; $i <= 100; $i++) {
            $name = $faker->words(3, true);
            DB::table('products')->insert([
                'id' => $i,
                'category_id' => rand(1, 5),
                'brand_id' => rand(1, 3),
                'unit_id' => rand(1, 5),
                'name' => $name,
                'slug' => Str::slug($name),
                'image' => 'products/product_' . $i . '.jpg',
                'description' => $faker->paragraph,
                'is_active' => true,
                'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
                'updated_at' => now(),
            ]);
        }
    }   
}

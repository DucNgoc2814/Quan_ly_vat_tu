<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VariationAttributeValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('variation_attribute_values')->insert([
            ['variation_id' => 1, 'attribute_value_id' => 1],
            ['variation_id' => 1, 'attribute_value_id' => 2],
            ['variation_id' => 2, 'attribute_value_id' => 3],
            ['variation_id' => 2, 'attribute_value_id' => 4],
            ['variation_id' => 3, 'attribute_value_id' => 5],
            ['variation_id' => 4, 'attribute_value_id' => 6],
            ['variation_id' => 4, 'attribute_value_id' => 7],
            ['variation_id' => 5, 'attribute_value_id' => 8],
        ]);
    }
}

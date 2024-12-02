<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hardData = ["Hoà Phát", "Tiền Phong", "Hải Phong"];
        $id = 1;
        foreach ($hardData as $item) {
            DB::table('brands')->insert([
                'id' =>  $id,
                'sku' => 'sku' . $id,
                'name' =>  $item,
            ]);
            $id++;
        }
    }
}

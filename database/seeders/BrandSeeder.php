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
         $hardData = ["Hoà Phát","Xi măng Hà Tiên","Viglacera","Fico","Nhựa Tiền Phong"];
            $id = 1;
        foreach ($hardData as $item) {
              DB::table('brands')->insert([
                  'id' =>  $id,
                  'name' =>  $item,
        ]);
                  $id++;
         }
    }
}

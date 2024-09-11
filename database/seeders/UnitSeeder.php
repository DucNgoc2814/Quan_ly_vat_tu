<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            $hardData = ['Mét','Lít','KG','Cái','Túi','Thanh', 'Viên','Thùng','Bao'];
            $id = 1;
        foreach ($hardData as $item) {
              DB::table('units')->insert([
                  'id' =>  $id,
                  'name' =>  $item,
        ]);
                  $id++;
         }
        //
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CargoCarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $hardData = [
            [
                
                'cargo_car_type_id' => 1,
                'license_plate' => '29C-123.45',
                'is_active' => 0,
            ],
            [
                'cargo_car_type_id' => 2,
                'license_plate' => '30D-678.90',
                'is_active' => 0,
            ],
            [
                'cargo_car_type_id' => 3,
                'license_plate' => '31E-234.56',
                'is_active' => 0,
            ],
            [
                'cargo_car_type_id' => 4,
                'license_plate' => '32F-789.00',
                'is_active' => 0,
            ],
            [
                'cargo_car_type_id' => 5,
                'license_plate' => '33G-345.67',
                'is_active' => 0,
            ],
        ];
        $id = 1;
        foreach ($hardData as $value) {
          DB::table('cargo_cars')->insert([
             'id' =>  $id,
            'cargo_car_type_id' =>  $value['cargo_car_type_id'],
            'license_plate' =>  $value['license_plate'],
            'is_active' =>  $value['is_active'],
        ]);
        $id++;
    }
    }
}

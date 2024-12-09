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
        // Kiểm tra xem có cargo_car_types không
        $cargoCarTypeIds = DB::table('cargo_car_types')->pluck('id')->toArray();
        
        if (empty($cargoCarTypeIds)) {
            throw new \Exception('Không có loại xe nào trong hệ thống. Vui lòng chạy CargoCarTypeSeeder trước.');
        }

        $hardData = [
            [
                'cargo_car_type_id' => $cargoCarTypeIds[0],
                'license_plate' => '29C-123.45',
                'role' => 0,
            ],
            [
                'cargo_car_type_id' => $cargoCarTypeIds[1],
                'license_plate' => '30D-678.90',
                'role' => 0,
            ],
            [
                'cargo_car_type_id' => $cargoCarTypeIds[2],
                'license_plate' => '31E-234.56',
                'role' => 0,
            ],
            [
                'cargo_car_type_id' => $cargoCarTypeIds[3],
                'license_plate' => '32F-789.00',
                'role' => 0,
            ],
            [
                'cargo_car_type_id' => $cargoCarTypeIds[4],
                'license_plate' => '33G-345.67',
                'role' => 0,
            ],
        ];
        $id = 1;
        foreach ($hardData as $value) {
          DB::table('cargo_cars')->insert([
             'id' =>  $id,
            'cargo_car_type_id' =>  $value['cargo_car_type_id'],
            'license_plate' =>  $value['license_plate'],
            'role' =>  $value['role'],
        ]);
        $id++;
    }
    }
}

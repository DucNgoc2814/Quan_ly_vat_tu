<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CargoCarTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hardData = [
            [
                'name' => 'Xe tải nhỏ',
                'capacity' => '2',
            ],
            [
                'name' => 'Xe tải trung',
                'capacity' => '5',
            ],
            [
                'name' => 'Xe tải lớn',
                'capacity' => '10',
            ],
            [
                'name' => 'Xe container 20ft',
                'capacity' => '20',
            ],
            [
                'name' => 'Xe container 40ft',
                'capacity' => '30',
            ],
        ];
        $id = 1;
        foreach ($hardData as $value) {
          DB::table('cargo_car_types')->insert([
             'id' =>  $id,
            'name' =>  $value['name'],
            'capacity' =>  $value['capacity'],
        ]);
        $id++;
    }
    }
}

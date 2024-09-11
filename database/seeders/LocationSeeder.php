<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $locations = [
            [
                'customer_id' => 1,
                'address' => '123 Đường ABC, Quận 1, TP. Hồ Chí Minh',
                'description' => 'Địa chỉ chính.',
            ],
            [
                'customer_id' => 2,
                'address' => '456 Đường XYZ, Quận 2, TP. Hồ Chí Minh',
                'description' => 'Địa chỉ phụ',
            ],
            [
                'customer_id' => 3,
                'address' => '789 Đường DEF, Quận 3, TP. Hồ Chí Minh',
                'description' => 'Địa chỉ văn phòng.',
            ],
            [
                'customer_id' => 4,
                'address' => '101 Đường GHI, Quận 4, TP. Hồ Chí Minh',
                'description' => 'Địa chỉ giao hàng.',
            ],
        ];

        foreach ($locations as $location) {
            DB::table('locations')->insert($location);
        }
    }
}

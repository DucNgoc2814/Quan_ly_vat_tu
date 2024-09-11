<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $hardData =
        [
            [
                'id'=> 1,
                'name' => 'Màu sắc',
            ],
            [
                'id'=> 2,
                'name' => 'Kích thước',
            ],
            [
                'id'=>3,
                'name' => 'Chất liệu',
            ],
            [
                'id'=> 4,
                'name' => 'Trọng lượng',
            ],
        ];
        foreach ($hardData as $value) {
          DB::table('attributes')->insert([
                  'id' =>  $value['id'],
            'name' =>  $value['name'],
        ]);
    }
    }
}

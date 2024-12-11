<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttributeValueSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    //Màu sắc
    $hardData1 = ['Màu xanh', 'Màu đỏ', 'Màu vàng', 'Màu trắng', 'Màu đen'];
    $id = 1;
    foreach ($hardData1 as $value) {
      DB::table('attribute_values')->insert([
        'id' => $id,
        'attribute_id' => 1,
        'value' =>  $value,
      ]);
      $id++;
    }
    // Kích thước
    $hardData2 = ['5cm', '10cm', '15cm', '20cm', '25cm'];
    foreach ($hardData2 as $value) {
      DB::table('attribute_values')->insert([
        'id' => $id,
        'attribute_id' => 2,
        'value' =>  $value,
      ]);
      $id++;
    }
    // Chất liệu
    $hardData3 = ['Nhựa', 'Inox', 'Gỗ', 'Nhôm'];
    foreach ($hardData3 as $value) {
      DB::table('attribute_values')->insert([
        'id' => $id,
        'attribute_id' => 3,
        'value' =>  $value,
      ]);
      $id++;
    }
    // Trọng lượng
    $hardData4 = ['3kg', '5kg', '10kg', '15kg', '20kg'];
    foreach ($hardData4 as $value) {
      DB::table('attribute_values')->insert([
        'id' => $id,
        'attribute_id' => 4,
        'value' =>  $value,
      ]);
      $id++;
    }
  }
}

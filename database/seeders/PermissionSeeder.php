<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table(table: 'permissions')->insert([
            [
                'id' => 1,
                'name' => 'ADMIN',
            ],
            [
                'id' => 2,
                'name' => 'Nhân Viên',
            ],
            [
                'id' => 3,
                'name' => 'Vận chuyển',
            ],
            [
                'id' => 4,
                'name' => 'Kế toán',
            ],
        ]);
    }
}

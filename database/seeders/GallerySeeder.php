<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $galleries = [
            [
                'product_id' => 1,
                'url' => 'https://example.com/image1.jpg',
            ],
            [
                'product_id' => 1,
                'url' => 'https://example.com/image2.jpg',
            ],
            [
                'product_id' => 2,
                'url' => 'https://example.com/image3.jpg',
            ],
            [
                'product_id' => 3,
                'url' => 'https://example.com/image4.jpg',
            ],
        ];

        foreach ($galleries as $gallery) {
            DB::table('galleries')->insert($gallery);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FeedbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $feedback = [
            [
                'order_id'=>'3',
                'name' => 'Nguyễn Văn D',
                'email' => 'nguyenvand@example.com',
                'number_phone' => '0123456789',
                'content' => 'Dịch vụ rất tốt, tôi sẽ tiếp tục sử dụng.',
                'is_active'=>'1',
                'created_at' => now(),
            ],
            
        ];

        foreach ($feedback as $feedback) {
            DB::table('feedback')->insert($feedback);
        }
    }
}

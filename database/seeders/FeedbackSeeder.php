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
        $feedbacks = [
            [
                'name' => 'Nguyễn Văn D',
                'email' => 'nguyenvand@example.com',
                'number_phone' => '0123456789',
                'content' => 'Dịch vụ rất tốt, tôi sẽ tiếp tục sử dụng.',
                'created_at' => now(),
            ],
            [
                'name' => 'Lê Thị E',
                'email' => 'lethie@example.com',
                'number_phone' => '0987654321',
                'content' => 'Tôi hài lòng với chất lượng sản phẩm.',
                'created_at' => now(),
            ],
            [
                'name' => 'Phạm Văn F',
                'email' => 'phamvanf@example.com',
                'number_phone' => '0123987654',
                'content' => 'Thời gian giao hàng rất nhanh và nhân viên hỗ trợ nhiệt tình.',
                'created_at' => now(),
            ],
        ];

        foreach ($feedbacks as $feedback) {
            DB::table('feedbacks')->insert($feedback);
        }
    }
}

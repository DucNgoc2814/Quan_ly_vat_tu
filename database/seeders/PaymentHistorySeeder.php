<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $paymentHistories = [
            [
                'id' => 1,
                'payment_id' => 1,
                'transaction_type' => 'contract',
                'related_id' => 1,
                'note' => 'Tiền cọc hợp đồng 25%',
                'amount' => 50000,
                'document' => 'abc',
                'created_at' => now(),
            ],
            
        ];

        foreach ($paymentHistories as $paymentHistory) {
            DB::table('payment_histories')->insert($paymentHistory);
        }
    }
}

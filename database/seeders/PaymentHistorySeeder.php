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
                'debt_id' => 1,
                'amount' => 50000,
            ],
            [
                'debt_id' => 1,
                'amount' => 20000,
            ],
            [
                'debt_id' => 2,
                'amount' => 75000,
            ],
            [
                'debt_id' => 3,
                'amount' => 100000,
            ],
        ];

        foreach ($paymentHistories as $paymentHistory) {
            DB::table('payment_histories')->insert($paymentHistory);
        }
    }
}

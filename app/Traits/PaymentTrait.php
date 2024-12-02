<?php

namespace App\Traits;

trait PaymentTrait 
{
    /**
     * Tính số tiền còn thiếu của giao dịch
     */
    private function getRemainingAmount($type, $id)
    {
        // Lấy model tương ứng
        $model = $this->getModelByType($type, $id);
        
        // Tính số tiền còn thiếu
        $remainingAmount = $model->total_amount - $model->paid_amount;

        // Kiểm tra nếu đã thanh toán đủ
        if ($remainingAmount <= 0) {
            throw new \Exception('Giao dịch này đã được thanh toán đủ');
        }

        return $remainingAmount;
    }

    /**
     * Lấy model tương ứng theo loại giao dịch
     */
    private function getModelByType($type, $id)
    {
        return match($type) {
            'contract' => \App\Models\Contract::findOrFail($id),
            'sale' => \App\Models\Order::findOrFail($id),
            'purchase' => \App\Models\Import_order::findOrFail($id),
            default => throw new \Exception('Loại giao dịch không hợp lệ')
        };
    }

    /**
     * Cập nhật số tiền đã thanh toán
     */
    private function updatePaidAmount($type, $id, $amount)
    {
        $model = $this->getModelByType($type, $id);
        $model->paid_amount += $amount;
        $model->save();
    }
}

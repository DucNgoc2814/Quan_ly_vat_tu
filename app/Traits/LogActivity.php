<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

trait LogActivity
{
    protected static function bootLogActivity()
    {
        Log::info('=== BOOT LOG ACTIVITY ===');

        static::created(function ($model) {
            Log::info('=== MODEL CREATED ===', [
                'model' => get_class($model),
                'id' => $model->id
            ]);
            self::addToLog('Tạo mới', $model);
        });
    }

    private static function addToLog($action, $model)
    {
        try {
            Log::info('=== START ADD TO LOG ===');

            // Chuẩn bị dữ liệu
            $newRow = [
                'Mã nhân viên' => auth()->user()->employee_id ?? 'TEST001',
                'Tên nhân viên' => auth()->user()->name ?? 'Test User',
                'Chức vụ' => auth()->user()->position ?? 'Tester',
                'Hành động' => $action,
                'Mô tả' => "Thao tác trên {$model->name}",
                'Thời gian' => now()->format('Y-m-d H:i:s')
            ];

            Log::info('Data prepared:', $newRow);

            // Đường dẫn file
            $filePath = 'logs/logs.xlsx';
            Log::info('File path: ' . $filePath);

            // Lưu file
            Excel::store(
                new \Maatwebsite\Excel\Collections\RowCollection([$newRow]),
                $filePath,
                'public'
            );

            Log::info('=== LOG SAVED SUCCESSFULLY ===');

        } catch (\Exception $e) {
            Log::error('=== ERROR IN ADD TO LOG ===');
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
        }
    }
} 
<?php

namespace App\Traits;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Illuminate\Support\Facades\Log;

trait LogActivity
{
    protected static function bootLogActivity()
    {
        static::created(function ($model) {
            Log::info('=== START LOG ACTIVITY ===');
            self::addToLog('Tạo mới', $model);
        });
    }

    private static function addToLog($action, $model)
    {
        try {
            Log::info('=== START ADD TO LOG ===');
            
            $filePath = public_path('storage/logs/logs.xlsx');
            Log::info('File path: ' . $filePath);

            // Tạo file mới nếu chưa có
            if (!file_exists($filePath)) {
                $spreadsheet = new Spreadsheet();
                $sheet = $spreadsheet->getActiveSheet();
                
                // Thêm header
                $headers = ['Mã nhân viên', 'Tên nhân viên', 'Chức vụ', 'Hành động', 'Mô tả', 'Thời gian'];
                foreach ($headers as $col => $header) {
                    $sheet->setCellValue(chr(65 + $col) . '1', $header);
                }
            } else {
                $spreadsheet = IOFactory::load($filePath);
                $sheet = $spreadsheet->getActiveSheet();
            }

            // Thêm dữ liệu mới
            $newRow = $sheet->getHighestRow() + 1;
            
            $data = [
                auth()->user()->employee_id ?? 'TEST001',
                auth()->user()->name ?? 'Test User',
                auth()->user()->position ?? 'Tester',
                $action,
                "Thao tác trên {$model->name}",
                now()->format('Y-m-d H:i:s')
            ];

            foreach ($data as $col => $value) {
                $sheet->setCellValue(chr(65 + $col) . $newRow, $value);
            }

            // Lưu file
            $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
            $writer->save($filePath);

            Log::info('=== LOG SAVED SUCCESSFULLY ===');

        } catch (\Exception $e) {
            Log::error('=== ERROR IN ADD TO LOG ===');
            Log::error('Message: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
        }
    }
} 
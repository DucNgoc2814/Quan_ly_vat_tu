<?php

namespace App\Services;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Illuminate\Support\Facades\Log;

class LogService
{
    public static function addLog($action, $model)
    {
        try {
            Log::info('=== START LOGGING ===');
            
            $filePath = public_path('storage/logs/logs.xlsx');
            
            // Tạo file mới nếu chưa tồn tại
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

            Log::info('=== LOG SAVED ===');
            return true;

        } catch (\Exception $e) {
            Log::error('Error in LogService: ' . $e->getMessage());
            return false;
        }
    }
} 
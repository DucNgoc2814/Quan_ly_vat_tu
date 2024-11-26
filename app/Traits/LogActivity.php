<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;

trait LogActivity
{
    protected static function bootLogActivity()
    {
        static::created(function ($model) {
            self::addToLog('Tạo mới', $model);
        });

        static::updated(function ($model) {
            self::addToLog('Cập nhật', $model);
        });

        static::deleted(function ($model) {
            self::addToLog('Xóa', $model);
        });
    }

    private static function addToLog($action, $model)
    {
        try {
            if (!auth()->check()) {
                Log::info('No auth user');
                return;
            }

            $newRow = [
                'Mã nhân viên' => auth()->user()->employee_id ?? 'SYSTEM',
                'Tên nhân viên' => auth()->user()->name ?? 'System User',
                'Chức vụ' => auth()->user()->position ?? 'System',
                'Hành động' => $action,
                'Mô tả' => "Thao tác trên " . (isset($model->name) ? $model->name : class_basename($model)),
                'Thời gian' => now()->format('Y-m-d H:i:s')
            ];

            $filePath = 'logs/activity_logs.xlsx';
            $fullPath = storage_path('app/public/' . $filePath);
            
            Log::info('Attempting to write to: ' . $fullPath);
            
            // Đảm bảo thư mục tồn tại
            if (!file_exists(dirname($fullPath))) {
                Log::info('Creating directory: ' . dirname($fullPath));
                mkdir(dirname($fullPath), 0755, true);
            }

            // Kiểm tra quyền ghi
            if (!is_writable(dirname($fullPath))) {
                Log::error('Directory is not writable: ' . dirname($fullPath));
                return;
            }

            // Nếu file chưa tồn tại, tạo mới với header
            if (!file_exists($fullPath)) {
                Log::info('Creating new file');
                $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
                $sheet = $spreadsheet->getActiveSheet();
                
                // Thêm header
                $headers = array_keys($newRow);
                foreach ($headers as $colIndex => $header) {
                    $sheet->setCellValueByColumnAndRow($colIndex + 1, 1, $header);
                }
                
                // Thêm dữ liệu mới
                foreach (array_values($newRow) as $colIndex => $value) {
                    $sheet->setCellValueByColumnAndRow($colIndex + 1, 2, $value);
                }
                
                $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
                $writer->save($fullPath);
                Log::info('New file created successfully');
            } else {
                Log::info('Appending to existing file');
                // Đọc file hiện có
                $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($fullPath);
                $sheet = $spreadsheet->getActiveSheet();
                
                // Tìm dòng cuối cùng
                $lastRow = $sheet->getHighestRow() + 1;
                Log::info('Writing to row: ' . $lastRow);
                
                // Thêm dữ liệu mới
                foreach (array_values($newRow) as $colIndex => $value) {
                    $sheet->setCellValueByColumnAndRow($colIndex + 1, $lastRow, $value);
                }
                
                $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
                $writer->save($fullPath);
                Log::info('Data appended successfully');
            }

        } catch (\Exception $e) {
            Log::error('Error in LogActivity: ' . $e->getMessage());
            Log::error($e->getTraceAsString());
        }
    }
} 
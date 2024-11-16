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
            
            // Kiểm tra auth
            Log::info('Auth Check: ' . (auth()->check() ? 'Yes' : 'No'));
            if (auth()->check()) {
                Log::info('User ID: ' . auth()->user()->employee_id);
                Log::info('User Name: ' . auth()->user()->name);
            }
            
            // Kiểm tra đường dẫn
            $directory = public_path('storage/logs');
            Log::info('Directory Path: ' . $directory);
            Log::info('Directory Exists: ' . (file_exists($directory) ? 'Yes' : 'No'));
            Log::info('Directory Writable: ' . (is_writable($directory) ? 'Yes' : 'No'));
            
            if (!file_exists($directory)) {
                mkdir($directory, 0777, true);
                Log::info('Directory Created');
            }

            $filePath = $directory . '/activity_logs.xlsx';
            Log::info('File Path: ' . $filePath);
            Log::info('File Exists: ' . (file_exists($filePath) ? 'Yes' : 'No'));
            
            $spreadsheet = null;
            
            if (!file_exists($filePath)) {
                Log::info('Creating new file...');
                $spreadsheet = new Spreadsheet();
                $sheet = $spreadsheet->getActiveSheet();
                
                $headers = ['Mã nhân viên', 'Tên nhân viên', 'Chức vụ', 'Hành động', 'Model', 'Mô tả', 'Thời gian'];
                foreach ($headers as $col => $header) {
                    $cell = $sheet->setCellValue(chr(65 + $col) . '1', $header);
                    // Thêm style cho header
                    $sheet->getStyle(chr(65 + $col) . '1')->applyFromArray([
                        'font' => ['bold' => true],
                        'alignment' => [
                            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        ],
                    ]);
                }
                
                // Auto-size columns
                foreach (range('A', 'F') as $col) {
                    $sheet->getColumnDimension($col)->setAutoSize(true);
                }
            } else {
                Log::info('Loading existing file...');
                $spreadsheet = IOFactory::load($filePath);
            }

            $sheet = $spreadsheet->getActiveSheet();
            
            // Thêm dữ liệu mới
            $newRow = $sheet->getHighestRow() + 1;
            
            // Thêm fake data nếu không có thông tin user
            $fakeEmployeeData = [
                'employee_id' => 'NV001',
                'name' => 'Nguyễn Văn A',
                'position' => 'Nhân viên'
            ];

            $modelTypes = [
                'product' => 'sản phẩm',
                'order' => 'đơn hàng',
                'customer' => 'khách hàng',
                'unit' => 'đơn vị',
                'employee' => 'nhân viên',
                'cargo_car' => 'xe',
                'brand' => 'thương hiệu',
                'contract' => 'hợp đồng',
                'supplier' => 'nhà cung cấp',
                'category' => 'danh mục',
                'inventory' => 'tồn kho',
                'import_order' => 'đơn nhập hàng',
                'trip' => 'chuyến xe',
            ];

            // Lấy tên class và chuyển thành tên dễ đọc
            $modelName = class_basename($model); // Ví dụ: "Product", "Order"
            $modelName = strtolower($modelName); // Chuyển thành chữ thường

            // Tạo mô tả chi tiết
            $description = $action . ' ' . 
                ($modelTypes[$modelName] ?? $modelName) . ': ' . 
                ($model->name ?? $model->id ?? '');

            $data = [
                auth()->check() ? auth()->user()->employee_id : $fakeEmployeeData['employee_id'],
                auth()->check() ? auth()->user()->name : $fakeEmployeeData['name'],
                auth()->check() ? auth()->user()->position : $fakeEmployeeData['position'],
                $action,
                $modelTypes[$modelName] ?? $modelName,
                $description,
                now()->setTimezone('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s')
            ];

            foreach ($data as $col => $value) {
                $cellAddress = chr(65 + $col) . $newRow;
                $sheet->setCellValue($cellAddress, $value);
                $sheet->getStyle($cellAddress)->applyFromArray([
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                    ],
                ]);
            }

            // Lưu file
            $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
            $writer->save($filePath);

            // Sau khi lưu file
            Log::info('File Save Attempted');
            Log::info('File Exists After Save: ' . (file_exists($filePath) ? 'Yes' : 'No'));
            if (file_exists($filePath)) {
                Log::info('File Size: ' . filesize($filePath) . ' bytes');
            }

            return true;

        } catch (\Exception $e) {
            Log::error('=== ERROR IN LOGGING ===');
            Log::error('Error Message: ' . $e->getMessage());
            Log::error('Error File: ' . $e->getFile());
            Log::error('Error Line: ' . $e->getLine());
            return false;
        }
    }
} 
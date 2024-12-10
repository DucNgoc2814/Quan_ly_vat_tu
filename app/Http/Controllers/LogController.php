<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\LogService;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;

class LogController extends Controller
{
    /**
     * Display a listing of the logs.
     */
    
    public function index()
    {
        try {
            $filePath = LogService::getLogFilePath();

            if (!file_exists($filePath)) {
                return view('admin.components.log.logs', ['logLines' => []]);
            }

            $spreadsheet = IOFactory::load($filePath);
            $sheet = $spreadsheet->getActiveSheet();
            $logLines = [];
            $highestRow = $sheet->getHighestRow();
            $highestColumn = $sheet->getHighestColumn();

            // Lấy headers từ dòng đầu tiên
            $headers = [];
            for ($col = 'A'; $col <= $highestColumn; $col++) {
                $headers[] = $sheet->getCell($col . '1')->getValue();
            }

            // Đọc dữ liệu từ các dòng tiếp theo
            $validRows = [];
            for ($row = 2; $row <= $highestRow; $row++) {
                $rowData = [];
                $hasData = false;

                for ($col = 'A'; $col <= $highestColumn; $col++) {
                    $value = $sheet->getCell($col . $row)->getValue();
                    $rowData[] = $value;
                    if (!empty($value)) {
                        $hasData = true;
                    }
                }

                if ($hasData) {
                    $validRows[] = $rowData;
                }
            }

            $logLines = array_reverse($validRows);

            return view('admin.components.log.logs', ['logLines' => $logLines]);
        } catch (\Exception $e) {
            return view('admin.components.log.logs', ['logLines' => []]);
        }
    }


}

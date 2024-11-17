<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\LogService;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Pagination\LengthAwarePaginator;

class LogController extends Controller
{
    /**
     * Display a listing of the logs.
     */

    public function index()
    {
        $filePath = LogService::getLogFilePath();

        if (!file_exists($filePath)) {
            return view('admin.components.log.logs', ['logLines' => []]);
        }

        $spreadsheet = IOFactory::load($filePath);
        $sheet = $spreadsheet->getActiveSheet();
        $logLines = [];

        foreach ($sheet->getRowIterator() as $row) {
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false);
            $lineData = [];
            foreach ($cellIterator as $cell) {
                $lineData[] = $cell->getValue();
            }
            if (is_array($lineData)) {
                $logLines[] = $lineData;
            }
        }

        $logLines = array_reverse($logLines);

        $perPage = 10;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentItems = array_slice($logLines, ($currentPage - 1) * $perPage, $perPage);
        $paginatedItems = new LengthAwarePaginator($currentItems, count($logLines), $perPage, $currentPage, [
            'path' => LengthAwarePaginator::resolveCurrentPath(),
        ]);

        return view('admin.components.log.logs', ['logLines' => $paginatedItems]);
    }


}

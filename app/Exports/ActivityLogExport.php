<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ActivityLogExport implements FromArray, WithHeadings, WithStyles, ShouldAutoSize
{
    protected $logs;

    public function __construct(array $logs)
    {
        $this->logs = $logs;
    }

    public function array(): array
    {
        return $this->logs;
    }

    public function headings(): array
    {
        return [
            'Mã nhân viên',
            'Tên nhân viên',
            'Chức vụ',
            'Hành động',
            'Mô tả',
            'Thời gian'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style cho header
            1 => [
                'font' => [
                    'bold' => true,
                    'size' => 12
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
                ],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => [
                        'rgb' => 'E2EFDA'
                    ]
                ]
            ],
            // Style cho toàn bộ nội dung
            'A1:F'.$sheet->getHighestRow() => [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
                    ]
                ],
                'alignment' => [
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
                ]
            ]
        ];
    }
} 
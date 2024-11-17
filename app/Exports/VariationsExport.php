<?php

namespace App\Exports;

use App\Models\Variation;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class VariationsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Variation::with(['product.category', 'product.brand', 'product.unit'])
            ->get()
            ->map(function ($variation) {
                return [
                    'Mã biến thể' => $variation->sku,
                    'Tên Biến thể' => $variation->name,
                    'Danh mục' => $variation->product->category->name ?? 'N/A',
                    'Thương hiệu' => $variation->product->brand->name ?? 'N/A',
                    'Số lượng' => $variation->stock,
                    'ĐVT' => $variation->product->unit->name ?? 'N/A',
                    'Giá nhập' => number_format(100000),
                    'Giá bán' => number_format($variation->price_export),
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Mã biến thể',
            'Tên Biến thể',
            'Danh mục',
            'Thương hiệu',
            'Số lượng',
            'ĐVT',
            'Giá nhập',
            'Giá bán',
        ];
    }
}

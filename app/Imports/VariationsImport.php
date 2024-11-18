<?php

namespace App\Imports;

use App\Models\Variation;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class VariationsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Tìm biến thể hiện tại trong cơ sở dữ liệu
        $variation = Variation::where('sku', $row['mã biến thể'])->first();

        // Nếu biến thể tồn tại
        if ($variation) {
            return [
                'ma_bien_the' => $variation->sku,
                'ten_bien_the' => $variation->name,
                'danh_muc' => $variation->product->category->name ?? 'N/A', // Danh mục
                'thuong_hieu' => $variation->product->brand->name ?? 'N/A', // Thương hiệu
                'so_luong' => $row['số lượng'], // Số lượng thực
                'dvt' => $variation->product->unit->name ?? 'N/A', // Đơn vị tính
                'gia_nhap' => number_format($variation->price_export), // Giá nhập
                'gia_ban' => number_format($variation->price_export), // Giá bán
                'current_stock' => $variation->stock, // Số lượng trên web
            ];
        }

        return null; // Không làm gì nếu không tìm thấy biến thể
    }
}

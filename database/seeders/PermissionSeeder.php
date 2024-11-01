<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table(table: 'permissions')->insert([
            // Quản lý nhà phân phối
            [
                'id' => 1,
                'name' => 'Xem danh sách nhà phân phối',
            ],
            [
                'id' => 2,
                'name' => 'Xem danh sách nhà phân phối đã ẩn',
            ],
            [
                'id' => 3,
                'name' => 'Khôi phục nhà phân phối',
            ],
            [
                'id' => 4,
                'name' => 'Thêm mới nhà phân phối',
            ],
            [
                'id' => 5,
                'name' => 'Sửa nhà phân phối',
            ],
            [
                'id' => 6,
                'name' => 'Ẩn nhà phân phối',
            ],

            // Quản lý nhân viên
            [
                'id' => 7,
                'name' => 'Xem danh sách nhân viên',
            ],
            [
                'id' => 8,
                'name' => 'Thêm mới nhân viên',
            ],
            [
                'id' => 9,
                'name' => 'Sửa thông tin nhân viên',
            ],

            // Quản lý bán hàng
            [
                'id' => 10,
                'name' => 'Xem danh sách đơn bán',
            ],
            [
                'id' => 11,
                'name' => 'Thêm đơn hàng',
            ],
            [
                'id' => 12,
                'name' => 'Sửa đơn hàng',
            ],
            [
                'id' => 13,
                'name' => 'Cập nhật trạng thái đơn hàng',
            ],
            [
                'id' => 14,
                'name' => 'Xem chi tiết đơn hàng',
            ],

            // Quản lý thanh trượt
            [
                'id' => 15,
                'name' => 'Xem danh sách thanh trượt',
            ],
            [
                'id' => 16,
                'name' => 'Thêm mới thanh trượt',
            ],
            [
                'id' => 17,
                'name' => 'Xem chi tiết thanh trượt',
            ],
            [
                'id' => 18,
                'name' => 'Sửa thanh trượt',
            ],
            [
                'id' => 19,
                'name' => 'Xóa thanh trượt',
            ],

            // Thương hiệu
            [
                'id' => 20,
                'name' => 'Xem danh sách thương hiệu',
            ],
            [
                'id' => 21,
                'name' => 'Thêm mới thương hiệu',
            ],
            [
                'id' => 22,
                'name' => 'Sửa thương hiệu',
            ],

            // Hợp đồng
            [
                'id' => 23,
                'name' => 'Xem danh sách hợp đồng',
            ],
            [
                'id' => 24,
                'name' => 'Thêm mới hợp đồng',
            ],
            [
                'id' => 25,
                'name' => 'Sửa hợp đồng',
            ],

            // Quản lý xe
            [
                'id' => 26,
                'name' => 'Xem danh sách xe',
            ],
            [
                'id' => 27,
                'name' => 'Thêm mới xe',
            ],
            [
                'id' => 28,
                'name' => 'Sửa xe',
            ],

            // Quản lý loại hợp đồng
            [
                'id' => 29,
                'name' => 'Xem danh sách loại hợp đồng',
            ],
            [
                'id' => 30,
                'name' => 'Thêm loại hợp đồng',
            ],
            [
                'id' => 31,
                'name' => 'Sửa loại hợp đồng',
            ],

            // Khách hàng
            [
                'id' => 32,
                'name' => 'Xem danh sách khách hàng',
            ],

            // Sản phẩm
            [
                'id' => 33,
                'name' => 'Xem danh sách sản phẩm',
            ],
            [
                'id' => 34,
                'name' => 'Thêm mới sản phẩm',
            ],
            [
                'id' => 35,
                'name' => 'Sửa sản phẩm',
            ],

            // Đơn hàng nhập
            [
                'id' => 36,
                'name' => 'Xem danh sách đơn nhập',
            ],
            [
                'id' => 37,
                'name' => 'Thêm mới đơn nhập',
            ],
            [
                'id' => 38,
                'name' => 'Sửa đơn nhập',
            ],
            [
                'id' => 39,
                'name' => 'Xem chi tiết đơn nhập',
            ],
            [
                'id' => 40,
                'name' => 'Yêu cầu hủy đơn nhập',
            ],
            [
                'id' => 41,
                'name' => 'Xem danh sách yêu cầu hủy',
            ],
            [
                'id' => 42,
                'name' => 'Hủy đơn nhập',
            ],
            [
                'id' => 43,
                'name' => 'Xác nhận đơn nhập',
            ],
            [
                'id' => 44,
                'name' => 'Tự động cập nhật trạng thái đơn nhập',
            ],
            [
                'id' => 45,
                'name' => 'Xem danh sách yêu cầu mới',
            ],
            [
                'id' => 46,
                'name' => 'Kiểm tra trạng thái đơn nhập',
            ],
            [
                'id' => 47,
                'name' => 'Cập nhật trạng thái đơn nhập',
            ],

            // Quản lý đơn vị
            [
                'id' => 48,
                'name' => 'Xem danh sách đơn vị',
            ],
            [
                'id' => 49,
                'name' => 'Thêm mới đơn vị',
            ],
            [
                'id' => 50,
                'name' => 'Sửa đơn vị',
            ],
            [
                'id' => 51,
                'name' => 'Xóa đơn vị',
            ],

            // Loại xe
            [
                'id' => 52,
                'name' => 'Xem danh sách loại xe',
            ],
            [
                'id' => 53,
                'name' => 'Thêm mới loại xe',
            ],
            [
                'id' => 54,
                'name' => 'Sửa loại xe',
            ],
            [
                'id' => 55,
                'name' => 'Xóa loại xe',
            ],

            // Danh mục
            [
                'id' => 56,
                'name' => 'Xem danh sách danh mục',
            ],
            [
                'id' => 57,
                'name' => 'Thêm mới danh mục',
            ],
            [
                'id' => 58,
                'name' => 'Sửa danh mục',
            ],
            [
                'id' => 59,
                'name' => 'Xóa danh mục',
            ],

            // Xếp hạng khách hàng
            [
                'id' => 60,
                'name' => 'Xem danh sách xếp hạng',
            ],
            [
                'id' => 61,
                'name' => 'Thêm mới xếp hạng',
            ],
            [
                'id' => 62,
                'name' => 'Sửa xếp hạng',
            ],
            [
                'id' => 63,
                'name' => 'Xóa xếp hạng',
            ],

            // Quản lý chuyến xe
            [
                'id' => 64,
                'name' => 'Xem danh sách chuyến xe',
            ],
            [
                'id' => 65,
                'name' => 'Thêm mới chuyến xe',
            ],
            [
                'id' => 66,
                'name' => 'Sửa chuyến xe',
            ],
            [
                'id' => 67,
                'name' => 'Xóa chuyến xe',
            ],
            [
                'id' => 68,
                'name' => 'Xem chi tiết chuyến xe',
            ],
        ]);
    }
}

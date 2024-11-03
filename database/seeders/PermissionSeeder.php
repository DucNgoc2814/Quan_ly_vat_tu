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
            // Dashboard
            [
                'id' => 1,
                'name' => 'Xem trang dashboard quản trị',
            ],

            // Quản lý nhân viên và phân quyền
            [
                'id' => 2,
                'name' => 'Thêm chức vụ nhân viên',
            ],
            [
                'id' => 3,
                'name' => 'Cập nhật quyền truy cập',
            ],
            [
                'id' => 4,
                'name' => 'Xem danh sách quyền truy cập',
            ],
            [
                'id' => 5,
                'name' => 'Xem danh sách nhân viên',
            ],
            [
                'id' => 6,
                'name' => 'Thêm mới nhân viên',
            ],
            [
                'id' => 7,
                'name' => 'Sửa thông tin nhân viên',
            ],
            [
                'id' => 8,
                'name' => 'Cập nhật thông tin nhân viên',
            ],

            // Quản lý nhà phân phối
            [
                'id' => 9,
                'name' => 'Xem danh sách nhà phân phối',
            ],
            [
                'id' => 10,
                'name' => 'Xem danh sách nhà phân phối đã ẩn',
            ],
            [
                'id' => 11,
                'name' => 'Khôi phục nhà phân phối',
            ],
            [
                'id' => 12,
                'name' => 'Thêm mới nhà phân phối',
            ],
            [
                'id' => 13,
                'name' => 'Sửa nhà phân phối',
            ],
            [
                'id' => 14,
                'name' => 'Ẩn nhà phân phối',
            ],

            // Quản lý bán hàng
            [
                'id' => 15,
                'name' => 'Xem danh sách đơn hàng bán',
            ],
            [
                'id' => 16,
                'name' => 'Thêm đơn hàng mới',
            ],
            [
                'id' => 17,
                'name' => 'Sửa đơn hàng',
            ],
            [
                'id' => 18,
                'name' => 'Cập nhật trạng thái đơn hàng',
            ],
            [
                'id' => 19,
                'name' => 'Xem chi tiết đơn hàng',
            ],

            // Quản lý thanh trượt
            [
                'id' => 20,
                'name' => 'Xem danh sách slider',
            ],
            [
                'id' => 21,
                'name' => 'Thêm mới slider',
            ],
            [
                'id' => 22,
                'name' => 'Xem chi tiết slider',
            ],
            [
                'id' => 23,
                'name' => 'Sửa slider',
            ],
            [
                'id' => 24,
                'name' => 'Xóa slider',
            ],

            // Quản lý thương hiệu
            [
                'id' => 25,
                'name' => 'Xem danh sách thương hiệu',
            ],
            [
                'id' => 26,
                'name' => 'Thêm mới thương hiệu',
            ],
            [
                'id' => 27,
                'name' => 'Sửa thương hiệu',
            ],

            // Quản lý hợp đồng
            [
                'id' => 28,
                'name' => 'Xem danh sách hợp đồng',
            ],
            [
                'id' => 29,
                'name' => 'Thêm mới hợp đồng',
            ],
            [
                'id' => 30,
                'name' => 'Sửa hợp đồng',
            ],

            // Quản lý xe
            [
                'id' => 31,
                'name' => 'Xem danh sách xe',
            ],
            [
                'id' => 32,
                'name' => 'Thêm mới xe',
            ],
            [
                'id' => 33,
                'name' => 'Sửa thông tin xe',
            ],

            // Quản lý loại hợp đồng
            [
                'id' => 34,
                'name' => 'Xem danh sách loại hợp đồng',
            ],
            [
                'id' => 35,
                'name' => 'Thêm loại hợp đồng mới',
            ],
            [
                'id' => 36,
                'name' => 'Sửa loại hợp đồng',
            ],

            // Quản lý khách hàng
            [
                'id' => 37,
                'name' => 'Xem danh sách khách hàng',
            ],

            // Quản lý sản phẩm
            [
                'id' => 38,
                'name' => 'Xem danh sách sản phẩm',
            ],
            [
                'id' => 39,
                'name' => 'Thêm mới sản phẩm',
            ],
            [
                'id' => 40,
                'name' => 'Sửa thông tin sản phẩm',
            ],

            // Quản lý đơn hàng nhập
            [
                'id' => 41,
                'name' => 'Xem danh sách đơn nhập',
            ],
            [
                'id' => 42,
                'name' => 'Thêm đơn nhập mới',
            ],
            [
                'id' => 43,
                'name' => 'Sửa đơn nhập',
            ],
            [
                'id' => 44,
                'name' => 'Xem chi tiết đơn nhập',
            ],
            [
                'id' => 45,
                'name' => 'Yêu cầu hủy đơn nhập',
            ],
            [
                'id' => 46,
                'name' => 'Xem danh sách yêu cầu hủy',
            ],
            [
                'id' => 47,
                'name' => 'Hủy đơn nhập',
            ],
            [
                'id' => 48,
                'name' => 'Xác nhận đơn nhập',
            ],
            [
                'id' => 49,
                'name' => 'Tự động cập nhật trạng thái',
            ],
            [
                'id' => 50,
                'name' => 'Xem danh sách yêu cầu mới',
            ],
            [
                'id' => 51,
                'name' => 'Kiểm tra trạng thái đơn',
            ],
            [
                'id' => 52,
                'name' => 'Cập nhật trạng thái đơn',
            ],

            // Quản lý đơn vị
            [
                'id' => 53,
                'name' => 'Xem danh sách đơn vị',
            ],
            [
                'id' => 54,
                'name' => 'Thêm mới đơn vị',
            ],
            [
                'id' => 55,
                'name' => 'Sửa đơn vị',
            ],
            [
                'id' => 56,
                'name' => 'Xóa đơn vị',
            ],

            // Quản lý loại xe
            [
                'id' => 57,
                'name' => 'Xem danh sách loại xe',
            ],
            [
                'id' => 58,
                'name' => 'Thêm mới loại xe',
            ],
            [
                'id' => 59,
                'name' => 'Sửa loại xe',
            ],
            [
                'id' => 60,
                'name' => 'Xóa loại xe',
            ],

            // Quản lý danh mục
            [
                'id' => 61,
                'name' => 'Xem danh sách danh mục',
            ],
            [
                'id' => 62,
                'name' => 'Thêm mới danh mục',
            ],
            [
                'id' => 63,
                'name' => 'Sửa danh mục',
            ],
            [
                'id' => 64,
                'name' => 'Xóa danh mục',
            ],

            // Quản lý xếp hạng khách hàng
            [
                'id' => 65,
                'name' => 'Xem danh sách xếp hạng',
            ],
            [
                'id' => 66,
                'name' => 'Thêm mới xếp hạng',
            ],
            [
                'id' => 67,
                'name' => 'Sửa xếp hạng',
            ],
            [
                'id' => 68,
                'name' => 'Xóa xếp hạng',
            ],

            // Quản lý chuyến xe
            [
                'id' => 69,
                'name' => 'Xem danh sách chuyến xe',
            ],
            [
                'id' => 70,
                'name' => 'Thêm mới chuyến xe',
            ],
            [
                'id' => 71,
                'name' => 'Sửa chuyến xe',
            ],
            [
                'id' => 72,
                'name' => 'Xóa chuyến xe',
            ],
            [
                'id' => 73,
                'name' => 'Xem chi tiết chuyến xe',
            ],
        ]);
    }
}

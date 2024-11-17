{{-- resources/views/admin/components/inventories/difference.blade.php --}}
@extends('admin.layouts.master')

@section('title')
    Quản lý tồn kho
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Sản phẩm có sự khác biệt về số lượng</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                @if (count($results ?? []) > 0)
                    <div class="card-body">
                        <table id="myTable" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Mã biến thể</th>
                                    <th>Tên Biến thể</th>
                                    <th>Danh mục</th>
                                    <th>Thương hiệu</th>
                                    <th>Số lượng thực</th>
                                    <th>Số lượng trên hệ thống</th>
                                    <th>Độ lệch</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($results as $variation)
                                    <tr>
                                        <td>{{ $variation['ma_bien_the'] }}</td>
                                        <td>{{ $variation['ten_bien_the'] }}</td>
                                        <td>{{ $variation['danh_muc'] }}</td>
                                        <td>{{ $variation['thuong_hieu'] }}</td>
                                        <td>{{ $variation['so_luong'] }}</td>
                                        <td>{{ $variation['current_stock'] }}</td>
                                        <td>{{ $variation['deviation'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p>Không có sản phẩm nào có sự khác biệt về số lượng.</p>
                @endif
            </div>
        </div><!--end col-->
    </div>
@endsection

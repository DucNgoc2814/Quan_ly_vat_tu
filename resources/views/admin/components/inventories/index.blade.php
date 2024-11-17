@extends('admin.layouts.master')


@section('title')
    Quản lý tồn kho
@endsection
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Danh sách biến thể</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-0">
                    <div class="row g-4">
                        <div class="col-sm-auto">
                            <div>
                                <a href="{{ route('inventories.export') }}" class="btn btn-success btn-sm"><i
                                        class="ri-download-2-fill align-middle me-1"></i>Xuất Excel</a>
                            </div>
                        </div>
                        <div class="col-sm-auto">
                            <div>
                                <button class="btn btn-primary btn-sm" id="import-btn"><i
                                        class="ri-upload-2-fill align-middle me-1"></i>Kiểm kê hàng hóa</button>
                                <form id="import-form" action="{{ route('inventories.import') }}" method="POST" enctype="multipart/form-data" style="display: none;">
                                    @csrf
                                    <input type="file" name="file" id="file-input" required>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table id="myTable" class="table table-bordered dt-responsive nowrap table-striped align-middle"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th data-ordering="false">Mã biến thể</th>
                                <th data-ordering="false">Tên Biến thể</th>
                                <th data-ordering="false">Danh mục</th>
                                <th data-ordering="false">Nhãn hiệu</th>
                                <th data-ordering="false">SL</th>
                                <th data-ordering="false">ĐVT</th>
                                <th data-ordering="false">GNTB</th>
                                <th data-ordering="false">GNGN</th>
                                <th data-ordering="false">Giá bán</th>
                                <th data-ordering="false">Lịch sử nhập</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($variations as $data)
                                <tr>
                                    <td>{{ $data->sku }}</td>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->product->category->name }}</td>
                                    <td>{{ $data->product->brand->name }}</td>
                                    <td>{{ $data->stock }}</td>
                                    <td>{{ $data->product->unit->name }}</td>
                                    <td>{{ number_format($data->price_export) }}</td>
                                    <td>{{ number_format($data->price_export) }}</td>
                                    <td>{{ number_format($data->price_export) }}</td>
                                    <td><a href="">Xem chi tiết</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div><!--end col-->
    </div>

    <script>
        $(document).ready(function() {
            $('#import-btn').click(function(e) {
                e.preventDefault(); // Ngăn chặn hành vi mặc định của thẻ a
                $('#file-input').click(); // Mở hộp thoại chọn file
            });

            $('#file-input').change(function() {
                $('#import-form').submit(); // Gửi form khi file được chọn
            });
        });
    </script>
@endsection

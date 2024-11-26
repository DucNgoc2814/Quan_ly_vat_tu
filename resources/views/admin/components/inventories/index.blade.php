@extends('admin.layouts.master')


@section('title')
    Kho hàng
@endsection
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Kho hàng</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-0">
                    <div class="row g-4">
                        <div class="col-sm-auto">
                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                data-bs-target="#historyModal">
                                <i class="ri-history-line"></i> Lịch sử kiểm kê
                            </button>
                        </div>
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
                                <form id="import-form" action="{{ route('inventories.import') }}" method="POST"
                                    enctype="multipart/form-data" style="display: none;">
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
                                    <td>
                                        {{ number_format($data->avgImportPrice) }}
                                    </td>
                                    <td>{{ number_format($data->latestImportPrice) }}</td>
                                    <td>{{ number_format($data->retail_price) }}</td>
                                    <td>
                                        <button class="btn btn-info btn-sm view-history" data-id="{{ $data->id }}">
                                            <i class="ri-history-line"></i> Xem chi tiết
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div><!--end col-->
    </div>

    <!-- Modal lịch sử -->
    <div class="modal fade" id="historyModal" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Lịch sử kiểm kê tồn kho</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <table id="historyTable" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Mã kiểm kê</th>
                                <th>Thời gian</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($inventories as $inventory)
                                <tr>
                                    <td>{{ $inventory->name }}</td>
                                    <td>{{ $inventory->created_at }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-info view-detail" data-id="{{ $inventory->id }}">
                                            <i class="ri-eye-line"></i> Xem
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal chi tiết lịch sử nhập hàng -->
    <div class="modal fade" id="historyDetailModal" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Lịch sử nhập hàng</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Mã đơn nhập</th>
                                <th>Số lượng</th>
                                <th>Giá nhập</th>
                                <th>Nhà cung cấp</th>
                                <th>Ngày nhập</th>
                            </tr>
                        </thead>
                        <tbody id="historyContent">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal chi tiết -->
    <div class="modal fade" id="detailModal" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Chi tiết kiểm kê</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="detailContent">
                </div>
            </div>
        </div>
    </div>


    @push('scripts')
        <script>
            $(document).ready(function() {
                $(document).on('click', '.view-detail', function() {
                    console.log('Button clicked');
                    var id = $(this).data('id');
                    console.log('ID:', id);

                    $.get('/quan-ly-ton-kho/get-detail/' + id, function(data) {
                        console.log('Data received:', data);
                        $('#detailContent').html(data);
                        $('#detailModal').modal('show');
                    }).fail(function(error) {
                        console.log('Ajax error:', error);
                    });
                });
            });
        </script>
    @endpush
    <script>
        $(document).ready(function() {
            $('.view-history').click(function() {
                let variationId = $(this).data('id');
                $.get(`/quan-ly-ton-kho/lich-su-nhap-hang/${variationId}`, function(data) {
                    let html = '';
                    data.forEach(item => {
                        html += `
                <tr>
                    <td>${item.import_order.slug}</td>
                    <td>${item.quantity}</td>
                    <td>${item.price}</td>
                    <td>${item.import_order.supplier.name}</td>
                    <td>${item.import_order.created_at}</td>
                </tr>
            `;
                    });
                    $('#historyContent').html(html);
                    $('#historyDetailModal').modal('show');
                });
            });
        });
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

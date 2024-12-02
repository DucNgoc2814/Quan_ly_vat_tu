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
                        <div class="col-sm-auto">
                            <button class="btn btn-warning btn-sm" id="editSelected">Sửa giá sỉ</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form id="bulkEditForm" method="POST" action="{{ route('inventories.bulkUpdate') }}">
                        @csrf
                        <table id="myTable" class="table table-bordered dt-responsive nowrap table-striped align-middle"
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="selectAllVariation"></th>
                                    <th>Mã sản phẩm</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Danh mục</th>
                                    <th>SL</th>
                                    <th>ĐVT</th>
                                    <th>GNTB</th>
                                    <th>GNGN</th>
                                    <th>Giá sỉ</th>
                                    <th>LSXN</th>
                                    <th>Hiển thị</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($variations as $data)
                                    @php
                                        $secondLatestPrice = $data
                                            ->importOrderDetails()
                                            ->whereHas('importOrder', function ($query) {
                                                $query->where('status', 3);
                                            })
                                            ->orderBy('id', 'desc')
                                            ->skip(1)
                                            ->take(1)
                                            ->pluck('price')
                                            ->first();
                                    @endphp
                                    <tr>
                                        <td><input type="checkbox" id="variation-{{ $data->id }}"
                                                name="selected_variations[]" value="{{ $data->id }}"
                                                data-sku="{{ $data->sku }}" data-name="{{ $data->name }}"
                                                data-current-price="{{ number_format($data->retail_price) }}">
                                        </td>
                                        <td>{{ $data->sku }}</td>
                                        <td>{{ $data->name }}</td>
                                        <td>{{ $data->product->category->name }}</td>
                                        {{-- <td>{{ $data->product->brand->name }}</td> --}}
                                        <td>{{ $data->stock }}</td>
                                        <td>{{ $data->product->unit->name }}</td>
                                        <td>
                                            {{ number_format($data->avgImportPrice) }}
                                        </td>
                                        <td>
                                            @if ($secondLatestPrice !== null)
                                                @if ($data->latestImportPrice > $secondLatestPrice)
                                                    <span style="color: green;">&#8593;
                                                        {{ number_format($data->latestImportPrice) }}</span>
                                                @else
                                                    <span style="color: red;">&#8595;
                                                        {{ number_format($data->latestImportPrice) }}</span>
                                                @endif
                                            @else
                                                <span>{{ number_format($data->latestImportPrice) }}</span>
                                            @endif
                                        </td>
                                        <td>{{ number_format($data->retail_price) }}</td>
                                        <td>
                                            <a href="javascript:void(0);" class="btn btn-info btn-sm view-history"
                                                data-id="{{ $data->id }}">
                                                <i class="ri-history-line"></i> Xem
                                            </a>
                                        </td>
                                        <td>
                                            <div class="form-check form-switch form-switch">
                                                @if ($data->is_active == 1)
                                                    <input onchange="changeStatus('variations', {{ $data->id }},0)"
                                                        class="form-check-input" type="checkbox" name="is_active"
                                                        value="1" id="is_active" checked>
                                                @else
                                                    <input onchange="changeStatus('variations', {{ $data->id }},1)"
                                                        class="form-check-input" type="checkbox" name="is_active"
                                                        value="0" id="is_active">
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                    </form>
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
                    <h5 class="modal-title">Lịch sử nhập xuất hàng</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#import-history" role="tab">
                                Lịch sử nhập hàng
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#export-history" role="tab">
                                Lịch sử bán hàng
                            </a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content p-3">
                        <!-- Tab lịch sử nhập -->
                        <div class="tab-pane active" id="import-history" role="tabpanel">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Mã đơn</th>
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

                        <!-- Tab lịch sử bán -->
                        <div class="tab-pane" id="export-history" role="tabpanel">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Mã đơn</th>
                                        <th>Số lượng</th>
                                        <th>Giá bán</th>
                                        <th>Khách hàng</th>
                                        <th>Ngày bán</th>
                                    </tr>
                                </thead>
                                <tbody id="exportHistoryContent">
                                </tbody>
                            </table>
                        </div>
                    </div>
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

    <!-- Modal sửa giá sỉ -->
    <div class="modal fade" id="editPriceModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Sửa giá sỉ cho các sản phẩm đã chọn</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="bulkEditForm" method="POST" action="{{ route('inventories.bulkUpdate') }}">
                        @csrf
                        <div id="priceFields"></div>
                        <input type="hidden" name="selected_variations" id="selected_variations">
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function bindViewDetail() {
                $(document).on('click', '.view-detail', function() {
                    var id = $(this).data('id');

                    $.get('/quan-ly-ton-kho/get-detail/' + id, function(data) {
                        $('#detailContent').html(data);
                        $('#detailModal').modal('show');
                    }).fail(function(error) {
                        console.log('Ajax error:', error);
                    });
                });
            }

            $(document).ready(function() {
                bindViewDetail();

                $(document).on('click', '.pagination a', function(e) {
                    e.preventDefault();
                    var url = $(this).attr('href');

                    if (url === "#" || url === "") {
                        console.log('Invalid URL:', url);
                        return;
                    }

                    console.log('Navigating to:', url);

                    $.get(url, function(data) {
                        $('#myTable tbody').html(data);
                        bindViewDetail();
                    }).fail(function() {
                        console.log('Error loading data');
                    });
                });

                $(document).on('click', '.view-history', function() {
                    let variationId = $(this).data('id');
                    console.log('Loading history for variation:', variationId);

                    // Load lịch sử nhập hàng
                    $.ajax({
                        url: `/quan-ly-ton-kho/lich-su-nhap-hang/${variationId}`,
                        method: 'GET',
                        success: function(data) {
                            let html = '';
                            if (data && data.length > 0) {
                                data.forEach(item => {
                                    html += `
                                        <tr>
                                            <td><a href="/don-hang-nhap/chi-tiet-don-hang/${item.import_order.slug}">${item.import_order?.slug || ''}</a></td>
                                            <td>${item.quantity || 0}</td>
                                            <td>${(item.price || 0).toLocaleString('vi-VN')}</td>
                                            <td>${item.import_order?.supplier?.name || ''}</td>
                                            <td>${item.import_order?.created_at ? new Date(item.import_order.created_at).toLocaleString('vi-VN') : ''}</td>               
                                        </tr>
                                    `;
                                });
                            } else {
                                html =
                                    '<tr><td colspan="5" class="text-center">Không có dữ liệu nhập hàng</td></tr>';
                            }
                            $('#historyContent').html(html);
                        },
                        error: function(xhr, status, error) {
                            $('#historyContent').html(
                                '<tr><td colspan="5" class="text-center text-danger">Lỗi khi tải dữ liệu nhập hàng</td></tr>'
                                );
                        }
                    });

                    // Load lịch sử bán hàng
                    $.get(`/quan-ly-ton-kho/lich-su-ban-hang/${variationId}`, function(data) {
                        let html = '';

                        if (!data || data.length === 0) {
                            html =
                                '<tr><td colspan="5" class="text-center">Không có dữ liệu bán hàng</td></tr>';
                        } else {
                            data.forEach(item => {
                                html += `
                                    <tr>
                                        <td><a href="/quan-ly-ban-hang/chi-tiet-don-hang/${item.slug}">${item.slug}</a></td>
                                        <td>${item.quantity || 0}</td>
                                        <td>${(item.price || 0).toLocaleString('vi-VN')} đ</td>
                                        <td>${item.customer_name || 'Khách lẻ'}</td>
                                        <td>${item.created_at ? new Date(item.created_at).toLocaleString('vi-VN') : ''}</td>               
                                    </tr>
                                `;
                            });
                        }
                        const exportHistoryContent = $('#exportHistoryContent');
                        if (exportHistoryContent.length) {
                            exportHistoryContent.html(html);
                        } else {
                            console.error('Element #exportHistoryContent not found');
                        }
                    }).fail(function(error) {
                        console.error('Error loading export history:', error);
                        $('#exportHistoryContent').html(
                            '<tr><td colspan="5" class="text-center text-danger">Lỗi khi tải dữ liệu</td></tr>'
                            );
                    });

                    $('#historyDetailModal').modal('show');
                });

                $('#import-btn').click(function(e) {
                    e.preventDefault(); // Ngăn chặn hành vi mặc định của thẻ a
                    $('#file-input').click(); // Mở hộp thoại chọn file
                });

                $('#file-input').change(function() {
                    $('#import-form').submit(); // Gửi form khi file được chọn
                });
            });
            document.getElementById('selectAllVariation').onclick = function() {
                var checkboxes = document.querySelectorAll(
                    'input[type="checkbox"][id^="variation-"]'); // Chọn checkbox theo ID
                for (var checkbox of checkboxes) {
                    checkbox.checked = this.checked; // Đặt trạng thái checkbox theo trạng thái của selectAll
                }
            };

            document.getElementById('editSelected').onclick = function() {
                var selected = document.querySelectorAll('input[name="selected_variations[]"]:checked');
                if (selected.length === 0) {
                    alert('Vui lòng chọn ít nhất một sản phẩm để sửa.');
                } else {
                    // Lưu ID sản phẩm đã chọn vào hidden input
                    var selectedIds = Array.from(selected).map(checkbox => checkbox.value);
                    document.getElementById('selected_variations').value = selectedIds.join(',');

                    // Xóa các trường nhập giá cũ
                    document.getElementById('priceFields').innerHTML = '';

                    // Tạo các trường nhập giá cho từng sản phẩm đã chọn
                    selected.forEach(function(checkbox) {
                        var variationId = checkbox.value;
                        var sku = checkbox.getAttribute('data-sku'); // Lấy SKU từ thuộc tính data
                        var name = checkbox.getAttribute('data-name'); // Lấy tên từ thuộc tính data
                        var currentPrice = checkbox.getAttribute(
                            'data-current-price'); // Lấy giá hiện tại từ thuộc tính data
                        var priceField = `
                            <div class="mb-3">
                                <label for="wholesale_price_${variationId}" class="form-label">Giá sỉ cho sản phẩm: ${sku} - ${name}:</label>
                                <div>
                                    <strong>Giá hiện tại: ${currentPrice}</strong>
                                </div>
                                <input type="text" class="form-control" id="wholesale_price_${variationId}" name="wholesale_price[${variationId}]" placeholder="Nhập giá sỉ mới">
                            </div>
                        `;
                        document.getElementById('priceFields').insertAdjacentHTML('beforeend', priceField);
                    });

                    // Hiển thị modal
                    $('#editPriceModal').modal('show');
                }
            };
        </script>
    @endpush
@endsection

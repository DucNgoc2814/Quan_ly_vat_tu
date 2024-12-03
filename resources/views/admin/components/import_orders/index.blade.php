@extends('admin.layouts.master')

@section('title')
    Danh sách đơn hàng nhập
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Danh sách đơn nhập</h4>
                <div class="col-sm-auto">
                    <div>
                        <a href="{{ route('importOrder.create') }}" class="btn btn-success" id="addproduct-btn"><i
                                class="ri-add-line align-bottom me-1"></i>Thêm đơn nhập</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <table id="myTable" class="table table-bordered dt-responsive nowrap table-striped align-middle"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th data-ordering="false">Mã đơn hàng</th>
                                <th data-ordering="false">Tên nhà phân phối</th>
                                <th data-ordering="false">Tổng tiền</th>
                                <th data-ordering="false">Tiền đã trả</th>
                                <th data-ordering="false">PTTT</th>
                                <th data-ordering="false">Trạng thái</th>
                                <th data-ordering="false">Ngày đặt hàng</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $item->slug }}</td>
                                    <td>{{ $item->supplier->name }}</td>
                                    <td class="{{ $item->total_amount == $item->paid_amount ? 'text-success' : 'text-danger' }}">{{ number_format($item->total_amount) }}</td>
                                    <td class="{{ $item->total_amount == $item->paid_amount ? 'text-success' : 'text-danger' }}">{{ number_format($item->paid_amount) }}</td>
                                    <td>{{ $item->payment->name }}</td>
                                    <td>
                                        @if ($item->status == 1)
                                            <span class="badge bg-warning">Chờ xác nhận</span>
                                        @elseif($item->status == 2)
                                            <span class="badge bg-info">Đã xác nhận</span>
                                        @elseif($item->status == 3)
                                            <span class="badge bg-success">Giao hàng thành công</span>
                                        @elseif($item->status == 4)
                                            <span class="badge bg-danger">Đã hủy</span>
                                        @elseif($item->status == 5)
                                            <span class="badge bg-warning">Đơn hàng chờ xác nhận hủy</span>
                                        @elseif($item->status == 6)
                                            <span class="badge bg-warning">Đơn hàng chờ xác nhận hủy</span>
                                        @endif
                                    </td>
                                    <td>{{ $item->created_at }}</td>
                                    <td class="text-center">
                                        <div class="dropdown d-inline-block">
                                            <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="ri-more-fill align-middle"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="{{ route('importOrder.indexImportDetail', ['slug' => $item->slug]) }}"
                                                        class="dropdown-item"><i
                                                            class="ri-eye-fill align-bottom me-2 text-muted"></i>Chi
                                                        Tiết Đơn Hàng</a>
                                                </li>
                                                @if ($item->status == 1)
                                                    <li><a href="{{ route('importOrder.edit', ['slug' => $item->slug]) }}"
                                                            class="dropdown-item edit-item-btn"><i
                                                                class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                            Cập nhật</a></li>
                                                    <li>
                                                        <a href="#" class="dropdown-item text-danger"
                                                            onclick="requestCancelOrder('{{ $item->slug }}'); return false;">
                                                            <i
                                                                class="ri-close-circle-line align-bottom me-2 text-danger"></i>
                                                            Hủy đơn hàng
                                                        </a>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>

                    </table>
                </div>
            </div>
        </div><!--end col-->
    </div>
@endsection

@section('scripts')
    @parent

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const lowStockProducts = @json($lowStockProducts);

            function updateNotificationBadge() {
                const notificationBadge = document.querySelector('.cartitem-badge');
                if (notificationBadge) {
                    notificationBadge.textContent = lowStockProducts.length;
                }
            }

            // Cập nhật số lượng thông báo mỗi 5 phút
            updateNotificationBadge();
            setInterval(updateNotificationBadge, 5 * 60 * 1000);
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Thành công!',
                    text: "{!! session('success') !!}",
                    confirmButtonText: 'OK'
                });
            @endif
        });
    </script>


    <script>
        function requestCancelOrder(slug) {
            Swal.fire({
                title: 'Bạn có chắc chắn muốn hủy đơn hàng này?',
                text: "Vui lòng nhập lý do hủy đơn hàng:",
                input: 'text',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Xác nhận hủy',
                cancelButtonText: 'Hủy bỏ',
                inputValidator: (value) => {
                    if (!value) {
                        return 'Bạn cần nhập lý do hủy đơn hàng!'
                    }
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch("{{ route('importOrder.requestCancel', '') }}/" + slug, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                reason: result.value // Gửi lý do hủy đơn hàng
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire('Đã gửi yêu cầu', 'Chờ quản lý xác nhận hủy', 'success');
                            } else {
                                Swal.fire('Lỗi', 'Không thể gửi yêu cầu hủy', 'error');
                            }
                        });
                }
            });
        }
    </script>

    <script>
        function checkOrderStatus(slug) {
            console.log('Checking status for:', slug); // Debug log
            
            setInterval(function() {
                fetch(`/don-hang-nhap/kiem-tra-trang-thai/${slug}`, {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Response data:', data); // Debug log
                    if (data.status === 'confirmed') {
                        Swal.fire({
                            title: 'Đơn hàng đã giao thành công',
                            text: `Đơn hàng - ${slug} đã được giao thành công`,
                            icon: 'success',
                            confirmButtonText: 'Xác nhận'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                updateOrderStatus(slug);
                            }
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            }, 10000);
        }

        function updateOrderStatus(slug) {
            fetch(`/don-hang-nhap/cap-nhat-trang-thai/${slug}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                }
            })
            .catch(error => console.error('Error:', error));
        }

        // Gọi hàm này cho mỗi đơn hàng có trạng thái "Đã xác nhận"
        @foreach ($data as $item)
            @if ($item->status == 2)
                checkOrderStatus('{{ $item->slug }}');
            @endif
        @endforeach
    </script>
@endsection

@extends('admin.layouts.master')
@section('title')
    Danh sách đơn hàng bán ra
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Danh sách đơn hàng bán ra </h4>
                @php
                    $option = 1;
                @endphp
                <div class="col-sm-auto">
                    <div>
                        <a href="{{ route('order.create') }}" class="btn btn-success" id="addproduct-btn"><i
                                class="ri-add-line align-bottom me-1"></i>Thêm đơn hàng</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    @if (isset($message))
                        <div class="alert alert-info">{{ $message }}</div>
                    @else
                        <table id="myTable" class="table table-bordered dt-responsive nowrap table-striped align-middle"
                            style="width:100%">
                            <thead>
                                <tr class="text-center">
                                    <th data-ordering="false">Mã đơn hàng </th>
                                    <th data-ordering="false">Người đặt </th>
                                    <th data-ordering="false">Người nhận </th>
                                    <th data-ordering="false">Số điện thoại</th>
                                    <th>Tổng tiền</th>
                                    <th>Đã trả</th>
                                    <th data-ordering="false">Ngày đặt hàng </th>
                                    <th>Trạng thái</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $order)
                                    <tr data-order-slug="{{ $order->slug }}">
                                        <td>{{ $order->slug }}</td>
                                        <td>{{ $order->customer->name ?? 'Đơn hợp đồng' }}</td>
                                        <td>{{ $order->customer_name }}</td>
                                        <td>{{ $order->number_phone }}</td>
                                        <td
                                            class="{{ $order->total_amount == $order->paid_amount ? 'text-success' : 'text-danger' }}">
                                            {{ number_format($order->total_amount) }}</td>
                                        <td
                                            class="{{ $order->total_amount == $order->paid_amount ? 'text-success' : 'text-danger' }}">
                                            {{ number_format($order->paid_amount) }}</td>
                                        {{-- <td>
                                            <span
                                                class="badge bg-info-subtle text-info">{{ $order->payment->name ?? 'Đơn hàng hợp đồng' }}</span>
                                        </td> --}}
                                        <td class="date-column">{{ $order->created_at }}</td>
                                        <td class="text-center">
                                            @if ($order->status_id < 4)
                                                <form action="{{ route('order.updateStatus', $order->slug) }}"
                                                    method="POST" class="{{ $order->slug }} d-inline status-update-form"
                                                    data-order-slug="{{ $order->slug }}">
                                                    @csrf
                                                    <select name="status"
                                                        class="form-select form-select-sm status-select order-status-select"
                                                        data-order-slug="{{ $order->slug }}"
                                                        id="statusSelect-{{ $order->slug }}"
                                                        onchange="handleStatusChange(this, '{{ $order->slug }}')">
                                                        <option class="optionCheck" value="{{ $order->status_id }}"
                                                            selected>
                                                            {{ $order->orderStatus->name }}</option>
                                                        @if ($order->status_id == 1)
                                                            <option class="optionCheck" value="2">Xác Nhận</option>
                                                            <option class="optionCheck" value="5">Hủy</option>
                                                        @elseif ($order->status_id == 2)
                                                            <option class="optionCheck" value="3">Đang giao</option>
                                                            <option class="optionCheck" value="5">Hủy</option>
                                                        @elseif ($order->status_id == 3)
                                                            <option class="optionCheck" value="4">Thành công</option>
                                                        @endif
                                                        <option class="optionDefaul" style="display: none" value="1">
                                                            Chờ xử lý</option>
                                                        <option class="optionDefaul" style="display: none" value="2">
                                                            Xác Nhận</option>
                                                        <option class="optionDefaul" style="display: none" value="3">
                                                            Đang giao</option>
                                                        <option class="optionDefaul" style="display: none" value="4">
                                                            Thành công</option>
                                                        <option class="optionDefaul" style="display: none" value="5">
                                                            Hủy</option>
                                                    </select>
                                                </form>
                                            @else
                                                <span
                                                    class="badge bg-{{ $order->orderStatus->color }}-subtle text-{{ $order->orderStatus->color }}">
                                                    {{ $order->orderStatus->name }}
                                                </span>
                                            @endif

                                        </td>
                                        <td class="text-center">
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ri-more-fill align-middle"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <a href="{{ route('order.indexDetail', ['slug' => $order->slug]) }}"
                                                            class="dropdown-item"><i
                                                                class="ri-eye-fill align-bottom me-2 text-muted"></i>Chi
                                                            Tiết Đơn Hàng</a>
                                                    </li>
                                                    @if ($order->status_id == 1 || $order->status_id == 2)
                                                        <li><a href="{{ route('order.edit', ['slug' => $order->slug]) }}"
                                                                class="dropdown-item edit-item-btn"><i
                                                                    class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                                Cập nhật</a></li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('themes/admin/assets/js/JqueryDate.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Thêm event listener cho tất cả các select có class status-select
            document.querySelectorAll('.status-select').forEach(select => {
                select.addEventListener('change', function() {
                    const orderSlug = this.dataset.orderSlug;
                    const newStatus = this.value;
                    const currentStatus = this.options[0].value;

                    if (currentStatus == '1' && newStatus == '2') {
                        const row = this.closest('tr');
                        const totalAmount = parseInt(row.querySelector('td:nth-child(5)')
                            .textContent.replace(/,/g, ''));
                        const paidAmount = parseInt(row.querySelector('td:nth-child(6)').textContent
                            .replace(/,/g, ''));

                        if (totalAmount !== paidAmount) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Không thể xác nhận',
                                text: `Số tiền chưa được thanh toán đủ! (Đã trả: ${paidAmount.toLocaleString('vi-VN')}/${totalAmount.toLocaleString('vi-VN')} VNĐ)`,
                                confirmButtonText: 'Đóng'
                            });
                            this.value = currentStatus;
                            return;
                        }
                        updateOrderStatus(this, orderSlug, newStatus);
                    } else if (newStatus == 5) {
                        requestCancelOrder(orderSlug);
                        this.value = this.options[0].value;
                        return;
                    } else {
                        updateOrderStatus(this, orderSlug, newStatus);
                    }
                });
            });

            function updateOrderStatus(selectElement, orderSlug, newStatus) {
                // Thêm kiểm tra trạng thái
                const currentStatus = parseInt(selectElement.options[0].value);
                if (currentStatus === 3 && newStatus === 4) {
                    Swal.fire({
                        title: 'Không thể cập nhật',
                        text: 'Không thể cập nhật trạng thái từ "Đang giao" sang "Thành công"',
                        icon: 'error',
                        confirmButtonText: 'Đóng'
                    });
                    selectElement.value = currentStatus;
                    return;
                }

                Swal.fire({
                    title: 'Bạn có chắc chắn muốn cập nhật trạng thái đơn hàng?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Cập nhật',
                    cancelButtonText: 'Thoát'
                }).then((result) => {
                    if (result.isConfirmed) {
                        changeStatusOrder(orderSlug, newStatus, selectElement);
                    } else {
                        selectElement.value = selectElement.options[0].value;
                    }
                });
            }

            function requestCancelOrder(orderSlug) {
                Swal.fire({
                    title: 'Bạn có chắc chắn muốn hủy đơn hàng này?',
                    text: "Hãy nhập lý do hủy đơn hàng",
                    input: 'textarea',
                    inputPlaceholder: 'Nhập lý do đơn hàng bị hủy...',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Gửi yêu cầu',
                    cancelButtonText: 'Thoát'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Chỉ gửi yêu cầu hủy đơn hàng, không cập nhật status
                        $.ajax({
                            url: `{{ route('order.requestCancel', '') }}/${orderSlug}`,
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            data: JSON.stringify({
                                cancel_reason: result.value
                            }),
                            success: function(response) {
                                if (response.success) {
                                    Swal.fire({
                                        title: 'Đã gửi!',
                                        text: 'Yêu cầu hủy đơn hàng đã được gửi cho admin xác nhận.',
                                        icon: 'success',
                                        confirmButtonText: 'OK'
                                    }).then(() => {
                                        location.reload();
                                    });
                                }
                            },
                            error: function(xhr) {
                                Swal.fire({
                                    title: 'Lỗi!',
                                    text: xhr.responseJSON?.message ||
                                        'Không thể gửi yêu cầu hủy đơn hàng',
                                    text: xhr.responseJSON?.message ||
                                        'Không thể gửi yêu cầu hủy đơn hàng',
                                    icon: 'error',
                                    confirmButtonText: 'OK'
                                });
                            }
                        });
                    }
                });
            }

            function changeStatusOrder(orderSlug, newStatus, selectElement) {
                $.ajax({
                    url: `{{ route('order.updateStatus', '') }}/${orderSlug}`,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        status: newStatus
                    },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                title: 'Thành công!',
                                text: response.message || 'Cập nhật trạng thái thành công',
                                icon: 'success'
                            }).then(() => {
                                location.reload();
                            });
                        }
                    },
                    error: function(xhr) {
                        Swal.fire({
                            title: 'Lỗi!',
                            text: xhr.responseJSON?.message ||
                                'Có lỗi xảy ra khi cập nhật trạng thái',
                            icon: 'error'
                        });
                        if (selectElement) {
                            selectElement.value = selectElement.options[0].value;
                        }
                    }
                });
            }

            // Thông báo thành công nếu có
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Thành công!',
                    text: "{!! session('success') !!}",
                    confirmButtonText: 'OK'
                });
            @endif

            // Thêm hàm confirmTransaction vào đây
            window.confirmTransaction = function(type, id) {
                event.stopPropagation();
                console.log('Starting confirmation for ID:', id);

                Swal.fire({
                    title: 'Xác nhận',
                    text: "Bạn có chắc chắn muốn xác nhận giao dịch này?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Đồng ý',
                    cancelButtonText: 'Hủy'
                }).then((result) => {
                    if (result.isConfirmed) {
                        const token = document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content');

                        axios.post(`/lich-su-chuyen-tien/xac-nhan/${id}`, {}, {
                                headers: {
                                    'X-CSRF-TOKEN': token,
                                    'Accept': 'application/json',
                                    'Content-Type': 'application/json'
                                }
                            })
                            .then(response => {
                                console.log('Success Response:', response);
                                if (response.data && response.data.success) {
                                    Swal.fire({
                                        title: 'Thành công!',
                                        text: response.data.message ||
                                            'Giao dịch đã được xác nhận.',
                                        icon: 'success'
                                    }).then(() => {
                                        location.reload();
                                    });
                                } else {
                                    throw new Error(response.data?.message || 'Có lỗi xảy ra');
                                }
                            })
                            .catch(error => {
                                console.error('Error details:', error);
                                Swal.fire({
                                    title: 'Lỗi!',
                                    text: error.response?.data?.message ||
                                        'Có lỗi xảy ra khi xác nhận giao dịch',
                                    icon: 'error'
                                });
                            });
                    }
                });
            }

            // Thêm hàm requestCancelOrder

        });
    </script>
    <script>
        window.Echo.channel('orders')
            .listen('OrderStatusChanged', (e) => {
                const order = e.order;
                const row = document.querySelector(`tr[data-order-slug="${order.slug}"]`);
                if (row) {
                    const statusCell = row.querySelector('td:nth-child(8)');
                    if (order.status_id >= 4) {
                        const statusConfig = {
                            4: {
                                name: 'Thành công',
                                color: 'success'
                            },
                            5: {
                                name: 'Hủy',
                                color: 'danger'
                            }
                        };

                        const status = statusConfig[order.status_id];
                        statusCell.innerHTML = `
                    <span class="badge bg-${status.color}-subtle text-${status.color}">
                        ${status.name}
                    </span>
                `;
                    } else {
                        const select = statusCell.querySelector('select');
                        if (select) {
                            select.value = order.status_id;
                        }
                    }
                }
            });

        function getStatusHTML(statusId) {
            const statusMap = {
                1: '<span class="badge bg-warning-subtle text-warning">Chờ xử lý</span>',
                2: '<span class="badge bg-primary-subtle text-primary">Đã xác nhận</span>',
                3: '<span class="badge bg-info-subtle text-info">Đang giao</span>',
                4: '<span class="badge bg-success-subtle text-success">Thành công</span>',
                5: '<span class="badge bg-danger-subtle text-danger">Đã hủy</span>'
            };
            return statusMap[statusId] || '';
        }
    </script>
@endsection

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
                                                        class="form-select form-select-sm status-select" 
                                                        data-order-slug="{{ $order->slug }}"
                                                        data-cancel-reason="{{ $order->cancel_reason }}"
                                                        onchange="handleStatusChange(this)">
                                                        <option value="{{ $order->status_id }}" selected>
                                                            {{ $order->orderStatus->name }}
                                                        </option>
                                                        @if ($order->status_id == 1)
                                                            <option value="2">Xác Nhận</option>
                                                            <option value="5">Hủy</option>
                                                        @elseif ($order->status_id == 2)
                                                            <option value="3">Đang giao</option>
                                                            <option value="5">Hủy</option>
                                                        @elseif ($order->status_id == 3)
                                                            <option value="4">Thành công</option>
                                                        @endif
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
    <script type="text/javascript">
        function handleStatusChange(select) {
            const orderSlug = $(select).data('order-slug');
            const newStatus = $(select).val();
            const currentStatus = $(select).find('option:first').val();

            if (newStatus == '5') {  // Trường hợp hủy đơn
                Swal.fire({
                    title: 'Yêu cầu hủy đơn hàng',
                    text: 'Vui lòng nhập lý do hủy đơn hàng',
                    input: 'textarea',
                    inputPlaceholder: 'Nhập lý do hủy...',
                    inputAttributes: {
                        'aria-label': 'Nhập lý do hủy'
                    },
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Gửi yêu cầu',
                    cancelButtonText: 'Hủy',
                    inputValidator: (value) => {
                        if (!value) {
                            return 'Vui lòng nhập lý do hủy!'
                        }
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Gửi yêu cầu hủy lên admin
                        $.ajax({
                            url: `/quan-ly-ban-hang/yeu-cau-huy/${orderSlug}`,
                            type: 'POST',
                            data: {
                                _token: $('meta[name="csrf-token"]').attr('content'),
                                cancel_reason: result.value
                            },
                            success: function(response) {
                                if (response.success) {
                                    Swal.fire({
                                        title: 'Đã gửi yêu cầu!',
                                        text: 'Yêu cầu hủy đã được gửi cho admin xác nhận',
                                        icon: 'success',
                                        confirmButtonText: 'OK'
                                    }).then(() => {
                                        // location.reload();
                                    });
                                }
                            },
                            error: function(xhr) {
                                // Kiểm tra nếu là lỗi permission
                                if (xhr.status === 403) {
                                    Swal.fire({
                                        title: 'Không có quyền!',
                                        text: 'Bạn không có quyền thực hiện thao tác này',
                                        icon: 'error',
                                        confirmButtonText: 'OK'
                                    });
                                } else {
                                    Swal.fire({
                                        title: 'Lỗi!',
                                        text: 'Có lỗi xảy ra khi gửi yêu cầu hủy',
                                        icon: 'error',
                                        confirmButtonText: 'OK'
                                    });
                                }
                            },
                            complete: function() {
                                $(select).val(currentStatus);
                            }
                        });
                    } else {
                        $(select).val(currentStatus);
                    }
                });
            } 
            else {
                sendUpdateRequest($(select), orderSlug, newStatus);
            }
        }

        function sendUpdateRequest(select, orderSlug, status) {
            select.prop('disabled', true);

            $.ajax({
                url: `/quan-ly-ban-hang/cap-nhat-trang-thai/${orderSlug}`,
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    status: status
                },
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            title: 'Thành công!',
                            text: 'Cập nhật trạng thái thành công',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            // location.reload();
                        });
                    }
                },
                error: function(xhr) {
                    console.error('Error:', xhr);
                    Swal.fire({
                        title: 'Lỗi!',
                        text: 'Có lỗi xảy ra khi cập nhật trạng thái',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                    select.val(select.find('option:first').val());
                },
                complete: function() {
                    select.prop('disabled', false);
                }
            });
        }

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

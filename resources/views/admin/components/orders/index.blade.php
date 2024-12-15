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
                                        <td class="date-column">{{ $order->created_at }}</td>
                                        <td class="text-center">
                                            @if ($order->status_id < 3)
                                                <form action="{{ route('order.updateStatus', $order->slug) }}"
                                                    method="POST" class="{{ $order->slug }} d-inline status-update-form"
                                                    data-order-slug="{{ $order->slug }}">
                                                    @csrf
                                                    <select name="status" class="form-select form-select-sm status-select"
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
                                                            <option value="6">Khách hàng tự vận chuyển</option>
                                                            <option value="5">Hủy</option>
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
                                                    @if ($order->status_id == 1)
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
            const totalAmount = parseFloat($(select).closest('tr').find('td:nth-child(5)').text().replace(/,/g, ''));
            const paidAmount = parseFloat($(select).closest('tr').find('td:nth-child(6)').text().replace(/,/g, ''));
            if (newStatus == '2' && (paidAmount < totalAmount * 0.3)) {
                Swal.fire({
                    title: 'Không thể xác nhận!',
                    text: `Đơn hàng cần cọc ít nhất ${new Intl.NumberFormat('vi-VN').format(totalAmount * 0.3)}VND (30%) tổng giá trị để được xác nhận`,
                    icon: 'warning',
                    confirmButtonText: 'OK'
                });
                $(select).val(currentStatus);
                return;
            }
            if (newStatus == '4' && (paidAmount < totalAmount)) {
                Swal.fire({
                    title: 'Không thể hoàn thành!',
                    text: `Đơn hàng cần thanh toán đủ số tiền ${new Intl.NumberFormat('vi-VN').format(totalAmount - paidAmount)}VND để hoàn thành`,
                    icon: 'warning',
                    confirmButtonText: 'OK'
                });
                $(select).val(currentStatus);
                return;
            }
            if (newStatus == '5') {
                const paymentPercent = (paidAmount / totalAmount) * 100;

                if (paymentPercent >= 30) {
                    // Case 1: Cancel with refund (>30% paid)
                    Swal.fire({
                        title: 'Yêu cầu hoàn tiền',
                        html: `
                            <div>
                                <p>Số tiền cần hoàn: ${new Intl.NumberFormat('vi-VN').format(paidAmount - (30 * totalAmount/ 100))}VND</p>
                                <div class="mb-3">
                                    <textarea id="cancel-reason" class="form-control mt-2" placeholder="Lý do hủy..."></textarea>
                                </div>
                
                                <div class="mb-3">
                                    <label class="form-label">Ảnh QR/STK</label>
                                    <input type="file" id="qr-image" class="form-control" accept="image/*">
                                </div>
                            </div>
                        `,
                        showCancelButton: true,
                        confirmButtonText: 'Gửi yêu cầu hoàn tiền',
                        cancelButtonText: 'Đóng',
                        preConfirm: () => {
                            const reason = Swal.getPopup().querySelector('#cancel-reason').value;
                            const qrFile = Swal.getPopup().querySelector('#qr-image').files[0];
                            if (!reason || !qrFile) {
                                Swal.showValidationMessage('Vui lòng điền đầy đủ thông tin');
                                return false;
                            }

                            const formData = new FormData();
                            formData.append('cancel_reason', reason);
                            formData.append('amount', paidAmount);
                            formData.append('qr_image', qrFile);
                            formData.append('need_refund', true);
                            formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
                            return formData;
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: `/quan-ly-ban-hang/yeu-cau-hoan-tien/${orderSlug}`,
                                type: 'POST',
                                data: result.value,
                                processData: false,
                                contentType: false,
                                success: (response) => {
                                    if (response.success) {
                                        Swal.fire('Thành công', 'Đã gửi yêu cầu hoàn tiền', 'success')
                                            .then(() => location.reload());
                                    }
                                },
                                error: (xhr, status, error) => {
                                    Swal.fire({
                                        title: 'Lỗi!',
                                        text: `Không thể gửi yêu cầu: ${xhr.responseJSON?.message || error}`,
                                        icon: 'error'
                                    });
                                }
                            });
                        }
                        $(select).val(currentStatus);
                    });
                } else {
                    Swal.fire({
                        title: 'Yêu cầu hủy đơn hàng',
                        html: `
                                <div>
                                    <textarea id="cancel-reason" class="form-control mt-2" placeholder="Lý do hủy..."></textarea>
                                </div>
                            `,
                        showCancelButton: true,
                        confirmButtonText: 'Xác nhận hủy',
                        cancelButtonText: 'Đóng',
                        preConfirm: () => {
                            const reason = Swal.getPopup().querySelector('#cancel-reason').value;
                            if (!reason) {
                                Swal.showValidationMessage('Vui lòng nhập lý do hủy');
                            }
                            return reason;
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: `/quan-ly-ban-hang/yeu-cau-huy/${orderSlug}`,
                                type: 'POST',
                                data: {
                                    _token: $('meta[name="csrf-token"]').attr('content'),
                                    cancel_reason: result.value,
                                    need_refund: false
                                },
                                success: (response) => {
                                    if (response.success) {
                                        Swal.fire('Thành công', 'Đã gửi yêu cầu hủy', 'success')
                                            .then(() => location.reload());
                                    }
                                }
                            });
                        }
                        $(select).val(currentStatus);
                    });
                }
            } else if (newStatus == '6') {
                if (paidAmount < totalAmount) {
                    Swal.fire({
                        title: 'Không thể cập nhật!',
                        text: `Đơn hàng cần thanh toán đủ số tiền ${new Intl.NumberFormat('vi-VN').format(totalAmount - paidAmount)}VND để chuyển sang trạng thái tự vận chuyển`,
                        icon: 'warning',
                        confirmButtonText: 'OK'
                    });
                    $(select).val(currentStatus);
                    return;
                }

                Swal.fire({
                    title: 'Xác nhận tự vận chuyển',
                    text: 'Xác nhận khách hàng tự vận chuyển?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Xác nhận',
                    cancelButtonText: 'Hủy'
                }).then((result) => {
                    if (result.isConfirmed) {
                        sendUpdateRequest($(select), orderSlug, '4'); // Chuyển thành trạng thái hoàn thành
                    } else {
                        $(select).val(currentStatus);
                    }
                });
            } else {
                sendUpdateRequest($(select), orderSlug, newStatus);
            }
        }

        function sendUpdateRequest(select, orderSlug, status) {
            select.prop('disabled', true);

            Swal.fire({
                title: 'Đang xử lý...',
                allowOutsideClick: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

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
                            location.reload();
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
    <script>
        window.Echo.channel('orders-status-update')
            .listen('OrderStatusUpdated', (e) => {
                Swal.fire({
                    title: 'Cập nhật đơn hàng',
                    text: `Đơn hàng bán lẻ "${e.order.slug}" đã được cập nhật trạng thái: "${e.newStatus}"`,
                    icon: 'info',
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                });

                // Cập nhật UI
                const row = document.querySelector(`tr[data-order-slug="${e.order.slug}"]`);
                if (row) {
                    const statusCell = row.querySelector('td:nth-child(8)');
                    if (e.order.status_id >= 4) {
                        statusCell.innerHTML = getStatusHTML(e.order.status_id);
                    } else {
                        const select = statusCell.querySelector('select');
                        if (select) {
                            select.value = e.order.status_id;
                        }
                    }
                }
            });
    </script>
@endsection

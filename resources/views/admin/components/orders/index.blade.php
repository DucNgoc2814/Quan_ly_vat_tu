@extends('admin.layouts.master')
@section('title')
    Danh sách đơn hàng bán ra
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Danh sách đơn hàng bán ra </h4>

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
                {{-- <div class="card-header border-0">
                    <div class="d-flex">
                        <div class="col-sm">
                            <form class="search-box ms-2 d-flex" method="GET" action="">
                                <select name="search_column" class="form-select me-2 h-25" style="width: auto;">
                                    <option value="slug">Mã đơn hàng</option>
                                    <option value="created_at">Ngày đặt hàng</option>
                                    <option value="customer_name">Tên người nhận</option>
                                    <option value="number_phone">Số điện thoại người nhận</option>
                                    <option value="address">Địa chỉ giao hàng</option>
                                </select>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" id="searchProductList" name="search"
                                        placeholder="Tìm kiếm..." aria-label="Recipient's username"
                                        aria-describedby="button-addon2">
                                    <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Tìm
                                        kiếm</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> --}}
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
                                    <th>PTTT</th>
                                    <th data-ordering="false">Ngày đặt hàng </th>
                                    <th>Trạng thái</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $order)
                                    <tr>
                                        <td>{{ $order->slug }}</td>
                                        <td>{{ $order->customer->name }}</td>
                                        <td>{{ $order->customer_name }}</td>
                                        <td>{{ $order->number_phone }}</td>
                                        <td>{{ number_format($order->total_amount) }}</td>
                                        <td>{{ number_format($order->paid_amount) }}</td>
                                        <td>
                                            <span class="badge bg-info-subtle text-info">{{ $order->payment->name }}</span>
                                        </td>
                                        <td class="date-column">{{ $order->created_at }}</td>
                                        <td>
                                            @if ($order->status_id < 4)
                                                <form action="{{ route('order.updateStatus', $order->slug) }}"
                                                    method="POST" class="d-inline status-update-form"
                                                    data-order-slug="{{ $order->slug }}">
                                                    @csrf
                                                    <select name="status" class="form-select form-select-sm"
                                                        onchange="confirmStatusChange(this)">
                                                        <option value="{{ $order->status_id }}" selected>
                                                            {{ $order->orderStatus->description }}</option>
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
                                                    {{ $order->orderStatus->description }}
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

    <div class="offcanvas offcanvas-end" id="offcanvasExample" tabindex="-1" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasExampleLabel">Hủy đơn hàng</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <label class="form-label" for="note">Ghi chú</label>
            <textarea name="note" class="form-control" id="note" cols="30" rows="3"
                placeholder="Nhập lý do đơn hàng bị hủy..."></textarea>
        </div>
        <form id="cancelOrderForm" action="" method="POST">
            @csrf
            <input type="hidden" name="status" value="5">
            <input type="hidden" name="note" id="noteHidden">
            <button type="submit" class="btn btn-sm btn-danger">Hủy</button>
        </form>
    </div>
@endsection

@section('styles-list')
    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
@endsection

@section('scripts')
    <script>
        myTable_filter
        function confirmStatusChange(selectElement) {
            const newStatus = selectElement.value;
            const form = selectElement.closest('form');
            const orderSlug = form.getAttribute('data-order-slug');
            if (newStatus == 5) {
                if (confirm('Bạn có chắc chắn muốn hủy đơn hàng này?')) {
                    openOffcanvas(orderSlug);
                } else {
                    selectElement.value = selectElement.options[0].value;
                }
            } else {
                if (confirm('Bạn có chắc chắn muốn cập nhật trạng thái đơn hàng?')) {
                    form.submit();
                } else {
                    selectElement.value = selectElement.options[0].value;
                }
            }
        }
        function openOffcanvas(orderSlug) {
            var myOffcanvas = document.getElementById('offcanvasExample');
            var bsOffcanvas = new bootstrap.Offcanvas(myOffcanvas);
            bsOffcanvas.show();
            const cancelOrderForm = document.getElementById('cancelOrderForm');
            cancelOrderForm.action = `{{ route('order.updateStatus', '') }}/${orderSlug}`;
            const noteTextarea = document.getElementById('note');
            const noteHidden = document.getElementById('noteHidden');
            cancelOrderForm.onsubmit = function(e) {
                e.preventDefault();
                noteHidden.value = noteTextarea.value;
                if (confirm('Bạn có chắc chắn muốn hủy đơn hàng này?')) {
                    this.submit();
                }
            };
        }
    </script>
   <script src="{{ asset('themes/admin/assets/js/JqueryDate.js') }}"></script>
@endsection

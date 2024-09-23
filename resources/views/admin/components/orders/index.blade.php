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
                        <a href="{{ route('quan-ly-don-hang.them-don-hang') }}" class="btn btn-success" id="addproduct-btn"><i
                                class="ri-add-line align-bottom me-1"></i>Thêm đơn hàng</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-0">
                    {{-- <div class="row g-4">
                        <div class="col-sm">
                            <form action="{{ route('quan-ly-don-hang.danh-sach-ban') }}" method="GET" class="d-flex">
                                <input type="date" class="form-control w-25" id="orderDate" name="orderDate"
                                    value="{{ request('orderDate') }}">
                                <button type="submit" class="btn btn-primary" id="button-addon2">Button</button>
                            </form>
                        </div>
                        <div class="col-sm">
                            <div class="d-flex justify-content-sm-end">
                                <form class="search-box ms-2 d-flex" method="GET" action="">
                                    <select name="search_column" class="form-select me-2"
                                        style="width: auto;">
                                        <option value="slug">Mã đơn hàng</option>
                                        <option value="created_at">Ngày đặt hàng</option>
                                        <option value="customer_name">Tên người nhận</option>
                                        <option value="number_phone">Số điện thoại người nhận</option>
                                        <option value="address">Địa chỉ giao hàng</option>
                                    </select>
                                    <input type="text" class="form-control" id="searchProductList" name="search"
                                        placeholder="Tìm kiếm...">
                                    <button type="submit" class="btn btn-primary ms-2">Tìm kiếm</button>
                                </form>
                            </div>
                        </div>
                    </div> --}}
                    <div class="d-flex">
                        <div class="col-sm">
                            <form action="{{ route('quan-ly-don-hang.danh-sach-ban') }}" method="GET" class="d-flex">
                                <input type="date" class="form-control w-25 h-25" id="orderDate" name="orderDate"
                                    value="{{ request('orderDate') }}" />
                                <button type="submit" class="btn btn-primary" id="button-addon2">
                                    Tìm kiếm
                                </button>
                            </form>
                        </div>
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
                </div>
                <div class="card-body">
                    @if (isset($message))
                        <div class="alert alert-info">{{ $message }}</div>
                    @else
                        <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle"
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th data-ordering="false">Mã đơn hàng </th>
                                    <th data-ordering="false">Ngày đặt hàng </th>
                                    <th data-ordering="false">Tên người đặt </th>
                                    <th data-ordering="false">Tên tên người nhận </th>
                                    <th data-ordering="false">Số điện thoại người nhận</th>
                                    <th data-ordering="false">Địa chỉ giao hàng</th>
                                    <th>Phương thức thanh toán</th>
                                    <th>Giá trị đơn hàng</th>
                                    <th>Số tiền đã thanh toán</th>
                                    <th>Trạng thái giao hàng</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $order)
                                    <tr>
                                        <td>{{ $order->slug }}</td>
                                        <td>{{ $order->created_at }}</td>
                                        <td>{{ $order->customer->name }}</td>
                                        <td>{{ $order->customer_name }}</td>
                                        <td>{{ $order->number_phone }}</td>
                                        <td>{{ $order->address }}</td>
                                        <td><span class="badge bg-info-subtle text-info">{{ $order->payment->name }}</span>
                                        </td>
                                        <td>{{ number_format($order->total_amount) }}</td>
                                        <td>{{ number_format($order->paid_amount) }}</td>
                                        {{-- <td>
                                            @if ($order->status_id == 1)
                                                <form
                                                    action="{{ route('quan-ly-don-hang.cap-nhat-trang-thai', $order->slug) }}"
                                                    method="POST" class="d-inline status-update-form">
                                                    @csrf
                                                    <input type="hidden" name="status" value="2">
                                                    <button type="submit" class="btn btn-sm btn-warning">Xác
                                                        nhận</button>
                                                </form>
                                            @elseif ($order->status_id == 2)
                                                <form
                                                    action="{{ route('quan-ly-don-hang.cap-nhat-trang-thai', $order->slug) }}"
                                                    method="POST" class="d-inline status-update-form">
                                                    @csrf
                                                    <input type="hidden" name="status" value="3">
                                                    <button type="submit" class="btn btn-sm btn-secondary">Xử
                                                        lý</button>
                                                </form>
                                            @elseif ($order->status_id == 3)
                                                <form
                                                    action="{{ route('quan-ly-don-hang.cap-nhat-trang-thai', $order->slug) }}"
                                                    method="POST" class="d-inline status-update-form">
                                                    @csrf
                                                    <input type="hidden" name="status" value="4">
                                                    <button type="submit" class="btn btn-sm btn-info">Đang giao
                                                        hàng</button>
                                                </form>
                                            @elseif ($order->status_id == 4)
                                                <button type="submit" class="btn btn-sm btn-success">Giao hàng thành
                                                    công</button>
                                            @elseif ($order->status_id == 5)
                                                <button type="submit" class="btn btn-sm btn-danger">Hủy</button>
                                            @else
                                                <span
                                                    class="badge bg-{{ $order->orderStatus->color }}-subtle text-{{ $order->orderStatus->color }}">{{ $order->orderStatus->description }}</span>
                                            @endif
                                            @if ($order->status_id <= 2)
                                                <form
                                                    action="{{ route('quan-ly-don-hang.cap-nhat-trang-thai', $order->slug) }}"
                                                    method="POST" class="d-inline status-update-form"
                                                    data-order-slug="{{ $order->slug }}">
                                                    @csrf
                                                    <input type="hidden" name="status" value="5">
                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                        data-bs-toggle="modal" data-bs-target="#cancelOrderModal"
                                                        onclick="confirmCancelOrder('{{ $order->slug }}')">Hủy</button>
                                                </form>
                                            @endif
                                        </td> --}}

                                        <td>
                                            @if ($order->status_id < 4)
                                                <form
                                                    action="{{ route('quan-ly-don-hang.cap-nhat-trang-thai', $order->slug) }}"
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
                                                            <option value="4">Giao hàng thành công</option>
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

                                        <td>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ri-more-fill align-middle"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <a href="{{ route('quan-ly-don-hang.chi-tiet-don-hang', ['slug' => $order->slug]) }}"
                                                            class="dropdown-item"><i
                                                                class="ri-eye-fill align-bottom me-2 text-muted"></i>Chi
                                                            Tiết
                                                            Đơn Hàng</a>
                                                    </li>
                                                    <li><a href="{{ route('quan-ly-don-hang.sua-don-hang', ['slug' => $order->slug]) }}"
                                                            class="dropdown-item edit-item-btn"><i
                                                                class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                            Cập nhật</a></li>
                                                    <li>
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
        </div><!--end col-->
    </div>

    {{ $data->links() }}

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
            <input type="hidden" name="note" id="noteHidden"> <!-- Trường ẩn để lưu ghi chú -->
            <button type="submit" class="btn btn-sm btn-danger">Hủy</button>
        </form>
    </div>

    <!-- Modal -->
    {{-- <div class="modal fade" id="cancelOrderModal" tabindex="-1" aria-labelledby="cancelOrderModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cancelOrderModalLabel">Hủy đơn hàng</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="cancelOrderForm" action="" method="POST">
                        @csrf
                        <input type="hidden" name="status" value="5">
                        <label class="form-label" for="note">Ghi chú</label>
                        <textarea name="note" class="form-control" id="note" cols="30" rows="3"
                            placeholder="Nhập lý do đơn hàng bị hủy..."></textarea>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                            <button type="submit" class="btn btn-danger">Hủy</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}
@endsection

@section('scripts-list')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!--datatable js-->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

    <script src="assets/js/pages/datatables.init.js"></script>
@endsection

@section('styles-list')
    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
@endsection

{{-- @section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const forms = document.querySelectorAll('.status-update-form');

            forms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();

                    // Lấy trạng thái từ input hidden
                    const status = this.querySelector('input[name="status"]').value;
                    const orderSlug = this.getAttribute(
                        'data-order-slug'); // Lấy slug đơn hàng từ thuộc tính data

                    // Chỉ xử lý xác nhận cho nút hủy (status = 5)
                    if (status == 5) {
                        confirmCancelOrder(orderSlug); // Gọi hàm xác nhận hủy đơn hàng
                    } else {
                        if (confirm('Bạn có chắc chắn muốn cập nhật trạng thái đơn hàng?')) {
                            this.submit(); // Submit form nếu người dùng bấm OK
                        }
                    }
                });
            });
        });

        function confirmCancelOrder(orderSlug) {
            if (confirm('Bạn có chắc chắn muốn hủy đơn hàng này?')) {
                // Mở offcanvas sau khi xác nhận
                openOffcanvas(orderSlug);
            }
        }

        // function openOffcanvas(orderSlug) {
        //     var myOffcanvas = document.getElementById('offcanvasExample');
        //     var bsOffcanvas = new bootstrap.Offcanvas(myOffcanvas);
        //     bsOffcanvas.show();

        //     // Cập nhật form hủy đơn hàng
        //     const cancelOrderForm = document.getElementById('cancelOrderForm');
        //     cancelOrderForm.action = `{{ route('quan-ly-don-hang.cap-nhat-trang-thai', '') }}/${orderSlug}`;

        //     // Bắt sự kiện submit cho form hủy
        //     cancelOrderForm.addEventListener('submit', function(e) {
        //         e.preventDefault(); // Ngăn việc submit form mặc định
        //         if (confirm('Bạn có chắc chắn muốn hủy đơn hàng này?')) {
        //             this.submit(); // Submit form hủy nếu người dùng bấm OK
        //         }
        //     });
        // }
        function openOffcanvas(orderSlug) {
            var myOffcanvas = document.getElementById('offcanvasExample');
            var bsOffcanvas = new bootstrap.Offcanvas(myOffcanvas);
            bsOffcanvas.show();

            // Cập nhật form hủy đơn hàng
            const cancelOrderForm = document.getElementById('cancelOrderForm');
            cancelOrderForm.action = `{{ route('quan-ly-don-hang.cap-nhat-trang-thai', '') }}/${orderSlug}`;

            // Lấy giá trị textarea
            const noteTextarea = document.getElementById('note');
            const noteHidden = document.getElementById('noteHidden');

            cancelOrderForm.onsubmit = function() {
                noteHidden.value = noteTextarea.value; // Đẩy giá trị vào trường ẩn
            };
        }
    </script>
@endsection --}}

@section('scripts')
    <script>
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
            cancelOrderForm.action = `{{ route('quan-ly-don-hang.cap-nhat-trang-thai', '') }}/${orderSlug}`;

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
@endsection

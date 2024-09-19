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
                            <input type="date" class="form-control w-25 h-25" id="orderDate" name="orderDate" value="{{ request('orderDate') }}" />
                            <button type="submit" class="btn btn-primary" id="button-addon2">
                              Button
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
                                <input type="text" class="form-control" id="searchProductList" name="search" placeholder="Tìm kiếm..." aria-label="Recipient's username" aria-describedby="button-addon2">
                                <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Tìm kiếm</button>
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
                                        {{-- <td><span class="badge bg-{{ $order->orderStatus->color }}-subtle text-{{ $order->orderStatus->color }}">{{ $order->orderStatus->description }}</span></td> --}}
                                        {{-- <td>
                                        @if ($order->status_id == 1)
                                            <button type="button" class="btn btn-sm btn-primary update-status"
                                                data-order-id="{{ $order->id }}" data-status="2">Xác nhận</button>
                                            <button type="button" class="btn btn-sm btn-danger update-status"
                                                data-order-id="{{ $order->id }}" data-status="5">Hủy</button>
                                        @elseif ($order->status_id == 2)
                                            <button type="button" class="btn btn-sm btn-primary update-status"
                                                data-order-id="{{ $order->id }}" data-status="3">Xử lý</button>
                                            <button type="button" class="btn btn-sm btn-danger update-status"
                                                data-order-id="{{ $order->id }}" data-status="5">Hủy</button>
                                        @elseif ($order->status_id == 3)
                                            <button type="button" class="btn btn-sm btn-success update-status"
                                                data-order-id="{{ $order->id }}" data-status="4">Giao hàng thành
                                                công</button>
                                        @else
                                            <span
                                                class="badge bg-{{ $order->orderStatus->color }}-subtle text-{{ $order->orderStatus->color }}">{{ $order->orderStatus->description }}</span>
                                        @endif
                                    </td> --}}
                                        <td>
                                            @if ($order->status_id == 1)
                                                <form
                                                    action="{{ route('quan-ly-don-hang.cap-nhat-trang-thai', $order->slug) }}"
                                                    method="POST" class="d-inline status-update-form">
                                                    @csrf
                                                    <input type="hidden" name="status" value="2">
                                                    <button type="submit" class="btn btn-sm btn-warning">Xác
                                                        nhận</button>
                                                </form>
                                                <form
                                                    action="{{ route('quan-ly-don-hang.cap-nhat-trang-thai', $order->slug) }}"
                                                    method="POST" class="d-inline status-update-form">
                                                    @csrf
                                                    <input type="hidden" name="status" value="5">
                                                    <button type="submit" class="btn btn-sm btn-danger">Hủy</button>
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
                                                <form
                                                    action="{{ route('quan-ly-don-hang.cap-nhat-trang-thai', $order->slug) }}"
                                                    method="POST" class="d-inline status-update-form">
                                                    @csrf
                                                    <input type="hidden" name="status" value="5">
                                                    <button type="submit" class="btn btn-sm btn-danger">Hủy</button>
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
        $(document).ready(function() {
            $('.update-status').click(function() {
                var orderId = $(this).data('order-id');
                var status = $(this).data('status');

                $.ajax({
                    url: "{{ route('quan-ly-don-hang.cap-nhat-trang-thai') }}",
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        order_id: orderId,
                        status: status
                    },
                    success: function(response) {
                        if (response.success) {
                            alert('Cập nhật trạng thái thành công');
                            location.reload();
                        } else {
                            alert('Có lỗi xảy ra khi cập nhật trạng thái');
                        }
                    },
                    error: function() {
                        alert('Có lỗi xảy ra khi cập nhật trạng thái');
                    }
                });
            });
        });
    </script>
@endsection --}}

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const forms = document.querySelectorAll('.status-update-form');
            forms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    if (confirm('Bạn có chắc chắn muốn cập nhật trạng thái đơn hàng?')) {
                        this.submit();
                    }
                });
            });
        });



        // hiển thị tất cả sau khi lọc
    </script>
@endsection

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
                                <th data-ordering="false">Phương thức thanh toán</th>
                                <th data-ordering="false">Ngày đặt hàng</th>
                                <th>Trạng thái</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $item->slug }}</td>
                                    <td>{{ $item->supplier->name }}</td>
                                    <td>{{ $item->total_amount }}</td>
                                    <td>{{ $item->paid_amount }}</td>
                                    <td>{{ $item->payment->name }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>
                                        @if ($item->status_id < 4)
                                            <form action="" method="POST" class="d-inline status-update-form"
                                                data-order-slug="{{ $item->slug }}">
                                                @csrf
                                                <select name="status" class="form-select form-select-sm"
                                                    onchange="confirmStatusChange(this)">
                                                    <option value="{{ $item->status_id }}" selected>
                                                        {{ $item->orderStatus->name }}</option>
                                                    @if ($item->status_id == 1)
                                                        <option value="2">Xác Nhận</option>
                                                        <option value="5">Hủy</option>
                                                    @elseif ($item->status_id == 2)
                                                        <option value="3">Đang giao</option>
                                                        <option value="5">Hủy</option>
                                                    @elseif ($item->status_id == 3)
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
                                                    <a href="{{ route('order.indexDetail', ['slug' => $item->slug]) }}"
                                                        class="dropdown-item"><i
                                                            class="ri-eye-fill align-bottom me-2 text-muted"></i>Chi
                                                        Tiết Đơn Hàng</a>
                                                </li>
                                                @if ($item->status_id == 1 || $item->status_id == 2)
                                                    <li><a href="{{ route('importOrder.edit', ['slug' => $item->slug]) }}"
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
                    {{-- {{ $contract_types->links('pagination::bootstrap-5') }} --}}
                </div>
            </div>
        </div><!--end col-->
    </div>
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

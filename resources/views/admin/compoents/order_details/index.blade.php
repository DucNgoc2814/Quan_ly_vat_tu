@extends('admin.layouts.master')

@section('title')
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Chi tiết đơn hàng: </h4>

                {{-- <div class="col-sm-auto">
                    <div>
                        <a href="" class="btn btn-success"
                            id="addproduct-btn"><i class="ri-add-line align-bottom me-1"></i>Thêm bài
                            viết</a>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-0">
                    <div class="row g-4">
                        <div class="col-sm ">
                            <input type="date" class="form-control w-25" id="exampleInputdate">
                        </div>

                        <div class="col-sm">
                            <div class="d-flex justify-content-sm-end">
                                <form class="search-box ms-2" method="GET" action="">
                                    <input type="text" class="form-control" id="searchProductList" name="search"
                                        placeholder="Tìm bài viết...">
                                    <i class="ri-search-line search-icon"></i>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th data-ordering="false">Số thứ tự</th>
                                <th data-ordering="false">Mã đơn hàng</th>
                                <th data-ordering="false">Tên sản phẩm </th>
                                <th data-ordering="false">Ảnh sản phẩm </th>
                                <th data-ordering="false">Giá sản phẩm</th>
                                <th data-ordering="false">Đơn vị</th>
                                <th data-ordering="false">Số lượng </th>
                                <th data-ordering="false">Biến thể</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $order_detail)
                                <tr>
                                    <td>{{ $order_detail->id }}</td>
                                    <td>{{ $order_detail->order->slug }}</td>
                                    <td>{{ $order_detail->product->name }}</td>
                                    {{-- <td>{{ $order_detail->product->galleries->url }}</td> --}}
                                    <td>{{ $order_detail->price }}</td>
                                    <td>{{ $order_detail->product->unit->name }}</td>
                                    <td>{{ $order_detail->quantity }}</td>
                                    <td>{{ $order_detail->variation->name }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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

@extends('admin.layouts.master')

@section('title')
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-0">
                    <div class="row g-4">

                        <div class="col-sm">
                           
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('customer_ranks.store') }}" method="POST"  enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-8">
                                <label class="form-label">Tên mã giảm giá </label>
                                <input  type="text" name="name" placeholder="Nhập tên mã giảm giá"
                                    class="form-control"  >
                                @error('name')
                                    <p class="text-danger">Vui lòng nhập chính xác mã giảm giáa</p>
                                @enderror
                            </div>
                            <div class="col-lg-8">
                                <label class="form-label"> Mã Discount</label>
                                <input  type="number" name="discount" placeholder="Nhập mã giảm giá"
                                    class="form-control"  >
                                @error('discount')
                                    <p class="text-danger">Vui lòng nhập chính xác mã discount </p>
                                @enderror
                            </div>
                            <div class="col-lg-8">
                                <label class="form-label">Số lượng.</label>
                                <input  type="number" name="amount" placeholder="Nhập số lượng"
                                    class="form-control"  >
                                @error('amount')
                                    <p class="text-danger">Vui lòng nhập chính xác số lượng</p>
                                @enderror
                            </div>

                            
                        </div>
                        <div class="mt-3">
                            <button type="submit" class = "btn btn-success text ">Update</button>
                        </div>
                    </form>
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

@extends('admin.layouts.master')

@section('title')
    Thêm hợp đồng
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Thêm hợp đồng</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Hợp đồng</a></li>
                        <li class="breadcrumb-item active">Thêm hợp đồng</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-0">
                    <div class="row g-4">
                        <div class="col-sm-auto">
                            <div>
                                <a href="{{ route('contract.index') }}" class="btn btn-success" id="addproduct-btn">Danh
                                    sách hợp đồng </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('contract.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <label class="form-label">Mã hợp đồng</label>
                                <input type="text" name="contract_number" placeholder="Nhập mã hợp đồng" class="form-control" value="{{ old('contract_number') }}">
                                @error('contract_number')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-lg-12 mt-3">
                                <label class="form-label">Tên người đại diện</label>
                                <input type="text" name="customer_name" placeholder="Nhập tên người đại diện" class="form-control" value="{{ old('customer_name') }}">
                                @error('customer_name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-lg-4 mt-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="customer_email" placeholder="Nhập email" class="form-control" value="{{ old('customer_email') }}">
                                @error('customer_email')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-lg-4 mt-3">
                                <label class="form-label">Số điện thoại</label>
                                <input type="text" name="number_phone" placeholder="Nhập số điện thoại" class="form-control" value="{{ old('number_phone') }}">
                                @error('number_phone')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-lg-4 mt-3">
                                <label class="form-label">Tổng tiền</label>
                                <input type="number" name="total_amount" placeholder="Nhập tổng tiền" class="form-control" value="{{ old('total_amount') }}" step="0.01">
                                @error('total_amount')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-lg-12 mt-3">
                                <label class="form-label">File</label>
                                <input type="file" name="file" class="form-control">
                                @error('file')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-lg-12 mt-3">
                                <label class="form-label">Mô tả</label>
                                <textarea type="text" name="note" placeholder="Nhập mô tả (không bắt buộc)" class="form-control" rows="3">{{ old('note') }}</textarea>
                                @error('note')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="mt-3">
                            <button class = "btn btn-success text">Thêm mới</button>
                        </div>
                    </form>
                </div>
            </div>

        </div><!--end col-->
    </div>
@endsection

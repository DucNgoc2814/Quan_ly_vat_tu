@extends('admin.layouts.master')

@section('title')
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">{{ $title }}</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                        <li class="breadcrumb-item active">{{$title}}</li>
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

                        <div class="col-sm">
                            <div class="d-flex justify-content-sm-end">
                                <form class="search-box ms-2" method="GET" action="">
                                    <input type="text" class="form-control " id="searchProductList" name="search"
                                        placeholder="Tìm hợp đồng...">
                                    <i class="ri-search-line search-icon"></i>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('CargoCars.store') }}" method="POST">
                        @csrf
                        <div class="row">

                            <div class="col-lg-8">
                                <label class="form-label">Loại xe vận chuyển</label>
                                <select name="cargo_car_type_id" id="cargo_car_type_id"
                                    class="form-control @error('cargo_car_type_id') is-invalid @enderror">
                                    <option value="" selected>--Chọn loại xe--</option>
                                    @foreach ($loai_xe as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('cargo_car_type_id') == $item->id ? 'selected' : '' }}>
                                            {{ $item->name }}
                                        </option>
                                    @endforeach

                                </select>
                                @error('cargo_car_type_id')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-lg-8">
                                <label class="form-label">Biển số</label>
                                <input type="text" name="license_plate" placeholder="Nhập biển số xe"
                                    class="form-control @error('license_plate') is-invalid @enderror"
                                    value="{{ old('license_plate') }}">
                                @error('license_plate')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-lg-8">
                                <label for="status" class="form-label">Trạng thái</label>
                                <select name="is_active" id="is_active"
                                class="form-control @error('is_active') is-invalid @enderror">
                                <option value="">--Chọn trạng thái--</option>
                                    <option value="1" class="text-success">
                                       Đang vận chuyển
                                    </option>
                                    <option value="0" class="text-danger">
                                       Chờ xác nhận
                                    </option>
                                </select>

                                @error('is_active')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mt-3">
                                <button class = "btn btn-success text ">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div><!--end col-->
    </div>
@endsection

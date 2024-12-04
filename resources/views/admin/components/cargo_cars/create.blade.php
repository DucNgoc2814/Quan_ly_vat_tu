@extends('admin.layouts.master')

@section('title')
    Thêm xe vận chuyển
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">{{ $title }}</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('CargoCars.index') }}">Danh sách xe</a></li>
                        <li class="breadcrumb-item active">{{ $title }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="card-header border-0 mb-4">
        <div class="row g-4">
            <div class="col-sm-auto">
                <a href="{{ route('CargoCars.index') }}" class="btn btn-success" id="addproduct-btn"><i
                        class="ri-arrow-left-line align-bottom me-1"></i>Quay lại</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
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
                            <div class="col-lg-8 mt-2">
                                <label class="form-label">Biển số</label>
                                <input type="text" name="license_plate" placeholder="Nhập biển số xe"
                                    class="form-control @error('license_plate') is-invalid @enderror"
                                    value="{{ old('license_plate') }}">
                                @error('license_plate')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mt-3">
                                <button class = "btn btn-success text ">+ Thêm mới</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div><!--end col-->
    </div>
@endsection

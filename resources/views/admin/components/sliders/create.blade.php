@extends('admin.layouts.master')

@section('title')
    Thêm slider
@endsection

@section('content')
    <div class="container-fluid">
        <!-- Breadcrumb -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">{{ $title }}</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            {{-- <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li> --}}
                            <li class="breadcrumb-item"><a href="{{ route('sliders.index') }}">Sliders</a></li>
                            <li class="breadcrumb-item active">{{$title}}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('sliders.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <!-- Left Column -->
                                <div class="col-lg-8">
                                    <div class="mb-4">
                                        <label class="form-label">Mô tả</label>
                                        <input type="text" name="description"
                                               class="form-control @error('description') is-invalid @enderror"
                                               placeholder="Nhập mô tả slider"
                                               value="{{ old('description') }}">
                                        @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="row mb-4">
                                        <div class="col-md-6">
                                            <label class="form-label">Ngày bắt đầu</label>
                                            <input type="date" name="date_start"
                                                   class="form-control @error('date_start') is-invalid @enderror"
                                                   value="{{ old('date_start') }}">
                                            @error('date_start')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Ngày kết thúc</label>
                                            <input type="date" name="date_end"
                                                   class="form-control @error('date_end') is-invalid @enderror"
                                                   value="{{ old('date_end') }}">
                                            @error('date_end')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Right Column -->
                                <div class="col-lg-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title mb-3">Hình ảnh slider</h5>
                                            <div class="text-center mb-3">
                                                <img src="{{ asset('assets/images/placeholder.jpg') }}"
                                                     alt="No image"
                                                     id="img_slider"
                                                     class="img-fluid rounded"
                                                     style="max-height: 200px; width: auto;">
                                            </div>
                                            <div class="mb-3">
                                                <input type="file" name="url" id="url"
                                                       class="form-control @error('url') is-invalid @enderror"
                                                       onchange="showImage(event)">
                                                @error('url')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label d-block">Trạng thái</label>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" id="statusActive" name="status" value="1"
                                                           class="form-check-input" checked>
                                                    <label class="form-check-label text-success" for="statusActive">
                                                        Hiển thị
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" id="statusInactive" name="status" value="0"
                                                           class="form-check-input">
                                                    <label class="form-check-label text-danger" for="statusInactive">
                                                        Ẩn
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-12">
                                    <div class="d-flex justify-content-end gap-2">
                                        <a href="{{ route('sliders.index') }}" class="btn btn-secondary">Hủy</a>
                                        <button type="submit" class="btn btn-primary">Lưu slider</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function showImage(event) {
            const img_slider = document.getElementById('img_slider');
            const file = event.target.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    img_slider.src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
    @endpush
@endsection

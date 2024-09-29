@extends('admin.layouts.master')

@section('title')
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Datatables</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                        <li class="breadcrumb-item active">Datatables</li>
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
                                    <input type="text" class="form-control" id="searchProductList" name="search"
                                        placeholder="Tìm bài viết...">
                                    <i class="ri-search-line search-icon"></i>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('sliders.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-8">
                                <label class="form-label">Hình ảnh</label>
                                <input type="file" name="url" id="url"
                                    class="from-control @error('url') is-invalid @enderror" onchange="showImage(event)" >
                                <img src="" alt="" id="img_slider" style="width: 150px; display: none;"
                                    class="mt-3" value="{{ old('url') }}">

                                @error('url')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-lg-8">
                                <label class="form-label">Mô tả</label>
                                <input type="text" name="description" placeholder="Nhập mô tả" class="form-control" value="{{ old('description') }}">
                                @error('description')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-lg-8">
                                <label class="form-label">Ngày bắt đầu</label>
                                <input type="date" name="date_start" placeholder="Nhập ngày bắt đầu"
                                    class="form-control" value="{{ old('date_start') }}">
                                @error('date_start')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-lg-8">
                                <label class="form-label">Ngày kết thúc</label>
                                <input type="date" name="date_end" placeholder="Nhập ngày kết thúc" class="form-control" value="{{ old('date_end') }}">
                                @error('date_end')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-lg-8">
                                <label for="status" class="form-label">Trạng thái</label>
                                <div class="mb-3 ms-1">
                                    <input type="radio" name="status" value="1" class="me-1" id="firstRadio"
                                        checked>
                                    <label for="firstRadio" class="form-check-label text-success">Hiển Thị</label>

                                    <input class="me-1" type="radio" name="status" value="0" id="secondRadio">
                                    <label for="secondRadio" class="form-check-label text-danger">Ẩn</label>
                                </div>

                            </div>

                        </div>
                        <div class="mt-3">
                            <button class = "btn btn-success text ">Submit</button>
                        </div>
                    </form>
                </div>
            </div>

        </div><!--end col-->
    </div>
@endsection

@section('js')
    <script>
        function showImage(event) {
            const img_slider = document.getElementById('img_slider');
            const file = event.target.files[0];
            const reader = new FileReader();
            reader.onload = function() {
                img_slider.src = reader.result;
                img_slider.style.display = 'block';
            }
            if (file) {
                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection

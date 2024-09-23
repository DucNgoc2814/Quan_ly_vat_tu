@extends('admin.layouts.master')

@section('title')
    Thêm sản phẩm
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Thêm sản phẩm</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Sản phẩm</a></li>
                        <li class="breadcrumb-item active">Thêm sản phẩm</li>
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
                                <a href="{{ route('hop-dong.index') }}" class="btn btn-success" id="addproduct-btn">Danh
                                    sách hợp đồng </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('hop-dong.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label class="form-label" for="product-title-input">Tiêu đề</label>
                                            <input type="text" class="form-control" id="product-title-input"
                                                value="" placeholder="Thêm tiêu đề" name="title">
                                            @error('title')
                                                <span role="alert">
                                                    <span class="text-danger">a</span>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>


                                </div>
                                <!-- end card -->


                                <div class="card">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div>
                                                <label class="form-label" for="meta-description-input">Mô tả bài
                                                    viết</label>
                                                <textarea class="form-control" id="meta-description-input" placeholder="Nhập mô tả" rows="3" name="description"></textarea>
                                                @error('description')
                                                    <span role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div>
                                                <label class="form-label" for="meta-description-input">Nội dung bài
                                                    viết</label>
                                                <textarea class="form-control" id="meta-description-input" placeholder="Nhập nội dung" rows="9" name="content"></textarea>
                                                @error('content')
                                                    <span role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end card -->
                                <div class="text-end mb-3">
                                    <button type="submit" class="btn btn-success w-sm">Thêm mới</button>
                                </div>
                            </div>
                            <!-- end col -->

                            <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-body d-flex justify-content-around">
                                        <div class="form-check form-switch form-switch">
                                            <input class="form-check-input" type="checkbox" name="is_active" value="1"
                                                id="is_active" checked>
                                            <label class="form-check-label" for="1">Hiển thị</label>
                                        </div>
                                        <div class="form-check form-switch form-switch">
                                            <input class="form-check-input" type="checkbox" name="is_trending"
                                                value="1" id="is_trending">
                                            <label class="form-check-label" for="is_trending">Nổi bật</label>
                                        </div>
                                        <div class="form-check form-switch form-switch">
                                            <input class="form-check-input" type="checkbox" name="is_popular" value="1"
                                                id="is_popular">
                                            <label class="form-check-label" for="is_popular">Phổ biến</label>
                                        </div>
                                    </div>

                                    <!-- end card body -->
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Danh mục</h5>
                                    </div>
                                    <div class="card-body">
                                        <select class="form-select" id="choices-category-input" name="category_id"
                                            data-choices data-choices-search-false>
                                            @foreach ($categories as $key => $value)
                                                <option value="{{ $key }}">{{ $value }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <label class="form-label" for="meta-description-input">Ảnh bài viết</label>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <p class="text-muted">Thêm ảnh bài viết</p>
                                            <div class="text-center">
                                                <div class="position-relative d-inline-block">
                                                    <div class="position-absolute top-100 start-100 translate-middle">
                                                        <label for="product-image-input" class="mb-0"
                                                            data-bs-toggle="tooltip" data-bs-placement="right"
                                                            title="Select Image">
                                                            <div class="avatar-xs">
                                                                <div
                                                                    class="avatar-title bg-light border rounded-circle text-muted cursor-pointer">
                                                                    <i class="ri-image-fill"></i>
                                                                </div>
                                                            </div>
                                                        </label>
                                                        <input class="form-control d-none" value=""
                                                            id="product-image-input" type="file"
                                                            accept="image/png, image/gif, image/jpeg" name="image">
                                                    </div>
                                                    <div class="avatar-lg">
                                                        <div class="avatar-title bg-light rounded">
                                                            <img src="" id="product-img"
                                                                class="avatar-md h-auto" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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

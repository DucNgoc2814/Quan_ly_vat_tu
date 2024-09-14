@extends('admin.layouts.master')

@section('title')
    Thêm bài viết
@endsection

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Thêm mới bài viết</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Bài viết</a></li>
                        <li class="breadcrumb-item active">Thêm mới bài viết</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <form method="POST" action="" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label" for="product-title-input">Tiêu đề</label>
                            <input type="text" class="form-control" id="product-title-input" value=""
                                placeholder="Thêm tiêu đề" name="title">
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
                                <label class="form-label" for="meta-description-input">Mô tả bài viết</label>
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
                                <label class="form-label" for="meta-description-input">Nội dung bài viết</label>
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
                            <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active"
                                checked>
                            <label class="form-check-label" for="1">Hiển thị</label>
                        </div>
                        <div class="form-check form-switch form-switch">
                            <input class="form-check-input" type="checkbox" name="is_trending" value="1"
                                id="is_trending">
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
                        <select class="form-select" id="choices-category-input" name="category_id" data-choices
                            data-choices-search-false>

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
                                        <label for="product-image-input" class="mb-0" data-bs-toggle="tooltip"
                                            data-bs-placement="right" title="Select Image">
                                            <div class="avatar-xs">
                                                <div
                                                    class="avatar-title bg-light border rounded-circle text-muted cursor-pointer">
                                                    <i class="ri-image-fill"></i>
                                                </div>
                                            </div>
                                        </label>
                                        <input class="form-control d-none" value="" id="product-image-input"
                                            type="file" accept="image/png, image/gif, image/jpeg" name="image">
                                    </div>
                                    <div class="avatar-lg">
                                        <div class="avatar-title bg-light rounded">
                                            <img src="" id="product-img" class="avatar-md h-auto" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>



    <script>
        document.getElementById('product-image-input').addEventListener('change', function(event) {
            var output = document.getElementById('product-img');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src)
            }
        });
    </script>
@endsection

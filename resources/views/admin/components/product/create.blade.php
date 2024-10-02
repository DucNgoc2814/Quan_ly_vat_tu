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
                                <a href="{{ route('product.index') }}" class="btn btn-success" id="addproduct-btn">Danh
                                    sách sản phẩm</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label class="form-label" for="product-title-input">Tên sản phẩm</label>
                                            <input type="text" class="form-control" id="product-title-input"
                                                value="" placeholder="Thêm sản phẩm" name="name">
                                            @error('title')
                                                <span role="alert">
                                                    <span class="text-danger">a</span>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label class="form-label" for="product-title-input">Giá sản phẩm</label>
                                            <input type="text" class="form-control" id="product-title-input"
                                                value="" placeholder="Thêm giá sản phẩm" name="price">
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
                                                <label class="form-label" for="meta-description-input">Mô tả</label>
                                                <textarea class="form-control" id="meta-description-input" placeholder="Nhập nội dung" rows="6" name="description"></textarea>
                                                @error('content')
                                                    <span role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
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
                                    </div>

                                    <!-- end card body -->
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Thương hiệu</h5>
                                    </div>
                                    <div class="card-body">
                                        <select class="form-select" id="choices-category-input" name="brand_id"
                                            data-choices data-choices-search-false>
                                            @foreach ($brands as $key => $value)
                                                <option value="{{ $key }}">{{ $value }}</option>
                                            @endforeach

                                        </select>
                                    </div>
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
                                        <h5 class="card-title mb-0">Đơn vị</h5>
                                    </div>
                                    <div class="card-body">
                                        <select class="form-select" id="choices-category-input" name="unit_id"
                                            data-choices data-choices-search-false>
                                            @foreach ($units as $key => $value)
                                                <option value="{{ $key }}">{{ $value }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>


                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Sản phẩm mua</h4>
                                <button type="button" class="ri-add-line align-bottom me-1 btn btn-primary"
                                    onclick="addProduct()">Thêm sản phẩm</button>
                            </div>
                            <div class="card-body">
                                <div class="live-preview">
                                    <div class="row gy-4" id="product_list">
                                        <div class="col-md-12" id="product_default_item">
                                            <div class="mb-2">
                                                <label class="form-label" for="product-name-input">Tên biến thể</label>
                                                <input type="number" class="form-control" id="product-name-input"
                                                    name="product_name[]">
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-2">
                                                        <label class="form-label" for="product-price-input">Giá sản
                                                            phẩm</label>
                                                        <input type="number" class="form-control"
                                                            id="product-price-input" name="product_price[]">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-2">
                                                        <label class="form-label" for="product-quantity-input">Số lượng
                                                            sản
                                                            phẩm</label>
                                                        <input type="number"
                                                            class="form-control  @error('product_quantity') is-invalid @enderror"
                                                            id="product-quantity-input" name="product_quantity[]"
                                                            placeholder="Nhập số lượng">
                                                        @error('product_quantity')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
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




@section('scripts')
    <script>
        // Hàm để thêm sản phẩm mới
        function addProduct() {
            let id = 'product_' + Math.random().toString(36).substring(2, 15).toLowerCase();
            let html = `
            <div class="col-md-12" id="${id}_item">
                <hr class="mb-2">
                <div class="mb-2">
                    <label class="form-label" for="product-name-input">Tên biến thể</label>
                    <input type="number" class="form-control" id="product-name-input"
                    name="product_name[]">
                    </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-2">
                            <label class="form-label" for="product-price-input">Giá sản phẩm</label>
                            <input type="number" class="form-control" name="product_price[]">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-2">
                            <label class="form-label" for="product-quantity-input">Số lượng sản phẩm</label>
                            <input type="number" class="form-control  @error('product_quantity') is-invalid @enderror" name="product_quantity[]" placeholder="Nhập số lượng" min="1">
                            @error('product_quantity')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="mb-2">
                    <button type="button" class="btn btn-danger" onclick="removeProduct('${id}_item')">
                        <span class="bx bx-trash"></span> Xóa sản phẩm
                    </button>
                </div>
            </div>
            `;

            document.getElementById('product_list').insertAdjacentHTML('beforeend', html);
            addInputListeners(); // Thêm sự kiện lắng nghe cho sản phẩm mới
        }

        // Hàm để xóa sản phẩm
        function removeProduct(id) {
            if (confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')) {
                document.getElementById(id).remove();
                calculateTotal();
            }
        }

        // Gọi hàm khi trang được tải lần đầu
        document.addEventListener('DOMContentLoaded', function() {
            addInputListeners();
            calculateTotal();
        });
    </script>
@endsection

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
                                <a href="{{ route('product.index') }}" class="btn btn-success" id="addproduct-btn">Danh sách
                                    sản phẩm</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-8">
                                 <!-- Danh mục -->
                                 <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title mb-0">Danh mục</h5>
                                        <select class="form-select mt-2" name="category_id">
                                            @foreach ($categories as $key => $value)
                                                <option value="{{ $key }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label class="form-label" for="product-title-input">Tên sản phẩm</label>
                                            <input type="text" class="form-control" id="product-title-input"
                                                value="" placeholder="Thêm sản phẩm" name="name">
                                            @error('title')
                                                <span role="alert">
                                                    <span class="text-danger">{{ $message }}</span>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label class="form-label" for="product-price-input">Giá sản phẩm</label>
                                            <input type="text" class="form-control" id="product-price-input"
                                                value="" placeholder="Thêm giá sản phẩm" name="price">
                                            @error('price')
                                                <span role="alert">
                                                    <span class="text-danger">{{ $message }}</span>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Phần mô tả -->
                                <div class="card">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div>
                                                <label class="form-label" for="meta-description-input">Mô tả</label>
                                                <textarea class="form-control" id="meta-description-input" placeholder="Nhập nội dung" rows="8"
                                                    name="description"></textarea>
                                                @error('description')
                                                    <span role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-body d-flex justify-content-around">
                                        <div class="form-check form-switch form-switch">
                                            <input class="form-check-input" type="checkbox" name="is_active" value="1"
                                                id="is_active" checked>
                                            <label class="form-check-label" for="is_active">Hiển thị</label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Thương hiệu -->
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title mb-0">Thương hiệu</h5>
                                        <select class="form-select mt-2" name="brand_id">
                                            @foreach ($brands as $key => $value)
                                                <option value="{{ $key }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                               

                                <!-- Đơn vị -->
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title mb-0">Đơn vị</h5>
                                        <select class="form-select mt-2" name="unit_id">
                                            @foreach ($units as $key => $value)
                                                <option value="{{ $key }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- Loại biến thể -->
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title mb-0">Chọn loại biến thể:</h5>
                                        <div class="mb-3 variant-checkbox-group">
                                            <label class="variant-checkbox">
                                                <input type="checkbox" name="variant_types[]" value="color"> 
                                                <span>Màu sắc</span>
                                            </label>
                                            <label class="variant-checkbox">
                                                <input type="checkbox" name="variant_types[]" value="size"> 
                                                <span>Kích thước</span>
                                            </label>
                                            <label class="variant-checkbox">
                                                <input type="checkbox" name="variant_types[]" value="material"> 
                                                <span>Chất liệu</span>
                                            </label>
                                            <label class="variant-checkbox">
                                                <input type="checkbox" name="variant_types[]" value="style"> 
                                                <span>Kiểu dáng</span>
                                            </label>
                                        </div>
                                        <button type="button" class="btn btn-primary" onclick="getSelectedValues()">Lưu</button>
                                
                                        <!-- Hiển thị biến thể -->
                                        <div id="variant-output" style="margin-top: 10px;"></div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="col-lg-12">
                                <div id="selected-variants" style="margin-top: 10px;"></div>
                            </div>
                            <div class="mt-3">
                                <button class="btn btn-success text">Thêm mới</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>

        // Tạo biến thể
        // Hàm tạo tất cả các kết hợp giữa các giá trị biến thể
        function generateCombinations(arrays) {
            if (arrays.length === 0) return [];
            if (arrays.length === 1) return arrays[0].map(item => [item]);

            const combinations = [];
            const restCombinations = generateCombinations(arrays.slice(1));

            arrays[0].forEach(item => {
                restCombinations.forEach(combo => {
                    combinations.push([item, ...combo]);
                });
            });

            return combinations;
        }

        function getSelectedValues() {
            // Lấy các loại biến thể được chọn (checkbox)
            const selectedVariants = [];
            $('input[name="variant_types[]"]:checked').each(function() {
                selectedVariants.push($(this).val());
            });

            // Dữ liệu mẫu cho giá trị biến thể (sửa ở đây nếu cần)
            const variantValues = {
                color: ['Xanh', 'Đỏ', 'Vàng'], // Giá trị cố định cho color
                size: ['S', 'M', 'L'], // Giá trị cố định cho size
                material: ['Cotton', 'Lụa'], // Giá trị cố định cho material
                style: ['Cổ điển', 'Hiện đại'] // Giá trị cố định cho style
            };

            // Lấy các giá trị biến thể theo loại được chọn
            const selectedVariantValues = selectedVariants.map(variant => variantValues[variant]);

            // Tạo tất cả các kết hợp từ các giá trị biến thể đã chọn
            const combinations = generateCombinations(selectedVariantValues);

            // Hiển thị các kết quả
            const resultDiv = $('#selected-variants');
            resultDiv.empty(); // Xóa nội dung cũ

            combinations.forEach(combo => {
                resultDiv.append('<div>' + combo.join(' - ') + '</div>');
            });
        }
    </script>
@endsection

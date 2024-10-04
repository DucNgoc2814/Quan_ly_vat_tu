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
                                        <div class="mb-3 variant-checkbox-group mt-3">
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
                                        <button type="button" class="btn btn-primary"
                                            onclick="getSelectedValues()">Lưu</button>

                                        <!-- Hiển thị biến thể -->
                                        <div id="variant-output" style="margin-top: 10px;"></div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="mb-3" id="image-inputs">
                                            <label class="form-label" for="product-images-input">Ảnh sản phẩm</label>
                                            <input type="file" class="form-control mb-2" name="product_images[]" accept="image/*" onchange="previewImages(this)">
                                            @error('images')
                                                <span role="alert">
                                                    <span class="text-danger">{{ $message }}</span>
                                                </span>
                                            @enderror
                                        </div>
                                        <button type="button" class="btn btn-primary" onclick="addImageInput()">Thêm ảnh</button>
                                        <div id="image-preview" class="mt-2"></div>
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
        function getSelectedValues() {
            // Lấy các loại biến thể được chọn (checkbox)
            const selectedVariants = [];
            $('input[name="variant_types[]"]:checked').each(function() {
                selectedVariants.push($(this).val());
            });

            // Kiểm tra số lượng biến thể đã chọn
            if (selectedVariants.length > 2) {
                alert('Bạn chỉ có thể chọn tối đa 2 loại biến thể.');
                // Bỏ chọn biến thể cuối cùng
                $(this).prop('checked', false);
                return; // Ngừng hàm nếu vượt quá
            }

            // Dữ liệu mẫu cho giá trị biến thể
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
                const id = combo.join('_'); // Tạo id từ kết hợp

                // Gán giá trị vào ô số 1 và số 2 từ các biến thể
                const value1 = combo[0]; // Gán giá trị của biến thể đầu tiên
                const value2 = combo[1] || ''; // Gán giá trị của biến thể thứ hai (nếu có)

                const html = `
                <div class="col-lg-12">
                    <div class="col-md-12" id="${id}_item">
                        <hr class="mb-2">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="mb-2">
                                    <label class="form-label" for="product-quantity-input">Giá trị biến thể 1</label>
                                    <input type="text" class="form-control" value="${value1}" readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-2">
                                    <label class="form-label" for="product-stock-input">Giá trị biến thể 2</label>
                                    <input type="text" class="form-control" value="${value2}" readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-2">
                                    <label class="form-label" for="product-stock-input">Giá chi tiết</label>
                                    <input type="number" class="form-control" name="price">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-2">
                                    <label class="form-label" for="product-stock-input">Số lượng</label>
                                    <input type="number" class="form-control" name="stock">
                                </div>
                            </div>
                        </div>
     
                    </div>
                </div>
            `;
                resultDiv.append(html);
            });
        }
        function addImageInput() {
    // Tạo một trường input mới
    const newInput = document.createElement('input');
    newInput.type = 'file';
    newInput.className = 'form-control mb-2';
    newInput.name = 'product_images[]'; // Tên của trường
    newInput.accept = 'image/*';
    newInput.onchange = function() {
        previewImages(this); // Gọi hàm previewImages khi người dùng chọn ảnh
    };

    // Thêm trường input mới vào div chứa các input ảnh
    document.getElementById('image-inputs').appendChild(newInput);
}

function previewImages(input) {
    const previewContainer = document.getElementById('image-preview');
    const files = input.files;
    
    for (let i = 0; i < files.length; i++) {
        const file = files[i];
        const reader = new FileReader();

        reader.onload = function(e) {
            const img = document.createElement('img');
            img.src = e.target.result; // Thiết lập nguồn cho ảnh
            previewContainer.appendChild(img); // Thêm ảnh vào preview
        }

        reader.readAsDataURL(file); // Đọc file
    }
}

        // Hàm để tạo tất cả các kết hợp từ mảng
        function generateCombinations(arrays) {
            return arrays.reduce((accumulator, current) => {
                const combinations = [];
                accumulator.forEach(accItem => {
                    current.forEach(curItem => {
                        combinations.push([...accItem, curItem]);
                    });
                });
                return combinations.length ? combinations : [
                    []
                ]; // Trả về một mảng rỗng nếu không có kết hợp nào
            }, [
                []
            ]);
        }
    </script>
@endsection

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
                                            <option value="" selected>Chọn danh mục</option>
                                            @foreach ($categories as $key => $value)
                                                <option value="{{ $key }}"
                                                    {{ old('category_id') == $key ? 'selected' : '' }}>{{ $value }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <span role="alert">
                                                <span class="text-danger">{{ $message }}</span>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label class="form-label" for="product-title-input">Tên sản phẩm</label>
                                            <input type="text" class="form-control" id="product-title-input"
                                                value="{{ old('name') }}" placeholder="Thêm sản phẩm" name="name">
                                            @error('name')
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
                                                value="{{ old('price') }}" placeholder="Thêm giá sản phẩm" name="price">
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
                                                    name="description">{{ old('description') }}</textarea>
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
                                                id="is_active" {{ old('is_active') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_active">Hiển thị</label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Thương hiệu -->
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title mb-0">Chọn thương hiệu</h5>
                                        <select class="form-select mt-2" name="brand_id">
                                            <option value="" selected>Chọn thương hiệu</option>
                                            @foreach ($brands as $key => $value)
                                                <option value="{{ $key }}"
                                                    {{ old('brand_id') == $key ? 'selected' : '' }}>{{ $value }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('brand_id')
                                            <span role="alert">
                                                <span class="text-danger">{{ $message }}</span>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Đơn vị -->
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title mb-0">Chọn đơn vị</h5>
                                        <select class="form-select mt-2" name="unit_id">
                                            <option value="" selected>Chọn đơn vị</option>
                                            @foreach ($units as $key => $value)
                                                <option value="{{ $key }}"
                                                    {{ old('unit_id') == $key ? 'selected' : '' }}>{{ $value }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('unit_id')
                                            <span role="alert">
                                                <span class="text-danger">{{ $message }}</span>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Loại biến thể -->
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title mb-0">Chọn loại biến thể:</h5>
                                        <div class="mb-3 variant-checkbox-group mt-3">
                                            @foreach ($attributesArray as $id => $attribute)
                                                <label class="variant-checkbox">
                                                    <input type="checkbox" name="variant_types[]"
                                                        value="{{ $attribute['id'] }}"
                                                        {{ in_array($attribute['id'], old('variant_types', [])) ? 'checked' : '' }}>
                                                    <span>{{ $attribute['name'] }}</span>
                                                </label>
                                            @endforeach
                                        </div>
                                        <button type="button" class="btn btn-success"
                                            onclick="getSelectedValues()">Lưu</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div class="d-flex justify-content-lg-between">
                                                <label class="form-label" for="product-images-input">Ảnh sản phẩm</label>
                                                <!-- Nút để thêm ảnh -->
                                                <button type="button" class="btn btn-primary" id="add-image-button">Thêm
                                                    ảnh</button>
                                            </div>
                                            <div class="mt-3" id="image-inputs">
                                                <!-- Ô nhập ảnh mặc định đầu tiên -->
                                                <div class="position-relative d-inline-block mb-4 me-4">
                                                    <div class="position-absolute top-100 start-100 translate-middle">
                                                        <label for="product-image-0" class="mb-0"
                                                            data-bs-toggle="tooltip" data-bs-placement="right"
                                                            title="Chọn ảnh">
                                                            <div class="avatar-xs">
                                                                <div
                                                                    class="avatar-title bg-light border rounded-circle text-muted cursor-pointer">
                                                                    <i class="ri-image-fill"></i>
                                                                </div>
                                                            </div>
                                                        </label>
                                                        <input class="form-control d-none" id="product-image-0"
                                                            type="file" accept="image/png, image/gif, image/jpeg"
                                                            name="product_images[]" onchange="displayImage(event, 0)">
                                                    </div>
                                                    <div class="avatar-lg">
                                                        <div class="avatar-title bg-light rounded">
                                                            <img src="" id="product-img-0"
                                                                class="avatar-md h-auto" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div id="selected-variants" style="margin-top: 10px;"></div>
                            </div>

                            <div class="mt-3">
                                <button class="btn btn-success text">Sửa</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <script>
        function getSelectedValues() {
            const selectedVariants = [];
            $('input[name="variant_types[]"]:checked').each(function() {
                selectedVariants.push($(this).val());
            });

            // Check the limit of variants
            if (selectedVariants.length > 2) {
                alert('Bạn chỉ có thể chọn tối đa 2 loại biến thể.');
                return false;
            }

            const variantValues = @json($attributesArray);
            const selectedVariantValues = selectedVariants.map(variant => {
                const attribute = variantValues.find(attr => attr.id == variant);
                return attribute ? attribute.attribute_values : [];
            });

            const combinations = generateCombinations(selectedVariantValues);
            const resultDiv = $('#selected-variants');
            resultDiv.empty();

            combinations.forEach(combo => {
                const id = combo.map(item => item.id).join('_');

                const variantLabels = selectedVariants.map((type, index) => {
                    const variantValue = combo[index];
                    const variantName = variantValues.find(attr => attr.id == type).name;
                    return `
                <div class="col-md-3">
                    <div class="mb-2">
                        <label class="form-label">${variantName}</label>
                        <input type="hidden" name="variants[${id}][attribute_value_ids][]" value="${variantValue.id}">
                        <input type="text" class="form-control" name="variants[${id}][attribute_value_values][]" value="${variantValue.value}" readonly>
                    </div>
                </div>
            `;
                }).join('');

                const html = `
    <div class="col-lg-12">
        <div class="col-md-12" id="${id}_item">
            <hr class="mb-2">
            <div class="row">
                ${variantLabels}
                <div class="col-md-3">
                    <div class="mb-2">
                        <label class="form-label">Giá chi tiết</label>
                        <input type="number" class="form-control" name="variants[${id}][price]">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-2">
                        <label class="form-label">Số lượng</label>
                        <input type="number" class="form-control" name="variants[${id}][stock]">
                    </div>
                </div>
            </div>
        </div>
    </div>
`;
                resultDiv.append(html);
            });
        }

        let imageCount = 1; // Biến đếm để tạo ID duy nhất cho mỗi input ảnh

        // Hàm hiển thị ảnh xem trước
        function displayImage(event, count) {
            event.preventDefault(); // Ngăn chặn sự kiện mặc định gây cuộn trang
            var output = document.getElementById('product-img-' + count);
            if (event.target.files.length > 0) { // Kiểm tra xem có file nào được chọn không
                output.src = URL.createObjectURL(event.target.files[0]);
                output.onload = function() {
                    URL.revokeObjectURL(output.src); // Giải phóng bộ nhớ
                }
            }
        }

        // Hàm thêm input ảnh mới
        function addImageInput() {
            const inputId = 'product-image-input-' + imageCount; // Tạo ID duy nhất cho input
            const imgId = 'product-img-' + imageCount; // Tạo ID duy nhất cho ảnh

            // Tạo container cho input và ảnh xem trước
            const imageContainer = document.createElement('div');
            imageContainer.className = 'position-relative d-inline-block mb-4 me-4';

            const labelWrapper = document.createElement('div');
            labelWrapper.className = 'position-absolute top-100 start-100 translate-middle';

            const label = document.createElement('label');
            label.className = 'mb-0';
            label.setAttribute('for', inputId); // Đặt ID duy nhất cho label

            label.innerHTML = `<div class="avatar-xs">
                        <div class="avatar-title bg-light border rounded-circle text-muted cursor-pointer">
                            <i class="ri-image-fill"></i>
                        </div>
                    </div>`;

            // Tạo input file mới để chọn ảnh
            const input = document.createElement('input');
            input.className = 'form-control d-none';
            input.type = 'file';
            input.accept = 'image/png, image/gif, image/jpeg';
            input.name = 'product_images[]';
            input.id = inputId;
            input.setAttribute('onchange', `displayImage(event, ${imageCount})`);

            // Tạo vùng xem trước ảnh
            const previewContainer = document.createElement('div');
            previewContainer.className = 'avatar-lg';
            previewContainer.innerHTML = `<div class="avatar-title bg-light rounded">
                                    <img src="" id="${imgId}" class="avatar-md h-auto" />
                                  </div>`;

            labelWrapper.appendChild(label);
            labelWrapper.appendChild(input);
            imageContainer.appendChild(labelWrapper);
            imageContainer.appendChild(previewContainer);

            // Thêm toàn bộ phần tử mới vào vùng chứa ảnh
            document.getElementById('image-inputs').appendChild(imageContainer);

            // Tăng biến đếm cho các input tiếp theo
            imageCount++;
        }
        // Kết nối sự kiện click với nút thêm ảnh
        document.getElementById('add-image-button').addEventListener('click', addImageInput);
        // Kết nối sự kiện click với nút thêm ảnh
        document.getElementById('add-image-button').addEventListener('click', addImageInput);




        // Hàm để tạo tất cả các kết hợp từ mảng
        function generateCombinations(arrays) {
            // Kiểm tra xem có mảng nào trống không
            if (arrays.some(array => array.length === 0)) {
                return []; // Trả về mảng rỗng nếu có mảng trống
            }

            return arrays.reduce((accumulator, current) => {
                const combinations = [];
                accumulator.forEach(accItem => {
                    current.forEach(curItem => {
                        combinations.push([...accItem, curItem]);
                    });
                });
                return combinations;
            }, [
                []
            ]); // Bắt đầu với một mảng chứa một mảng rỗng
        }
    </script>
@endsection

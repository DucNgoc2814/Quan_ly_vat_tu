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
                                <a href="{{ route('product.index') }}" class="btn btn-success" id="addproduct-btn">
                                    Danh sách sản phẩm
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data"
                        onsubmit="validateVariantQuantities(event)">
                        @csrf
                        <div class="row">
                            <div class="col-lg-8">
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

                                <div class="card">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div>
                                                <label class="form-label">Ảnh sản phẩm</label>
                                                <div class="mt-3" id="image">
                                                    <div class="position-relative d-inline-block mb-4 me-4">
                                                        <div class="position-absolute top-100 start-100 translate-middle">
                                                            <label for="product-image-main" class="mb-0"
                                                                data-bs-toggle="tooltip" data-bs-placement="right"
                                                                title="Chọn ảnh sản phẩm">
                                                                <div class="avatar-xs">
                                                                    <div
                                                                        class="avatar-title bg-light border rounded-circle text-muted cursor-pointer">
                                                                        <i class="ri-image-fill"></i>
                                                                    </div>
                                                                </div>
                                                            </label>
                                                            <input class="form-control d-none" id="product-image-main"
                                                                type="file" name="image"
                                                                onchange="displayMainImage(event)">
                                                        </div>
                                                        <div class="avatar-lg">
                                                            <div class="avatar-title bg-light rounded">
                                                                <img src="" id="product-img-main"
                                                                    class="avatar-md h-auto" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @error('image')
                                                    <span role="alert">
                                                        <span class="text-danger">{{ $message }}</span>
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
                                                <label class="form-label" for="meta-description-input">Mô tả</label>
                                                <textarea class="form-control" id="meta-description-input" placeholder="Nhập nội dung" rows="8"
                                                    name="description">{{ old('description') }}</textarea>
                                                @error('description')
                                                    <span role="alert">
                                                        <span class="text-danger">{{ $message }}</span>
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

                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title mb-0">Danh mục</h5>
                                        <select class="form-select mt-2" name="category_id">
                                            <option value="" selected>Chọn danh mục</option>
                                            @foreach ($categories as $key => $value)
                                                <option value="{{ $key }}"
                                                    {{ old('category_id') == $key ? 'selected' : '' }}>
                                                    {{ $value }}
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
                                        <h5 class="card-title mb-0">Chọn thương hiệu</h5>
                                        <select class="form-select mt-2" name="brand_id">
                                            <option value="" selected>Chọn thương hiệu</option>
                                            @foreach ($brands as $key => $value)
                                                <option value="{{ $key }}"
                                                    {{ old('brand_id') == $key ? 'selected' : '' }}>
                                                    {{ $value }}
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

                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title mb-0">Chọn đơn vị</h5>
                                        <select class="form-select mt-2" name="unit_id">
                                            <option value="" selected>Chọn đơn vị</option>
                                            @foreach ($units as $key => $value)
                                                <option value="{{ $key }}"
                                                    {{ old('unit_id') == $key ? 'selected' : '' }}>
                                                    {{ $value }}
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

                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title mb-0">Chọn loại sản phẩm:</h5>
                                        <select class="form-select mt-2" name="product_type" id="product_type"
                                            onchange="toggleVariantOptions()">
                                            <option value="0" {{ old('product_type') == '0' ? 'selected' : '' }}>Sản
                                                phẩm thường</option>
                                            <option value="1" {{ old('product_type') == '1' ? 'selected' : '' }}>Sản
                                                phẩm biến thể</option>
                                        </select>
                                        @error('product_type')
                                            <span role="alert">
                                                <span class="text-danger">{{ $message }}</span>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="card" id="quantity-section" style="display: none;">
                                    <div class="card-body">
                                        <h5 class="card-title mb-0">Nhập số lượng:</h5>
                                        <input type="number" class="form-control mt-2" name="quantity"
                                            placeholder="Nhập số lượng" min="0" value="{{ old('quantity') }}">
                                        @error('quantity')
                                            <span role="alert">
                                                <span class="text-danger">{{ $message }}</span>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div class="d-flex justify-content-lg-between">
                                                <label class="form-label">Bộ sưu tập ảnh sản phẩm</label>
                                                <button type="button" class="btn btn-primary" id="add-image-button">
                                                    Thêm ảnh
                                                </button>
                                            </div>
                                            <div class="mt-3" id="image-inputs">
                                                <input type="hidden" name="image_count" id="image_count"
                                                    value="{{ old('image_count', 1) }}">

                                                @for ($i = 0; $i < old('image_count', 1); $i++)
                                                    <div class="position-relative d-inline-block mb-4 me-4"
                                                        id="image-container-{{ $i }}">
                                                        <div class="position-absolute top-100 start-100 translate-middle">
                                                            <label for="product-image-{{ $i }}" class="mb-0"
                                                                data-bs-toggle="tooltip" data-bs-placement="right"
                                                                title="Chọn ảnh">
                                                                <div class="avatar-xs">
                                                                    <div
                                                                        class="avatar-title bg-light border rounded-circle text-muted cursor-pointer">
                                                                        <i class="ri-image-fill"></i>
                                                                    </div>
                                                                </div>
                                                            </label>
                                                            <input class="form-control d-none"
                                                                id="product-image-{{ $i }}" type="file"
                                                                accept="image/png, image/gif, image/jpeg"
                                                                name="product_images[]"
                                                                onchange="displayImage(event, {{ $i }})">
                                                        </div>
                                                        <div class="avatar-lg">
                                                            <div class="avatar-title bg-light rounded">
                                                                <img src="" id="product-img-{{ $i }}"
                                                                    class="avatar-md h-auto" />
                                                            </div>
                                                        </div>
                                                        @if ($i > 0)
                                                            <button type="button"
                                                                class="btn btn-danger btn-sm position-absolute top-0 end-0"
                                                                onclick="removeImageInput('image-container-{{ $i }}')">
                                                                <i class="ri-delete-bin-line"></i>
                                                            </button>
                                                        @endif
                                                    </div>
                                                @endfor
                                            </div>


                                            @error('product_images')
                                                <span role="alert">
                                                    <span class="text-danger">{{ $message }}</span>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card" id="variant-section">
                                <div class="card-body">
                                    <h5 class="card-title mb-0">Chọn loại biến thể:</h5>
                                    <div class="mb-3 variant-checkbox-group mt-3">
                                        @foreach ($attributesArray as $attribute)
                                            <label class="variant-checkbox">
                                                <input onchange="getSelectedValues(event)" type="checkbox"
                                                    name="variant_types[]" value="{{ $attribute['id'] }}"
                                                    {{ in_array($attribute['id'], old('variant_types', [])) ? 'checked' : '' }}>
                                                <span>{{ $attribute['name'] }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                    <span class="err-variant text-danger"></span>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div id="selected-variants" style="margin-top: 10px;">
                                    @if (old('variants'))
                                        @foreach (old('variants') as $id => $variant)
                                            <div class="col-lg-12">
                                                <div class="col-md-12" id="{{ $id }}_item">
                                                    <hr class="mb-2">
                                                    <div class="row">
                                                        @foreach ($variant['attribute_value_ids'] as $key => $value_id)
                                                            <div class="col-md-3">
                                                                <div class="mb-2">
                                                                    <label
                                                                        class="form-label">{{ $attributesArray[$key]['name'] }}</label>
                                                                    <input type="hidden"
                                                                        name="variants[{{ $id }}][attribute_value_ids][]"
                                                                        value="{{ $value_id }}">
                                                                    <input type="text" class="form-control"
                                                                        name="variants[{{ $id }}][attribute_value_values][]"
                                                                        value="{{ $variant['attribute_value_values'][$key] }}"
                                                                        readonly>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                        <div class="col-md-3">
                                                            <div class="mb-2">
                                                                <label class="form-label">Giá chi tiết</label>
                                                                <input type="number" class="form-control"
                                                                    name="variants[{{ $id }}][price]"
                                                                    value=""
                                                                    placeholder="Giá như trên nếu không nhập">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="mb-2">
                                                                <label class="form-label">Số lượng</label>
                                                                <input type="number" class="form-control"
                                                                    name="variants[{{ $id }}][stock]"
                                                                    value="" min="0"
                                                                    placeholder="Nhập số lượng">
                                                                @error('variants.' . $id . '.stock')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-1 d-flex align-items-center">
                                                            <button type="button" class="btn btn-danger"
                                                                onclick="removeVariant('{{ $id }}')">
                                                                <i class="ri-delete-bin-5-line"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <div class="mt-3">
                                <button class="btn btn-success text" id="btn-submit" ">Thêm mới</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <style>
                    .is-invalid {
                        border-color: #dc3545;
                    }
                </style>
                <script>
                    function getSelectedValues(e) {
                        const selectedVariants = [];
                        $('input[name="variant_types[]"]:checked').each(function() {
                            selectedVariants.push($(this).val());
                        });
                        if (selectedVariants.length === 0) {
                            alert('Bạn phải chọn ít nhất một loại biến thể.');
                            event.preventDefault(); // Ngăn hành động mặc định
                            event.target.checked = true;
                            return false;
                        }
                        // Check the limit of variants
                        if (selectedVariants.length > 2) {
                            alert('Bạn chỉ có thể chọn tối đa 2 loại biến thể.');
                            e.preventDefault();
                            return e.target.checked = false;
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
                        <input type="number" class="form-control" name="variants[${id}][price]" placeholder="Giá như trên nếu không nhập">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="mb-2">
                        <label class="form-label">Số lượng</label>
                        <input type="number" class="form-control" name="variants[${id}][stock]"
                    min="0" placeholder="Nhập số lượng">
                    </div>
                </div>
                <div class="col-md-1 d-flex align-items-center">
                    <button type="button" class="btn btn-danger" onclick="removeVariant('${id}')">
                        <i class="ri-delete-bin-5-line"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
`;
                            resultDiv.append(html);
                        });
                    }

                    function removeVariant(id) {
                        const variantItems = document.querySelectorAll('[id$="_item"]'); // Lấy tất cả các biến thể
                        if (variantItems.length <= 1) {
                            alert('Bạn không thể xóa biến thể cuối cùng.'); // Thông báo nếu chỉ còn một biến thể
                            return; // Ngăn không cho xóa
                        }

                        const variantItem = document.getElementById(id + '_item');
                        if (variantItem) {
                            variantItem.remove(); // Xóa biến thể khỏi DOM
                        }
                    }

                    let imageCount = {{ old('image_count', 1) }};


                    // Hm hiển thị ảnh xem trước
                    function displayImage(event, count) {
                        event.preventDefault(); // Ngăn chặn sự kiện mặc định gây cuộn trang
                        var output = document.getElementById('product-img-' + count);
                        if (event.target.files.length > 0) { // Kiểm tra xem có file nào được chọn không
                            output.src = URL.createObjectURL(event.target.files[0]);
                            output.onload = function() {
                                URL.revokeObjectURL(output.src); // Giải phóng bộ nhớ
                                // Đặt kích thước mặc định cho ảnh
                                output.style.width = '50px'; // Kích thước chiều rộng
                                output.style.height = '50px'; // Kích thước chiều cao
                                output.style.objectFit = 'cover'; // Đảm bảo ảnh không bị méo
                            }
                        }
                    }

                    // Hàm thêm input ảnh mới
                    function addImageInput() {
                        imageCount++;
                        document.getElementById('image_count').value = imageCount;

                        const html = `
        <div class="position-relative d-inline-block mb-4 me-4" id="image-container-${imageCount-1}">
            <div class="position-absolute top-100 start-100 translate-middle">
                <label for="product-image-${imageCount-1}" class="mb-0" data-bs-toggle="tooltip" data-bs-placement="right" title="Chọn ảnh">
                    <div class="avatar-xs">
                        <div class="avatar-title bg-light border rounded-circle text-muted cursor-pointer">
                            <i class="ri-image-fill"></i>
                        </div>
                    </div>
                </label>
                <input class="form-control d-none" id="product-image-${imageCount-1}"
                    type="file" accept="image/png, image/gif, image/jpeg"
                    name="product_images[]" onchange="displayImage(event, ${imageCount-1})">
            </div>
            <div class="avatar-lg">
                <div class="avatar-title bg-light rounded">
                    <img src="" id="product-img-${imageCount-1}" class="avatar-md h-auto" />
                </div>
            </div>
            <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0"
                onclick="removeImageInput('image-container-${imageCount-1}')">
                <i class="ri-delete-bin-line"></i>
            </button>
        </div>
    `;
                        document.getElementById('image-inputs').insertAdjacentHTML('beforeend', html);
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

                    function displayMainImage(event) {
                        const output = document.getElementById('product-img-main');
                        if (event.target.files.length > 0) {
                            output.src = URL.createObjectURL(event.target.files[0]);
                            output.style.width = '50px';
                            output.style.height = '50px';
                            output.style.objectFit = 'cover';
                        }
                    }

                    function toggleVariantOptions() {
                        const productType = document.getElementById('product_type').value;
                        const variantSection = document.getElementById('variant-section');
                        const quantitySection = document.getElementById('quantity-section');

                        if (productType === '1') {
                            variantSection.style.display = 'block'; // Hiện phần chọn biến thể
                            quantitySection.style.display = 'none'; // Ẩn phần nhập số lượng
                        } else {
                            variantSection.style.display = 'none'; // Ẩn phần chọn biến thể
                            quantitySection.style.display = 'block'; // Hiện phần nhập số lượng

                            // Xóa tất cả các biến thể nếu chọn sản phẩm thường
                            const variantItems = document.querySelectorAll('[id$="_item"]'); // Lấy tất cả các biến thể
                            variantItems.forEach(item => item.remove()); // Xóa từng biến thể
                        }
                    }

                    function removeImageInput(containerId) {
                        document.getElementById(containerId).remove();
                        imageCount -= 1;
                    }
                    // Gọi hàm để thiết lập trạng thái ban đầu
                    document.addEventListener('DOMContentLoaded', toggleVariantOptions);

                    document.addEventListener('DOMContentLoaded', function() {
                        // Set initial product type
                        const savedProductType = '{{ old('product_type', '0') }}';
                        if (savedProductType === '1') {
                            toggleVariantOptions();

                            // Re-check previously selected variant types
                            const savedVariantTypes = @json(old('variant_types', []));
                            savedVariantTypes.forEach(type => {
                                document.querySelector(`input[name="variant_types[]"][value="${type}"]`).checked = true;
                            });

                            // Trigger variant generation
                            if (savedVariantTypes.length > 0) {
                                getSelectedValues({
                                    target: document.querySelector('input[name="variant_types[]"]:checked')
                                });
                            }
                        }
                    });

                    function toggleVariantOptions() {
                        const productType = document.getElementById('product_type').value;
                        const variantSection = document.getElementById('variant-section');
                        const quantitySection = document.getElementById('quantity-section');

                        if (productType === '1') {
                            variantSection.style.display = 'block';
                            quantitySection.style.display = 'none';
                        } else {
                            variantSection.style.display = 'none';
                            quantitySection.style.display = 'block';

                            // Clear variants when switching to regular product
                            const selectedVariants = document.getElementById('selected-variants');
                            if (selectedVariants) {
                                selectedVariants.innerHTML = '';
                            }
                        }
                    }

                    function validateVariantQuantities(event) {
                        const quantityInputs = document.querySelectorAll('input[name$="[stock]"]');
                        // const priceInputs = document.querySelectorAll('input[name$="[price]"]');
                        const mainPrice = document.getElementById('product-price-input');
                        const productName = document.getElementById('product-title-input');
                        const description = document.getElementById('meta-description-input');
                        const category = document.querySelector('select[name="category_id"]');
                        const brand = document.querySelector('select[name="brand_id"]');
                        const unit = document.querySelector('select[name="unit_id"]');
                        const mainImage = document.getElementById('product-image-main');
                        const galleryImages = document.querySelectorAll('input[name="product_images[]"]');
                        let isValid = true;

                        // Validate main image
                        if (!mainImage.files || mainImage.files.length === 0) {
                            isValid = false;
                            mainImage.classList.add('is-invalid');
                            const mainImageContainer = mainImage.closest('.position-relative');
                            addErrorMessage(mainImageContainer, 'Vui lòng chọn ảnh chính cho sản phẩm');
                        } else {
                            mainImage.classList.remove('is-invalid');
                            const mainImageContainer = mainImage.closest('.position-relative');
                            removeErrorMessage(mainImageContainer);
                        }

                        // Validate gallery images
                        let hasValidGalleryImage = false;
                        galleryImages.forEach(input => {
                            if (input.files && input.files.length > 0) {
                                hasValidGalleryImage = true;
                            }
                        });

                        if (!hasValidGalleryImage) {
                            isValid = false;
                            const galleryContainer = document.getElementById('image-inputs');
                            addErrorMessage(galleryContainer, 'Vui lòng chọn ít nhất một ảnh cho bộ sưu tập');
                        } else {
                            const galleryContainer = document.getElementById('image-inputs');
                            removeErrorMessage(galleryContainer);
                        }

                        // Validate product name
                        if (!productName.value.trim()) {
                            isValid = false;
                            productName.classList.add('is-invalid');
                            addErrorMessage(productName, 'Vui lòng nhập tên sản phẩm');
                        } else {
                            productName.classList.remove('is-invalid');
                            removeErrorMessage(productName);
                        }

                        // Validate category
                        if (!category.value) {
                            isValid = false;
                            category.classList.add('is-invalid');
                            addErrorMessage(category, 'Vui lòng chọn danh mục');
                        } else {
                            category.classList.remove('is-invalid');
                            removeErrorMessage(category);
                        }

                        // Validate brand
                        if (!brand.value) {
                            isValid = false;
                            brand.classList.add('is-invalid');
                            addErrorMessage(brand, 'Vui lòng chọn thương hiệu');
                        } else {
                            brand.classList.remove('is-invalid');
                            removeErrorMessage(brand);
                        }

                        // Validate unit
                        if (!unit.value) {
                            isValid = false;
                            unit.classList.add('is-invalid');
                            addErrorMessage(unit, 'Vui lòng chọn đơn vị');
                        } else {
                            unit.classList.remove('is-invalid');
                            removeErrorMessage(unit);
                        }

                        // Validate main price
                        if (!mainPrice.value.trim() || isNaN(mainPrice.value) || Number(mainPrice.value) <= 0 || Number(mainPrice
                            .value) > 1000000000) {
                            isValid = false;
                            mainPrice.classList.add('is-invalid');
                            addErrorMessage(mainPrice, 'Giá phải từ 1 đến 1,000,000,000 VNĐ');
                        } else {
                            mainPrice.classList.remove('is-invalid');
                            removeErrorMessage(mainPrice);
                        }

                        // Validate description
                        if (!description.value.trim()) {
                            isValid = false;
                            description.classList.add('is-invalid');
                            addErrorMessage(description, 'Vui lòng nhập mô tả sản phẩm');
                        } else {
                            description.classList.remove('is-invalid');
                            removeErrorMessage(description);
                        }

                        // Validate variant quantities
                        quantityInputs.forEach(input => {
                            const value = input.value.trim();
                            if (value === '' || isNaN(value) || Number(value) <= 0) {
                                isValid = false;
                                input.classList.add('is-invalid');
                                addErrorMessage(input, 'Vui lòng nhập số lượng hợp lệ (lớn hơn 0)');
                            } else {
                                input.classList.remove('is-invalid');
                                removeErrorMessage(input);
                            }
                        });

                        // Validate variant prices
                        // priceInputs.forEach(input => {
                        //     const value = input.value.trim();
                        //     if (value === '' || isNaN(value) || Number(value) <= 0 || Number(value) > 10000) {
                        //         isValid = false;
                        //         input.classList.add('is-invalid');
                        //         addErrorMessage(input, 'Số lượng phải từ 1 đến 10,000');
                        //     } else {
                        //         input.classList.remove('is-invalid');
                        //         removeErrorMessage(input);
                        //     }
                        // });

                        if (!isValid) {
                            event.preventDefault();
                        }
                    }


                    function addErrorMessage(element, message) {
                        const existingError = element.nextElementSibling?.classList.contains('text-danger');
                        if (!existingError) {
                            const errorDiv = document.createElement('span');
                            errorDiv.className = 'text-danger';
                            errorDiv.style.fontSize = '12px';
                            errorDiv.textContent = message;
                            element.insertAdjacentElement('afterend', errorDiv);
                        }
                    }

                    function removeErrorMessage(element) {
                        const errorMessage = element.nextElementSibling;
                        if (errorMessage?.classList.contains('text-danger')) {
                            errorMessage.remove();
                        }
                    }
                </script>
@endsection

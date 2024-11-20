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
                                        <div class="mb-3">
                                            <label class="form-label" for="product-title-input">Tên sản phẩm</label>
                                            <input type="text" class="form-control" id="product-title-input"
                                                value="{{ old('name') }}" placeholder="Thêm sản phẩm" name="name">
                                            @if (session('errors') && !session('errors')->has('name'))
                                                <span role="alert">
                                                    <span class="text-danger">{{ session('errors')->first('name') }}</span>
                                                </span>
                                            @else
                                                <span role="alert">
                                                    <span class="text-danger err-name"></span>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label class="form-label" for="product-price-input">Giá sản phẩm</label>
                                            <input type="text" class="form-control" id="product-price-input"
                                                value="{{ old('price') }}" placeholder="Thêm giá sản phẩm" name="price">
                                            @if (session('errors') && !session('errors')->has('price'))
                                                <span role="alert">
                                                    <span class="text-danger">{{ session('errors')->first('price') }}</span>
                                                </span>
                                            @else
                                                <span role="alert">
                                                    <span class="text-danger err-price"></span>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Phần mô tả -->
                                <div class="card">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div>
                                                <label class="form-label" for="meta-description-input">Ảnh sản phẩm</label>
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
                                                                type="file" accept="image/png, image/gif, image/jpeg"
                                                                name="image" onchange="displayMainImage(event)">
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
                                            <input class="form-check-input" type="checkbox" name="is_active"
                                                value="1" id="is_active" {{ old('is_active') ? 'checked' : '' }}>
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
                                                    {{ old('category_id') == $key ? 'selected' : '' }}>{{ $value }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @if (session('errors') && !session('errors')->has('category_id'))
                                            <span role="alert">
                                                <span
                                                    class="text-danger">{{ session('errors')->first('category_id') }}</span>
                                            </span>
                                        @else
                                            <span role="alert">
                                                <span class="text-danger err-category_id"></span>
                                            </span>
                                        @endif
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

                                        @if (session('errors') && !session('errors')->has('brand_id'))
                                            <span role="alert">
                                                <span
                                                    class="text-danger">{{ session('errors')->first('brand_id') }}</span>

                                            </span>
                                        @else
                                            <span role="alert">
                                                <span class="text-danger err-brand_id"></span>
                                            </span>
                                        @endif


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
                                        @if (session('errors') && !session('errors')->has('unit_id'))
                                            <span role="alert">
                                                <span class="text-danger">{{ session('errors')->first('unit_id') }}</span>

                                            </span>
                                        @else
                                            <span role="alert">
                                                <span class="text-danger err-unit_id"></span>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <!-- Loại biến thể -->

                                <!-- Loại sản phẩm -->
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title mb-0">Chọn loại sản phẩm:</h5>
                                        <select class="form-select mt-2" name="product_type" id="product_type"
                                            onchange="toggleVariantOptions()">
                                            <option value="0" selected>Sản phẩm thường</option>
                                            <option value="1">Sản phẩm biến thể</option>
                                        </select>
                                    </div>
                                </div>


                                <!-- Trường nhập số lượng -->
                                <div class="card" id="quantity-section" style="display: none;"> <!-- Ẩn mặc định -->
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
                                                <label class="form-label" for="product-images-input">Bộ sư tập ảnh sản
                                                    phẩm</label>
                                                <!-- Nút để thêm ảnh -->
                                                <button type="button" class="btn btn-primary" id="add-image-button">Thêm
                                                    ảnh</button>
                                            </div>
                                            <div class="mt-3" id="image-inputs">
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
                                            @if (session('errors') && !session('errors')->has('product_images'))
                                                <span role="alert">
                                                    <span
                                                        class="text-danger">{{ session('errors')->first('product_images') }}</span>
                                                </span>
                                            @else
                                                <span role="alert">
                                                    <span class="text-danger err-product_images"></span>
                                                </span>
                                            @endif
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
                                <div id="selected-variants" style="margin-top: 10px;"></div>
                            </div>
                            <div class="mt-3">
                                <button class="btn btn-success text" id="btn-submit">Thêm mới</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const name = document.getElementById('product-title-input');
        const price = document.getElementById('product-price-input');
        const description = document.getElementById('meta-description-input');
        const category_id = document.getElementsByName('category_id')[0];
        const brand_id = document.getElementsByName('brand_id')[0];
        const unit_id = document.getElementsByName('unit_id')[0];
        const is_active = document.getElementById('is_active').checked;
        const product_images = document.getElementsByName('product_images[]');
        const variant_types = document.getElementsByName('variant_types[]');
        const variants = document.getElementsByName('variants[]');

        description.addEventListener('input', () => {
            description.style = "border: 2px solid green;"
        })
        category_id.addEventListener('change', () => {
            if (!category_id.value) {
                document.querySelector('.err-category_id').innerText =
                    'Vui lòng chọn danh mục sản phẩm';
                category_id.style = "border: 2px solid red;"
                checkSubmit = false;
            } else {
                category_id.style = "border: 2px solid green;"
                document.querySelector('.err-category_id').innerText = '';
                checkSubmit = true;
            }
        });
        brand_id.addEventListener('change', () => {
            if (!brand_id.value) {
                document.querySelector('.err-brand_id').innerText =
                    'Vui lòng chọn danh mục sản phẩm';
                brand_id.style = "border: 2px solid red;"
                checkSubmit = false;
            } else {
                brand_id.style = "border: 2px solid green;"
                document.querySelector('.err-brand_id').innerText = '';
                checkSubmit = true;
            }
        });
        unit_id.addEventListener('change', () => {
            if (!unit_id.value) {
                document.querySelector('.err-unit_id').innerText =
                    'Vui lòng chọn danh mục sản phẩm';
                unit_id.style = "border: 2px solid red;"
                checkSubmit = false;
            } else {
                unit_id.style = "border: 2px solid green;"
                document.querySelector('.err-unit_id').innerText = '';
                checkSubmit = true;
            }
        });
        unit_id.addEventListener('change', () => {
            if (!unit_id.value) {
                document.querySelector('.err-unit_id').innerText =
                    'Vui lòng chọn danh mục sản phẩm';
                unit_id.style = "border: 2px solid red;"
                checkSubmit = false;
            } else {
                unit_id.style = "border: 2px solid green;"
                document.querySelector('.err-unit_id').innerText = '';
                checkSubmit = true;
            }
        });
        price.addEventListener('input', () => {
            if (!price.value) {
                document.querySelector('.err-price').innerText = 'Vui lòng nhập giá sản phẩm';
                price.style = "border: 2px solid red;"
                checkSubmit = false;
            } else if (isNaN(price.value)) {
                document.querySelector('.err-price').innerText = 'Giá sản phẩm phải là số';
                price.style = "border: 2px solid red;"
                checkSubmit = false;
            } else if (parseFloat(price.value) < 0) {
                document.querySelector('.err-price').innerText =
                    'Giá sản phẩm không được nhỏ hơn 0';
                price.style = "border: 2px solid red;"
                checkSubmit = false;
            } else {
                price.style = "border: 2px solid green;"
                document.querySelector('.err-price').innerText = '';
                checkSubmit = true;
            }
        })
        name.addEventListener('input', () => {
            if (!name.value) {
                document.querySelector('.err-name').innerText = 'Vui lòng nhập tên sản phẩm';
                name.style = "border: 2px solid red;"
                checkSubmit = false;
            } else if (name.value.length > 255) {
                document.querySelector('.err-name').innerText =
                    'Tên sản phẩm không được vượt quá 255 ký tự';
                name.style = "border: 2px solid red;"
                checkSubmit = false;
            } else {
                document.querySelector('.err-name').innerText = '';
                name.style = "border: 2px solid green;";
                checkSubmit = true;
            }
        })

        document.getElementById("btn-submit").addEventListener('click', (e) => {
            e.preventDefault();
            if (!product_images[0].value) {
                document.querySelector('.err-product_images').innerText =
                    'Vui lòng chọn ít nhất 1 ảnh sản phẩm';
                product_images[0].style = "border: 2px solid red;"
                checkSubmit = false;
            } else {
                product_images[0].style = "border: 2px solid green;"
                document.querySelector('.err-product_images').style.display = 'none';
                checkSubmit = true;
            }

            if (!name.value) {
                document.querySelector('.err-name').innerText = 'Vui lòng nhập tên sản phẩm';
                name.style = "border: 2px solid red;"
                checkSubmit_name = false;
            } else if (name.value.length > 255) {
                document.querySelector('.err-name').innerText = 'Tên sản phẩm không được vượt quá 255 ký tự';
                name.style = "border: 2px solid red;"
                checkSubmit_name = false;
            } else {
                checkSubmit_name = true;
            }
            if (!price.value) {
                document.querySelector('.err-price').innerText = 'Vui lòng nhập giá sản phẩm';
                price.style = "border: 2px solid red;"
                checkSubmit_price = false;
            } else if (isNaN(price.value)) {
                document.querySelector('.err-price').innerText = 'Giá sản phẩm phải là số';
                price.style = "border: 2px solid red;"
                checkSubmit_price = false;
            } else if (parseFloat(price.value) < 0) {
                document.querySelector('.err-price').innerText = 'Giá sản phẩm không được nhỏ hơn 0';
                price.style = "border: 2px solid red;"
                checkSubmit_price = false;
            } else {
                checkSubmit_price = true;
            }
            if (!brand_id.value) {
                document.querySelector('.err-brand_id').innerText = 'Vui lòng chọn thương hiệu';
                brand_id.style = "border: 2px solid red;"
                checkSubmit_brand_id = false;
            } else {
                checkSubmit_brand_id = true;
            }
            if (!category_id.value) {
                document.querySelector('.err-category_id').innerText = 'Vui lòng chọn danh mục sản phẩm';
                category_id.style = "border: 2px solid red;"
                checkSubmit_category_id = false;
            } else {
                checkSubmit_category_id = true;
            }
            if (!unit_id.value) {
                document.querySelector('.err-unit_id').innerText = 'Vui lòng chọn danh mục sản phẩm';
                unit_id.style = "border: 2px solid red;"
                checkSubmit_unit_id = false;
            } else {
                checkSubmit_unit_id = true;
            }
            console.log('====================================');
            console.log(checkSubmit_category_id, checkSubmit_unit_id, checkSubmit_brand_id, checkSubmit_price,
                checkSubmit_name);
            console.log('====================================');
            if (checkSubmit_category_id && checkSubmit_unit_id && checkSubmit_brand_id && checkSubmit_price &&
                checkSubmit_name) {

                document.getElementById('btn-submit').form.submit();
            }
        });

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

        let imageCount = 1; // Biến đếm để tạo ID duy nhất cho mỗi input ảnh

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

        function displayMainImage(event) {
            const output = document.getElementById('product-img-main'); // ID của ảnh sản phẩm
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

        // Gọi hàm để thiết lập trạng thái ban đầu
        document.addEventListener('DOMContentLoaded', toggleVariantOptions);
    </script>
@endsection

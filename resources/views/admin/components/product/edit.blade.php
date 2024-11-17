@extends('admin.layouts.master')

@section('title')
    Sửa sản phẩm
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Sửa sản phẩm</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Sản phẩm</a></li>
                        <li class="breadcrumb-item active">Sửa sản phẩm</li>
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
                    <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label class="form-label">Danh mục</label>
                                            <select class="form-select mt-2" name="category_id">
                                                <option value="">Chọn danh mục</option>
                                                @foreach ($categories as $key => $value)
                                                    <option value="{{ $key }}"
                                                        {{ old('category_id', $product->category_id) == $key ? 'selected' : '' }}>
                                                        {{ $value }}
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
                                        <!-- Tên sản phẩm -->
                                        <div class="mb-3">
                                            <label class="form-label" for="product-title-input">Tên sản phẩm</label>
                                            <input type="text" class="form-control" id="product-title-input"
                                                value="{{ old('name', $product->name) }}" placeholder="Nhập tên sản phẩm"
                                                name="name">
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

                                        <div class="mb-3">
                                            <label class="form-label" for="product-price-input">Giá sản phẩm</label>
                                            <input type="text" class="form-control @error('price') is-invalid @enderror"
                                                id="product-price-input" value="{{ old('price', $product->price) }}"
                                                placeholder="Nhập giá sản phẩm" name="price">
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

                                        <div class="mb-3">
                                            <label class="form-label">Mô tả</label>
                                            <textarea class="form-control" name="description" rows="4">{{ old('description', $product->description) }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="is_active" value="1"
                                                {{ old('is_active', $product->is_active) ? 'checked' : '' }}>
                                            <label class="form-check-label">Hiển thị</label>
                                        </div>

                                        <!-- Thương hiệu -->
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title mb-0">Thương hiệu</h5>
                                                <select class="form-select mt-2" name="brand_id">
                                                    <option value="">Chọn thương hiệu</option>
                                                    @foreach ($brands as $key => $value)
                                                        <option value="{{ $key }}"
                                                            {{ old('brand_id', $product->brand_id) == $key ? 'selected' : '' }}>
                                                            {{ $value }}
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

                                        <!-- Đơn vị tính -->
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title mb-0">Đơn vị tính</h5>
                                                <select class="form-select mt-2" name="unit_id">
                                                    <option value="">Chọn đơn vị tính</option>
                                                    @foreach ($units as $key => $value)
                                                        <option value="{{ $key }}"
                                                            {{ old('unit_id', $product->unit_id) == $key ? 'selected' : '' }}>
                                                            {{ $value }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @if (session('errors') && !session('errors')->has('unit_id'))
                                                    <span role="alert">
                                                        <span
                                                            class="text-danger">{{ session('errors')->first('unit_id') }}</span>

                                                    </span>
                                                @else
                                                    <span role="alert">
                                                        <span class="text-danger err-unit_id"></span>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div id="selected-variants" style="margin-top: 10px;"></div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div id="selected-variants" style="margin-top: 10px;"></div>
                                </div>

                            </div>

                            <!-- Phần ảnh sản phẩm -->
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div class="d-flex justify-content-lg-between">
                                                <label class="form-label" for="product-images-input">Ảnh sản phẩm</label>
                                                <button type="button" class="btn btn-primary" id="add-image-button">
                                                    Thêm ảnh
                                                </button>
                                            </div>
                                            <div class="mt-3" id="image-inputs">
                                                <!-- Hiển thị ảnh hiện có -->
                                                @foreach ($product->galleries as $index => $gallery)
                                                    <div class="position-relative d-inline-block mb-4 me-4">
                                                        <div class="position-absolute top-100 start-100 translate-middle">
                                                            <button type="button" class="btn btn-danger btn-sm"
                                                                onclick="markImageForDeletion({{ $gallery->id }}, this)">
                                                                <i class="ri-delete-bin-line"></i>
                                                            </button>
                                                        </div>
                                                        <div class="avatar-lg">
                                                            <div class="avatar-title bg-light rounded">
                                                                <img src="{{ asset('storage/' . $gallery->url) }}"
                                                                    class="avatar-md h-auto" />
                                                            </div>
                                                        </div>
                                                        <input type="hidden" name="images_to_delete[]" value=""
                                                            class="delete-image-input">
                                                    </div>
                                                @endforeach
                                            </div>
                                            @if ($errors->has('product_images'))
                                                <div class="text-danger mt-1">{{ $errors->first('product_images') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Phần biến thể -->
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5>Biến thể sản phẩm</h5>
                                        @foreach ($product->variations as $variation)
                                            <div class="row mb-3">
                                                <input type="hidden" name="variations[{{ $variation->id }}][id]"
                                                    value="{{ $variation->id }}">
                                                <div class="col-md-3">
                                                    <label class="form-label">Giá trị biến thể</label>
                                                    <input type="text" class="form-control"
                                                        value="{{ $variation->attributeValues->pluck('value')->implode(', ') }}"
                                                        readonly>
                                                </div>

                                                <div class="col-md-3">
                                                    <label class="form-label">SKU</label>
                                                    <input type="text" class="form-control"
                                                        name="variations[{{ $variation->id }}][sku]"
                                                        value="{{ $variation->sku }}" readonly>
                                                </div>

                                                <div class="col-md-3">
                                                    <label class="form-label">Tên biến thể</label>
                                                    <input type="text" class="form-control"
                                                        name="variations[{{ $variation->id }}][name]"
                                                        value="{{ $variation->name }}" readonly>
                                                </div>

                                                <div class="col-md-2">
                                                    <label class="form-label">Giá</label>
                                                    <input type="number" class="form-control"
                                                        name="variations[{{ $variation->id }}][price_export]"
                                                        value="{{ $variation->price_export }}">
                                                </div>

                                                <div class="col-md-1">
                                                    <label class="form-label">Số lượng</label>
                                                    <input type="number" class="form-control"
                                                        name="variations[{{ $variation->id }}][stock]"
                                                        value="{{ $variation->stock }}">
                                                </div>


                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div id="selected-variants" style="margin-top: 10px;"></div>
                            </div>
                            <div class="mt-3">
                                <button class="btn btn-success btn-submit">Cập nhật</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // <+====================VALIDATE====================+>
        const name = document.getElementById('product-title-input');
        const price = document.getElementById('product-price-input');
        const description = document.getElementsByName('description');
        const category_id = document.getElementsByName('category_id')[0];
        const brand_id = document.getElementsByName('brand_id')[0];
        const unit_id = document.getElementsByName('unit_id')[0];
        const product_images = document.getElementsByName('product_images[]');
        const variants = document.getElementsByName('variants[]');
        const listProduct = @json($listProduct);
        const nameOld = name.value
        let checkSubmit_category_id = true
        let checkSubmit_unit_id = true
        let checkSubmit_brand_id = true
        let checkSubmit_price = true
        let checkSubmit_name = true
        let checkSubmit_product_images = true

        name.addEventListener('input', () => {
            let trungName = false;
            listProduct.forEach((product) => {
                if (product == name.value && name.value != nameOld) {
                    return trungName = true;
                }
            });
            if (trungName) {
                document.querySelector('.err-name').innerText = 'Tên sản phẩm đã tồn tại';
                name.style = "border: 2px solid red;"
                checkSubmit_name = false

            } else if (!name.value) {
                document.querySelector('.err-name').innerText = 'Vui lòng nhập tên sản phẩm';
                name.style = "border: 2px solid red;"
                checkSubmit_name = false

            } else if (name.value.length > 255) {
                document.querySelector('.err-name').innerText =
                    'Tên sản phẩm không được vượt quá 255 ký tự';
                name.style = "border: 2px solid red;"
                checkSubmit_name = false

            } else {
                document.querySelector('.err-name').innerText = '';
                name.style = "border: 2px solid green;";
            }
        })
        category_id.addEventListener('change', () => {
            if (!category_id.value) {
                document.querySelector('.err-category_id').innerText =
                    'Vui lòng chọn danh mục sản phẩm';
                category_id.style = "border: 2px solid red;"
                 checkSubmit_category_id = false

            } else {
                category_id.style = "border: 2px solid green;"
                document.querySelector('.err-category_id').innerText = '';

            }
        });
        price.addEventListener('input', () => {
            if (!price.value) {
                document.querySelector('.err-price').innerText = 'Vui lòng nhập giá sản phẩm';
                price.style = "border: 2px solid red;"
                checkSubmit_price = false

            } else if (isNaN(price.value)) {
                document.querySelector('.err-price').innerText = 'Giá sản phẩm phải là số';
                price.style = "border: 2px solid red;"
                checkSubmit_price = false

            } else if (parseFloat(price.value) < 0) {
                document.querySelector('.err-price').innerText =
                    'Giá sản phẩm không được nhỏ hơn 0';
                price.style = "border: 2px solid red;"
                checkSubmit_price = false

            } else {
                price.style = "border: 2px solid green;"
                document.querySelector('.err-price').innerText = '';

            }
        })
        brand_id.addEventListener('change', () => {
            if (!brand_id.value) {
                document.querySelector('.err-brand_id').innerText =
                    'Vui lòng chọn danh mục sản phẩm';
                brand_id.style = "border: 2px solid red;"
                checkSubmit_brand_id = false

            } else {
                brand_id.style = "border: 2px solid green;"
                document.querySelector('.err-brand_id').innerText = '';
            }
        });
        unit_id.addEventListener('change', () => {
            if (!unit_id.value) {
                document.querySelector('.err-unit_id').innerText =
                    'Vui lòng chọn danh mục sản phẩm';
                unit_id.style = "border: 2px solid red;"
                checkSubmit_unit_id = false

            } else {
                unit_id.style = "border: 2px solid green;"
                document.querySelector('.err-unit_id').innerText = '';
            }
        });

        document.getElementById("btn-submit").addEventListener('click', (e) => {
            e.preventDefault();
            if (checkSubmit_category_id && checkSubmit_unit_id && checkSubmit_brand_id && checkSubmit_price &&
                checkSubmit_name ) {
                document.getElementById('btn-submit').form.submit();
            }
        });
        // <+====================VALIDATE====================+>

        let imageCount = 0;

        function displayImage(event, count) {
            event.preventDefault();
            var output = document.getElementById('product-img-' + count);
            if (event.target.files.length > 0) {
                output.src = URL.createObjectURL(event.target.files[0]);
                output.onload = function() {
                    URL.revokeObjectURL(output.src);
                }
            }
        }

        function addImageInput() {
            const inputId = 'product-image-' + imageCount;
            const imgId = 'product-img-' + imageCount;

            const imageContainer = document.createElement('div');
            imageContainer.className = 'position-relative d-inline-block mb-4 me-4';

            const labelWrapper = document.createElement('div');
            labelWrapper.className = 'position-absolute top-100 start-100 translate-middle';

            const label = document.createElement('label');
            label.className = 'mb-0';
            label.setAttribute('for', inputId);
            label.setAttribute('data-bs-toggle', 'tooltip');
            label.setAttribute('data-bs-placement', 'right');
            label.setAttribute('title', 'Chọn nh');

            label.innerHTML = `<div class="avatar-xs">
                <div class="avatar-title bg-light border rounded-circle text-muted cursor-pointer">
                    <i class="ri-image-fill"></i>
                </div>
            </div>`;

            const input = document.createElement('input');
            input.className = 'form-control d-none';
            input.type = 'file';
            input.accept = 'image/png, image/gif, image/jpeg';
            input.name = 'product_images[]';
            input.id = inputId;
            input.setAttribute('onchange', `displayImage(event, ${imageCount})`);

            const previewContainer = document.createElement('div');
            previewContainer.className = 'avatar-lg';
            previewContainer.innerHTML = `<div class="avatar-title bg-light rounded">
                <img src="" id="${imgId}" class="avatar-md h-auto" />
            </div>`;

            labelWrapper.appendChild(label);
            labelWrapper.appendChild(input);
            imageContainer.appendChild(labelWrapper);
            imageContainer.appendChild(previewContainer);

            document.getElementById('image-inputs').appendChild(imageContainer);

            imageCount++;
        }

        function markImageForDeletion(galleryId, button) {
            if (confirm('Bạn có chắc chắn muốn xóa ảnh này?')) {
                const container = button.closest('.position-relative');
                container.classList.add('marked-for-deletion');
                container.style.opacity = '0.5';
                container.querySelector('.delete-image-input').value = galleryId;
            }
        }

        document.getElementById('add-image-button').addEventListener('click', addImageInput);

        // Các hàm JavaScript khác giữ nguyên
    </script>
@endsection

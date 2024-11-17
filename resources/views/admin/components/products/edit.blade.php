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
                    <form action="{{ route('product.update', $product->slug) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-lg-8">

                                <div class="card">
                                    <div class="card-body">
                                        <!-- Tên sản phẩm -->
                                        <div class="mb-3">
                                            <label class="form-label" for="product-title-input">Tên sản phẩm</label>
                                            <input type="text" class="form-control" id="product-title-input"
                                                value="{{ old('name', $product->name) }}" placeholder="Nhập tên sản phẩm"
                                                name="name">
                                            @if ($errors->has('name'))
                                                <div class="text-danger mt-1">{{ $errors->first('name') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label class="form-label" for="product-price-input">Giá sản phẩm</label>
                                            <input type="text" class="form-control @error('price') is-invalid @enderror"
                                                id="product-price-input" value="{{ old('price', $product->price) }}"
                                                placeholder="Nhập giá sản phẩm" name="price">
                                            @error('price')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <label class="form-label" for="product-image-main">Ảnh sản phẩm</label>
                                            <div class="mt-3">
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
                                                            <img src="{{ asset('storage/' . $product->image) }}"
                                                                id="product-img-main" class="avatar-md h-auto" />
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
                                        <div class="card">
                                            <div class="card-body d-flex justify-content-around">
                                                <div class="form-check form-switch form-switch">
                                                    <input class="form-check-input" type="checkbox" name="is_active" value="1"
                                                {{ old('is_active', $product->is_active) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="is_active">Hiển thị</label>
                                                </div>
                                            </div>
                                        </div>
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
                                                    @if ($errors->has('category_id'))
                                                        <div class="text-danger mt-1">{{ $errors->first('category_id') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
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
                                                @if ($errors->has('brand_id'))
                                                    <div class="text-danger mt-1">{{ $errors->first('brand_id') }}</div>
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
                                                @if ($errors->has('unit_id'))
                                                    <div class="text-danger mt-1">{{ $errors->first('unit_id') }}</div>
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
                                                <label class="form-label" for="product-images-input">Bộ sưu tập ảnh sản phẩm</label>
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
                                                <div class="col-md-2">
                                                    <label class="form-label">Mã</label>
                                                    <input type="text" class="form-control"
                                                        name="variations[{{ $variation->id }}][sku]"
                                                        value="{{ $variation->sku }}" disabled>
                                                </div>

                                                <div class="col-md-3">
                                                    <label class="form-label">Tên biến thể</label>
                                                    <input type="text" class="form-control"
                                                        name="variations[{{ $variation->id }}][name]"
                                                        value="{{ $variation->name }}" disabled>
                                                </div>

                                                <div class="col-md-3">
                                                    <label class="form-label">Số lượng tồn kho</label>
                                                    <input type="number" class="form-control @error('variations.' . $variation->id . '.stock') is-invalid @enderror"
                                                        name="variations[{{ $variation->id }}][stock]"
                                                        value="{{ $variation->stock }}"  disabled>
                                                </div>

                                                <div class="col-md-3">
                                                    <label class="form-label">Giá bán lẻ</label>
                                                    <input type="number" class="form-control @error('variations.' . $variation->id . '.price_export') is-invalid @enderror"
                                                        name="variations[{{ $variation->id }}][price_export]"
                                                        value="{{ old('variations.' . $variation->id . '.price_export', $variation->price_export) }}">
                                                    @error('variations.' . $variation->id . '.price_export')
                                                        <div class="text-danger mt-1">{{ $message }}</div>
                                                    @enderror
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
                                <button class="btn btn-success">Cập nhật</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
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

        function displayMainImage(event) {
            const output = document.getElementById('product-img-main'); // ID của ảnh sản phẩm
            if (event.target.files.length > 0) { // Kiểm tra xem có file nào được chọn không
                const file = event.target.files[0];
                const reader = new FileReader();
                reader.onload = function(e) {
                    output.src = e.target.result; // Cập nhật src của ảnh với file mới
                }
                reader.readAsDataURL(file); // Đọc file dưới dạng URL
            }
        }
    </script>
@endsection

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
                        <li class="breadcrumb-item"><a href="{{ route('product.index') }}">Sản phẩm</a></li>
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
                            <a href="{{ route('product.index') }}" class="btn btn-success">Danh sách sản phẩm</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-lg-8">
                                <!-- Danh mục -->
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <h5 class="card-title">Danh mục</h5>
                                        <select class="form-select mt-2" name="category_id" required>
                                            <option value="" selected>Chọn danh mục</option>
                                            @foreach ($categories as $key => $value)
                                                <option value="{{ $key }}" {{ $product->category_id == $key ? 'selected' : '' }}>{{ $value }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Tên sản phẩm -->
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <label class="form-label" for="product-title-input">Tên sản phẩm</label>
                                        <input type="text" class="form-control" id="product-title-input" name="name" value="{{ old('name', $product->name) }}" placeholder="Thêm sản phẩm" required>
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Giá sản phẩm -->
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <label class="form-label" for="product-price-input">Giá sản phẩm</label>
                                        <input type="number" class="form-control" id="product-price-input" name="price" value="{{ old('price', $product->price) }}" placeholder="Thêm giá sản phẩm" required>
                                        @error('price')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Mô tả -->
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <label class="form-label" for="meta-description-input">Mô tả</label>
                                        <textarea class="form-control" id="meta-description-input" name="description" rows="8" placeholder="Nhập nội dung" required>{{ old('description', $product->description) }}</textarea>
                                        @error('description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="card mb-3">
                                    <div class="card-body d-flex justify-content-around">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ $product->is_active ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_active">Hiển thị</label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Thương hiệu -->
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <h5 class="card-title">Chọn thương hiệu</h5>
                                        <select class="form-select mt-2" name="brand_id">
                                            <option value="" selected>Chọn thương hiệu</option>
                                            @foreach ($brands as $key => $value)
                                                <option value="{{ $key }}" {{ $product->brand_id == $key ? 'selected' : '' }}>{{ $value }}</option>
                                            @endforeach
                                        </select>
                                        @error('brand_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Đơn vị -->
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <h5 class="card-title">Chọn đơn vị</h5>
                                        <select class="form-select mt-2" name="unit_id">
                                            <option value="" selected>Chọn đơn vị</option>
                                            @foreach ($units as $key => $value)
                                                <option value="{{ $key }}" {{ $product->unit_id == $key ? 'selected' : '' }}>{{ $value }}</option>
                                            @endforeach
                                        </select>
                                        @error('unit_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Loại biến thể -->
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <h5 class="card-title">Chọn loại biến thể: </h5>
                                        <div class="mb-3 variant-checkbox-group mt-3">
                                            @foreach ($attributesArray as $attribute)
                                                @if(isset($attribute['id']) && isset($attribute['name'])) <!-- Check if keys exist -->
                                                    <label class="variant-checkbox">
                                                        <input type="checkbox" name="variant_types[]" value="{{ $attribute['id'] }}" {{ in_array($attribute['id'], old('variant_types', [])) ? 'checked' : '' }}>
                                                        <span>{{ $attribute['name'] }}</span>
                                                    </label>
                                                @endif
                                            @endforeach
                                        </div>
                                        <button type="button" class="btn btn-success" onclick="getSelectedValues()">Lưu</button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <label class="form-label" for="image-inputs">Ảnh sản phẩm</label>
                                        <div id="image-inputs">
                                            @foreach($product->galleries as $image)
                                                <div class="mb-2">
                                                    <input type="file" class="form-control" name="product_images[]" accept="image/*" onchange="previewImages(this)">
                                                    <img src="{{ asset($image->url) }}" alt="Image Preview" style="max-width: 100%; max-height: 100px; margin-top: 10px;">
                                                </div>
                                            @endforeach
                                            <div class="mb-2">
                                                <input type="file" class="form-control" name="product_images[]" accept="image/*" onchange="previewImages(this)">
                                            </div>
                                            @if ($errors->has('product_images'))
                                                <div class="text-danger">{{ $errors->first('product_images') }}</div>
                                            @endif
                                            @if ($errors->has('product_images.*'))
                                                <div class="text-danger">{{ $errors->first('product_images.*') }}</div>
                                            @endif
                                        </div>
                                        <button type="button" class="btn btn-primary" onclick="addImageInput()">Thêm ảnh</button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div id="selected-variants" style="margin-top: 10px;"></div>
                            </div>

                            <div class="mt-3">
                                <button type="submit" class="btn btn-success">Cập nhật sản phẩm</button>
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

            const selectedVariantsDiv = $('#selected-variants');
            selectedVariantsDiv.empty();
            combinations.forEach(combination => {
                const combinationDiv = $('<div>').addClass('combination-item').text(combination.join(' - '));
                selectedVariantsDiv.append(combinationDiv);
            });
        }

        function generateCombinations(arrays) {
            const result = [];

            function combine(arr, index) {
                if (index === arrays.length) {
                    result.push(arr);
                    return;
                }

                arrays[index].forEach(item => {
                    combine([...arr, item], index + 1);
                });
            }

            combine([], 0);
            return result;
        }

        function addImageInput() {
            const newInput = `<div class="mb-2">
                <input type="file" class="form-control" name="product_images[]" accept="image/*" onchange="previewImages(this)">
            </div>`;
            $('#image-inputs').append(newInput);
        }

        function previewImages(input) {
            const file = input.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const imgPreview = $('<img>').attr('src', e.target.result).css({
                        'max-width': '100%',
                        'max-height': '100px',
                        'margin-top': '10px'
                    });
                    $(input).next('img').remove(); // remove previous image preview
                    $(input).after(imgPreview);
                }
                reader.readAsDataURL(file);
            } 
        }
    </script>
@endsection

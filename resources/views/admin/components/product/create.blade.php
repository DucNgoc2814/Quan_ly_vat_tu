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
                                            @foreach ($attributesArray as $attribute)
                                                <label class="variant-checkbox">
                                                    <input type="checkbox" name="variant_types[]"
                                                        value="{{ $attribute['id'] }}">
                                                    <span>{{ $attribute['name'] }}</span>
                                                </label>
                                            @endforeach
                                        </div>
                                        <button type="button" class="btn btn-primary"
                                            onclick="getSelectedValues()">Lưu</button>
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="mb-3" id="image-inputs">
                                            <label class="form-label" for="product-images-input">Ảnh sản phẩm</label>
                                            <input type="file" class="form-control mb-2" name="product_images[]"
                                                accept="image/*" onchange="previewImages(this)">
                                            @error('images')
                                                <span role="alert">
                                                    <span class="text-danger">{{ $message }}</span>
                                                </span>
                                            @enderror
                                        </div>
                                        <button type="button" class="btn btn-primary" onclick="addImageInput()">Thêm
                                            ảnh</button>
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
            const selectedVariants = [];
            $('input[name="variant_types[]"]:checked').each(function() {
                selectedVariants.push($(this).val());
            });

            if (selectedVariants.length > 2) {
                alert('Bạn chỉ có thể chọn tối đa 2 loại biến thể.');
                $(this).prop('checked', false);
                return;
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



        function addImageInput() {
            // Tạo một div chứa cả input và nút xóa
            const imageDiv = document.createElement('div');
            imageDiv.className = 'input-group mb-2';

            // Tạo một trường input mới
            const newInput = document.createElement('input');
            newInput.type = 'file';
            newInput.className = 'form-control';
            newInput.name = 'product_images[]'; // Tên của trường
            newInput.accept = 'image/*';
            newInput.onchange = function() {
                previewImages(this); // Gọi hàm previewImages khi người dùng chọn ảnh
            };

            // Tạo nút xóa
            const deleteButton = document.createElement('button');
            deleteButton.type = 'button';
            deleteButton.className = 'btn btn-danger';
            deleteButton.innerText = 'Xóa';
            deleteButton.onclick = function() {
                imageDiv.remove(); // Xóa div chứa input và nút xóa
            };

            // Thêm input và nút xóa vào div
            imageDiv.appendChild(newInput);
            imageDiv.appendChild(deleteButton);

            // Thêm div vào div chứa các input ảnh
            document.getElementById('image-inputs').appendChild(imageDiv);
        }



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

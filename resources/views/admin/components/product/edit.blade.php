@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Sửa sản phẩm</h2>

        <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Tên sản phẩm</label>
                <input type="text" name="name" class="form-control" id="name"
                    value="{{ old('name', $product->name) }}">
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Mô tả sản phẩm</label>
                <textarea name="description" class="form-control" id="description">{{ old('description', $product->description) }}</textarea>
                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Giá sản phẩm</label>
                <input type="text" name="price" class="form-control" id="price"
                    value="{{ old('price', $product->price) }}">
                @error('price')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="stock" class="form-label">Số lượng tồn</label>
                <input type="number" name="stock" class="form-control" id="stock"
                    value="{{ old('stock', $product->stock) }}">
                @error('stock')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Upload Images -->
            <div class="mb-3">
                <label for="images" class="form-label">Ảnh sản phẩm</label>
                <input type="file" name="images[]" class="form-control" id="images" multiple>
                @error('images.*')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Biến thể sản phẩm -->
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-0">Biến thể sản phẩm</h5>
                    <div id="variant-container">
                        @foreach ($product->variants as $variant)
                            <div class="variant-row mb-3">
                                <select name="variants[{{ $loop->index }}][attribute_value_ids][]"
                                    class="form-select variant-attribute">
                                    @foreach ($attributesArray as $attribute)
                                        <optgroup label="{{ $attribute->name }}">
                                            @foreach ($attribute->attributeValues as $attributeValue)
                                                <option value="{{ $attributeValue->id }}"
                                                    {{ in_array($attributeValue->id, json_decode($variant->attribute_value_ids, true)) ? 'selected' : '' }}>
                                                    {{ $attributeValue->value }}
                                                </option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                                <input type="text" name="variants[{{ $loop->index }}][price]" class="form-control mt-2"
                                    placeholder="Giá biến thể" value="{{ $variant->price }}">
                                <input type="number" name="variants[{{ $loop->index }}][stock]" class="form-control mt-2"
                                    placeholder="Số lượng biến thể" value="{{ $variant->stock }}">
                                <button type="button" class="btn btn-danger remove-variant">Xóa</button>
                            </div>
                        @endforeach
                    </div>
                    <button type="button" class="btn btn-success add-variant">Thêm biến thể</button>
                </div>
            </div>

            <!-- Nút cập nhật sản phẩm -->
            <div class="row mt-4">
                <div class="col-lg-12">
                    <button type="submit" class="btn btn-primary">Cập nhật sản phẩm</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const variantContainer = document.getElementById('variant-container');

            // Thêm biến thể
            document.querySelector('.add-variant').addEventListener('click', function() {
                const variantRow = document.createElement('div');
                variantRow.className = 'variant-row mb-3';
                variantRow.innerHTML = `
                <select name="variants[][attribute_value_ids][]" class="form-select variant-attribute">
                    @foreach ($attributesArray as $attribute)
                        <optgroup label="{{ $attribute->name }}">
                            @foreach ($attribute->attributeValues as $attributeValue)
                                <option value="{{ $attributeValue->id }}">{{ $attributeValue->value }}</option>
                            @endforeach
                        </optgroup>
                    @endforeach
                </select>
                <input type="text" name="variants[][price]" class="form-control mt-2" placeholder="Giá biến thể">
                <input type="number" name="variants[][stock]" class="form-control mt-2" placeholder="Số lượng biến thể">
                <button type="button" class="btn btn-danger remove-variant">Xóa</button>
            `;
                variantContainer.appendChild(variantRow);
            });

            // Xóa biến thể
            variantContainer.addEventListener('click', function(e) {
                if (e.target.classList.contains('remove-variant')) {
                    e.target.parentElement.remove();
                }
            });
        });
    </script>
@endsection

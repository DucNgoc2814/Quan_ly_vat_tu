@extends('admin.layouts.master')

@section('title')
    Thêm mới loại biến thể
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Thêm mới loại biến thể</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('valueVariations.index') }}">Loại biến thể</a></li>
                        <li class="breadcrumb-item active">Thêm mới</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="card-header border-0 mb-4">
        <div class="row g-4">
            <div class="col-sm-auto">
                <a href="{{ route('valueVariations.index') }}" class="btn btn-success" id="addproduct-btn"><i
                    class="ri-arrow-left-line align-bottom me-1"></i>Quay lại</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Thông tin loại biến thể</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('valueVariations.store') }}" method="POST">
                        @csrf
                        <div class="row mb-4">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <div class="card border" style="height: 176px;">
                                        <div class="card-header bg-light">
                                            <h5 class="card-title mb-0">Tên loại biến thể</h5>
                                        </div>
                                        <div class="card-body">
                                            <input type="text" name="name" class="form-control"
                                                placeholder="VD: Màu sắc, Kích thước..." value="{{ old('name') }}">
                                            @error('name')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-8">
                                <div class="card border">
                                    <div class="card-header bg-light">
                                        <h5 class="card-title mb-0">Danh sách giá trị</h5>
                                    </div>
                                    <div class="card-body">
                                        <div id="value-container">
                                            @if (old('values'))
                                                @foreach (old('values') as $key => $value)
                                                    <div class="row mb-3 value-row">
                                                        <div class="col-10">
                                                            <input type="text" name="values[]" class="form-control"
                                                                placeholder="Nhập giá trị biến thể"
                                                                value="{{ $value }}">
                                                            @error('values.' . $key)
                                                                <p class="text-danger">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                        <div class="col-2">
                                                            <button type="button" class="btn btn-danger remove-value"
                                                                {{ count(old('values')) <= 1 ? 'style=display:none' : '' }}>
                                                                <i class="ri-delete-bin-line"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                <div class="row mb-3 value-row">
                                                    <div class="col-10">
                                                        <input type="text" name="values[]" class="form-control"
                                                            placeholder="Nhập giá trị biến thể">
                                                    </div>
                                                    <div class="col-2">
                                                        <button type="button" class="btn btn-danger remove-value"
                                                            style="display: none;">
                                                            <i class="ri-delete-bin-line"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="text-center mt-3">
                                            <button type="button" class="btn btn-soft-info" id="add-value">
                                                <i class="ri-add-circle-line align-middle"></i> Thêm giá trị mới
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-end mt-4">
                            <a href="{{ route('valueVariations.index') }}" class="btn btn-light me-2">Quay lại</a>
                            <button type="submit" class="btn btn-success">Lưu loại biến thể</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            // Function to toggle the visibility of the remove button based on the number of value rows
            function toggleRemoveButtons() {
                let valueRows = $('.value-row');
                if (valueRows.length <= 1) {
                    $('.remove-value').hide();
                } else {
                    $('.remove-value').show();
                }
            }

            // Add new value row when the add button is clicked
            $('#add-value').on('click', function() {
                let newRow = `
                    <div class="row mb-3 value-row">
                        <div class="col-10">
                            <input type="text" name="values[]" class="form-control" placeholder="Nhập giá trị biến thể">
                        </div>
                        <div class="col-2">
                            <button type="button" class="btn btn-danger remove-value">
                                <i class="ri-delete-bin-line"></i>
                            </button>
                        </div>
                    </div>
                `;
                $('#value-container').append(newRow);
                toggleRemoveButtons(); // Reapply logic to show/hide remove buttons
            });

            // Remove the value row when the remove button is clicked
            $(document).on('click', '.remove-value', function() {
                $(this).closest('.value-row').remove();
                toggleRemoveButtons(); // Reapply logic to show/hide remove buttons
            });
        });
    </script>
@endsection

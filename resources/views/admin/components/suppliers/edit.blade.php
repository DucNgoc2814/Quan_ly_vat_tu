@extends('admin.layouts.master')

@section('title')
    Sửa thông tin nhà cung cấp
@endsection

@section('content')
    <div class="container-fluid">
        <!-- Breadcrumb -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">Sửa thông tin nhà cung cấp</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Nhà cung cấp</a></li>
                            <li class="breadcrumb-item active">Sửa thông tin</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <form method="POST" action="{{ route('suppliers.update', $supplier->id) }}">
            @csrf
            @method('PUT')
            <div class="row">
                <!-- Thông tin cơ bản -->
                <div class="col-lg-8">
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-transparent py-3">
                            <h5 class="card-title mb-0">Thông tin cơ bản</h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-12 mb-1">
                                    <label class="form-label fw-semibold">Tên nhà cung cấp</label>
                                    <input type="text" class="form-control" name="name" value="{{ $supplier->name }}">
                                    @error('name')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-12 mb-1">
                                    <label class="form-label fw-semibold">Email</label>
                                    <input type="text" class="form-control" name="email"
                                        value="{{ $supplier->email }}">
                                    @error('email')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-12 mb-1">
                                    <label class="form-label fw-semibold">Số điện thoại</label>
                                    <input type="text" class="form-control" name="number_phone"
                                        value="{{ $supplier->number_phone }}">
                                    @error('number_phone')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-12 mb-1">
                                    <label class="form-label fw-semibold">Địa chỉ</label>
                                    <input type="text" class="form-control" name="address"
                                        value="{{ $supplier->address }}">
                                    @error('address')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header bg-transparent py-2 d-flex justify-content-between align-items-center">
                            <h6 class="mb-0">Danh sách sản phẩm cung cấp</h6>
                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                data-bs-target="#addVariationModal">
                                <i class="ri-add-line"></i> Thêm
                            </button>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <tbody>
                                        @foreach ($supplierVariations as $variation)
                                            <tr>
                                                <td>{{ $variation->name }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        onclick="removeVariation({{ $variation->id }})">
                                                        <i class="ri-delete-bin-line"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-end px-3 py-2">
                                {{ $supplier->variations()->paginate(10)->links() }}
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="ri-save-line align-middle me-1"></i>
                                Cập nhật thông tin
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <!-- Modal thêm biến thể -->
        <div class="modal fade" id="addVariationModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Thêm sản phẩm cung cấp</h5>
                        <button type="button" class="btn btn-primary ms-3" onclick="addSelectedVariations()">Thêm</button>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Add search input -->
                        <div class="mb-3">
                            <input type="text" id="searchModalVariation" class="form-control"
                                placeholder="Tìm kiếm sản phẩm...">
                        </div>
                        <!-- Make table scrollable -->
                        <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                            <table class="table table-bordered">
                                <thead style="position: sticky; top: 0; background: white; z-index: 1;">
                                    <tr>
                                        <th style="width: 50px;">
                                            <input type="checkbox" class="form-check-input" id="select-all">
                                        </th>
                                        <th>Tên biến thể</th>
                                    </tr>
                                </thead>
                                <tbody id="modalVariationList">
                                    @foreach ($variations as $variation)
                                        @if (!$supplier->variations->contains($variation->id))
                                            <tr>
                                                <td>
                                                    <input type="checkbox" name="variations[]" value="{{ $variation->id }}"
                                                        class="form-check-input variation-checkbox">
                                                </td>
                                                <td>{{ $variation->name }}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            // Search functionality
            $('#searchModalVariation').on('keyup', function() {
                let searchText = $(this).val().toLowerCase();
                $('#modalVariationList tr').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(searchText) > -1)
                });
            });

            // Select all checkbox
            $('#select-all').change(function() {
                $('.variation-checkbox:visible').prop('checked', $(this).prop('checked'));
            });
        });
        // Xử lý check all
        document.getElementById('select-all').addEventListener('change', function() {
            const checkboxes = document.getElementsByClassName('variation-checkbox');
            for (let checkbox of checkboxes) {
                checkbox.checked = this.checked;
            }
        });

        // Xử lý thêm biến thể
        function addSelectedVariations() {
            const checkboxes = document.querySelectorAll('input[name="variations[]"]:checked');
            if (checkboxes.length === 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi!',
                    text: 'Vui lòng chọn ít nhất một biến thể!'
                });
                return;
            }

            // Tạo FormData từ các checkbox đã chọn
            const formData = new FormData();
            checkboxes.forEach(checkbox => {
                formData.append('variations[]', checkbox.value);
            });

            fetch('{{ route('suppliers.addVariations', $supplier->id) }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    credentials: 'same-origin'
                })
                .then(response => {
                    if (!response.ok) {
                        if (response.status === 419) {
                            throw new Error('CSRF token mismatch. Vui lòng tải lại trang.');
                        }
                        return response.text().then(text => {
                            throw new Error(text);
                        });
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        checkboxes.forEach(checkbox => {
                            checkbox.checked = false;
                        });

                        Swal.fire({
                            icon: 'success',
                            title: 'Thành công!',
                            text: data.message,
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        throw new Error(data.message || 'Có lỗi xảy ra');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Lỗi!',
                        text: error.message || 'Có lỗi xảy ra khi thêm biến thể!'
                    });
                });
        }

        // Xóa biến thể
        function removeVariation(variationId) {
            Swal.fire({
                title: 'Bạn có chắc chắn?',
                text: "Bạn sẽ không thể hoàn tác lại điều này!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Đồng ý xóa!',
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/suppliers/{{ $supplier->id }}/variations/${variationId}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json',
                                'Accept': 'application/json'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // Xóa dòng trong bảng
                                const row = document.querySelector(`tr[data-variation-id="${variationId}"]`);
                                if (row) {
                                    row.remove();
                                }

                                // Hiển thị thông báo thành công
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Thành công!',
                                    text: data.message,
                                    showConfirmButton: false,
                                    timer: 1000
                                }).then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Lỗi!',
                                    text: data.message
                                });
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Lỗi!',
                                text: 'Có lỗi xảy ra khi xóa biến thể!'
                            });
                        });
                }
            });
        }
    </script>
@endsection

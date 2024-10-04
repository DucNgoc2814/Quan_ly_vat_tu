@extends('admin.layouts.master')

@section('title')
    Danh sách người lao động
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Danh sách người lao động</h4>
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
                                <a href="{{ route('employees.create') }}" class="btn btn-success" id="addproduct-btn"><i
                                        class="ri-add-line align-bottom me-1"></i>Thêm người lao động</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table id="myTable"
                        class="text-center table table-bordered dt-responsive nowrap table-striped align-middle"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th data-ordering="false">Chức vụ</th>
                                <th data-ordering="false">Họ Tên</th>
                                <th data-ordering="false">Ảnh</th>
                                <th data-ordering="false">CCCD</th>
                                <th data-ordering="false">Số điện thoại</th>
                                <th data-ordering="false">Ngày sinh</th>
                                <th data-ordering="false">Mô tả</th>
                                <th data-ordering="false">Hoạt động</th>
                                <th data-ordering="false">Thao tác</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $item->roleEmployee->name }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>
                                        <img width="150px" height="150px"
                                             src="{{ $item->image ? \Storage::url($item->image) : asset('themes/admin/assets/pro/default-user.jpg') }}"
                                             alt="">
                                    </td>
                                    
                                    <td>{{ $item->cccd }}</td>
                                    <td>{{ $item->number_phone }}</td>
                                    <td>{{ $item->date }}</td>
                                    <td>{{ $item->description }}</td>
                                    <td>
                                        <div class="col-lg-6 form-check form-switch form-switch ms-3 mt-3">
                                            <input class="form-check-input" type="checkbox" name="is_active" id="is_active"
                                                value="1" {{ $item->is_active == 1 ? 'checked' : '' }}
                                                onclick="updateStatus(this, '{{ $item->id }}')">
                                        </div>
                                    </td>
                                    <td style="text-align: center">
                                        <div class="dropdown d-inline-block">
                                            <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="ri-more-fill align-middle"></i>
                                            </button>

                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li><a href="{{ route('employees.edit', ['id' => $item->id]) }}"
                                                        class="dropdown-item edit-item-btn"><i
                                                            class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                        Sửa thông tin</a></li>
                                                <li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection





@section('scripts')

    <script>
        function updateStatus(checkbox, id) {
            // Get current status
            const isActive = checkbox.checked ? 1 : 0;

            // Send AJAX request to update status
            fetch('/update-employee-status', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        id: id,
                        is_active: isActive
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        console.log('Update successful!', data.is_active);
                    } else {
                        console.log('An error occurred!');
                        checkbox.checked = !checkbox.checked;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    checkbox.checked = !checkbox.checked;
                });
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.remove-item-btn').forEach(function(element) {
                element.addEventListener('click', function(event) {
                    event.preventDefault();
                    var formId = this.getAttribute('data-form-id');
                    var form = document.getElementById(formId);

                    if (confirm('Bạn có muốn ẩn nó không !')) {
                        form.submit();
                    }
                });

            });
        });
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var successAlert = document.getElementById('success-alert');
            if (successAlert) {
                setTimeout(function() {
                    successAlert.style.opacity = '0';
                    setTimeout(function() {
                        successAlert.style.display = 'none';
                    }, 600);
                }, 5000);
            }
        });
    </script>
@endsection

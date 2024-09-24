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
        <div>
            @if (session('success'))
                <div id="success-alert" class="alert alert-success">{{ session('success') }}</div>
            @endif
        </div>

    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card text-center" id="tasksList">
                <div class="card-header border-0">


                    <div class="row g-4">
                        <div class="col-sm-auto">
                            <div>
                                <a href="{{ url('quan-ly-nhan-vien.them-moi-nhan-vien') }}" class="btn btn-success"
                                    id="addproduct-btn"><i class="ri-add-line align-bottom me-1"></i>Thêm mới người lao động
                                </a>
                            </div>
                        </div>
                        
                    </div>
                </div>

                <!--end card-body-->
                <div class="card-body">
                    <div class="table-responsive table-card mb-4 ">
                        <table class="table table-nowrap mb-0 text-center" id="myTable">
                            <thead class="table-light text-muted ">
                                <tr>
                                    <th>Chức vụ</th>
                                    <th>Họ Tên</th>
                                    {{-- <th>Email</th> --}}
                                    <th>Ảnh</th>
                                    <th>CCCD</th>
                                    <th>Số điện thoại</th>
                                    <th>Ngày sinh</th>
                                    <th>Mô tả</th>
                                    <th>Hoạt động</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody class="list form-check-all text-muted">
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $item->roleEmployee->name }}</td>
                                        <td>{{ $item->name }}</td>
                                        {{-- <td>{{ $item->email }}</td> --}}
                                        <td>
                                            <img class="br-4"
                                                src="{{ $item->image ? url('storage/' . $item->image) : asset('themes/admin/assets/pro/default-user.jpg') }}"
                                                width="100px" alt="User">
                                        </td>
                                        <td>{{ $item->cccd }}</td>
                                        <td>{{ $item->number_phone }}</td>
                                        <td>{{ $item->date }}</td>
                                        <td>{{ $item->description }}</td>
                                        <td>
                                            <div class="col-lg-6 form-check form-switch form-switch ms-3 mt-3">
                                                <input class="form-check-input" type="checkbox" name="is_active"
                                                    id="is_active" value="1"
                                                    {{ $item->is_active == 1 ? 'checked' : '' }}
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
                                                    <li><a href="{{ route('quan-ly-nhan-vien.sua-thong-tin-nhan-vien', ['id' => $item->id]) }}"
                                                            class="dropdown-item edit-item-btn"><i
                                                                class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                            Sửa thông tin</a></li>
                                                    <li>

                                                        {{-- <li>
                                                        <a class="dropdown-item remove-item-btn"
                                                            data-form-id="delete-form-{{ $item->id }}">
                                                            <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>

                                                            Ẩn nhà cung cấp
                                                        </a>
                                                    </li> --}}

                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!--end table-->
                        <div class="noresult" style="display: none">
                            <div class="text-center">
                                <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop"
                                    colors="primary:#121331,secondary:#08a88a" style="width:75px;height:75px"></lord-icon>
                                <h5 class="mt-2">Sorry! No Result Found</h5>
                                <p class="text-muted mb-0">We've searched more than 200k+ tasks We did not find any tasks
                                    for you search.</p>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mt-2">
                        <div class="pagination-wrap hstack gap-2">

                           
                        </div>
                    </div>

                </div>
                <!--end card-body-->
            </div>
            <!--end card-->
        </div>
        <!--end col-->
    </div>
@endsection


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
                    // Handle response
                    if (data.success) {
                        console.log('Update successful!', data.is_active);
                    } else {
                        console.log('An error occurred!');
                        // Reset checkbox to previous state if needed
                        checkbox.checked = !checkbox.checked;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    // Reset checkbox to previous state on error
                    checkbox.checked = !checkbox.checked;
                });
        }
    </script>
@endsection

@extends('admin.layouts.master')


@section('title')
    Phân quyền
@endsection
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Phân quyền</h4>
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
                                <a class="btn btn-success" id="addpermission-btn"><i
                                        class="ri-add-line align-bottom me-1"></i>Thêm chức vụ</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table id="myTable" class="table table-bordered dt-responsive nowrap table-striped align-middle"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th data-ordering="false">Phân quyền</th>
                               @foreach ($role_employees as $role_employee)
                                <th>{{ $role_employee->name }}</th>
                               @endforeach
                            </tr>
                        </thead>
                        <tbody>
                          @foreach ($permissions as $permission)
                          <tr>
                            <td>{{ $permission->name }}</td>
                            @foreach($role_employees as $role_employee)
                            <td>
                                <div class="form-check form-switch">
                                    <input  class="form-check-input" type="checkbox"
                                           onchange="checkTest({{ $role_employee->id }}, {{ $permission->id }}, '{{ $role_employee->name }}', '{{ $permission->name }}')"
                                           {{ $permission_role_employees->where('permission_id', $permission->id)->where('role_employee_id', $role_employee->id)->count() > 0 ? 'checked' : '' }}
                                           onchange="togglePermission({{ $permission->id }}, {{ $role_employee->id }}, this)"
                                           {{ $role_employee->id == 1 ? 'disabled' : '' }}>
                                </div>
                            </td>
                            @endforeach
                          </tr>
                          @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        function checkTest(role, permission, roleName, permissionName) {
            let checkbox = event.target;
            let originalState = checkbox.checked;
            let message = originalState ?
                `Bạn có muốn thêm quyền ${permissionName} cho ${roleName} ?` :
                `Bạn có muốn xóa quyền ${permissionName} của ${roleName} ?`;
            Swal.fire({
                title: 'Xác nhận',
                text: message,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Đồng ý',
                cancelButtonText: 'Hủy',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/permissions/toggle',
                        type: 'POST',
                        data: {
                            role_id: role,
                            permission_id: permission,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function() {
                            Swal.fire({
                                title: 'Thành công!',
                                text: 'Đã cập nhật quyền thành công',
                                icon: 'success'
                            });
                        },
                        error: function() {
                            Swal.fire({
                                title: 'Lỗi!',
                                text: 'Đã xảy ra lỗi khi cập nhật quyền',
                                icon: 'error'
                            });
                            checkbox.checked = !originalState;
                        }
                    });
                } else {
                    checkbox.checked = !originalState;
                }
            });
        }
    </script>
@endsection

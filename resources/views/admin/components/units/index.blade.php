@extends('admin.layouts.master')

@section('title')
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Danh sách vận chuyển</h4>

                <div class="col-sm-auto">
                    <div>
                        <a href="{{ route('units.create') }}" class="btn btn-success" id="addproduct-btn"><i
                                class="ri-add-line align-bottom me-1"></i>Thêm đơn vị </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <table id="myTable" class="table table-bordered dt-responsive nowrap table-striped align-middle"
                        style="width:100%">
                       
                        <thead>
                            <tr>
                                <th data-ordering="false">ID</th>
                                <th data-ordering="false">Tên đơn vị</th>
                                <th data-ordering="false">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($unit as $item)
                                <tr>
                                    <td>
                                        {{ $item->id }}
                                    </td>

                                    <td>
                                        {{ $item->name }}
                                   </td>
                                   <td>
                                        <div class="dropdown d-inline-block">
                                            <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="ri-more-fill align-middle"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                
                                                <li><a href="{{ route('units.edit', $item->id) }}"
                                                        class="dropdown-item edit-item-btn"><i
                                                            class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                        Edit</a></li>
                                                <li>

                                                    <form action="{{ route('units.destroy', $item->id) }}" method="post">
                                                        @method('DELETE')
                                                        @csrf

                                                        <button class="dropdown-item remove-list" type="submit"
                                                            onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">
                                                            <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                            Xóa
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>

                    </table>
                </div>
            </div>
        </div><!--end col-->
    </div>
@endsection

@section('scripts-list')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!--datatable js-->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="assets/js/pages/datatables.init.js"></script>
@endsection
@section('styles-list')
    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
@endsection

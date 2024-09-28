@extends('admin.layouts.master')

@section('title')
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Cập nhật slider</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                        <li class="breadcrumb-item active">Cập nhật slider</li>
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

                        <div class="col-sm">
                            <div class="d-flex justify-content-sm-end">
                                <form class="search-box ms-2" method="GET" action="">
                                    <input type="text" class="form-control" id="searchProductList" name="search"
                                        placeholder="Tìm sliders...">
                                    <i class="ri-search-line search-icon"></i>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('category.update', $categoryr->id) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="row">
                            <div class="col-lg-8">
                                <label class="form-label">Loại xe vận chuyển</label>
                                <select name="categoryr_type_id" id="categoryr_type_id"
                                    class="form-control @error('categoryr_type_id') is-invalid @enderror">
                                    <option selected>--Chọn loại xe--</option>
                                    @foreach ($loai_xe as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('categoryr_type_id', $categoryr->categoryr_type_id) == $item->id ? 'selected' : '' }}>
                                            {{ $item->name }}
                                        </option>
                                    @endforeach

                                </select>
                                @error('categoryr_type_id')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-lg-8">
                                <label class="form-label">Biển số</label>
                                <input type="text" name="license_plate" placeholder="Nhập biển số xe"
                                    class="form-control @error('license_plate') is-invalid @enderror"
                                    value="{{ old('license_plate', $categoryr->license_plate) }}">
                                @error('license_plate')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-lg-8">
                                <label for="status" class="form-label">Trạng thái</label>
                                <select name="is_active" id="is_active"
                                    class="form-control @error('is_active') is-invalid @enderror">
                                    <option value="">--Chọn trạng thái--</option>
                                    <option class="text-success" value="1"
                                        {{ old('is_active', $categoryr->is_active) == 1 ? 'selected' : '' }}>
                                        Đang vận chuyển
                                    </option>
                                    <option class="text-danger" value="0"
                                        {{ old('is_active', $categoryr->is_active) == 0 ? 'selected' : '' }}>
                                        Chờ xác nhận
                                    </option>



                                </select>
                                {{-- <select name="is_active" id="status" class="form-control">
                                   <option value="1" {{old('is_active', $categoryr->is_active) == 1 ? 'selected' : '' }}>Đang vận chuyển</option>
                                   <option value="0" {{old('is_active', $categoryr->is_active) == 0 ? 'selected' : '' }}>Chờ xác nhận</option>

                              </select> --}}


                                {{-- <div class="mb-3 ms-1">
                                    <input type="radio" name="is_active" value="1" class="me-1" id="firstRadio"
                                        {{ (old('is_active') ?? $cargo_car->is_active) == 1 ? 'checkted' : '' }}>
                                    <label for="firstRadio" class="form-check-label text-success">Đang vận chuyển</label>

                                    <input class="me-1" type="radio" name="is_active" value="0" id="secondRadio"
                                        {{ (old('is_active') ?? $cargo_car->is_active) == 0 ? 'checkted' : '' }}>
                                    <label for="secondRadio" class="form-check-label text-danger">Chờ Xác Nhân</label>
                                </div> --}}

                            </div>

                            <div class="mt-3">
                                <button class = "btn btn-success text ">Submit</button>
                            </div>
                    </form>
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
@section('js')
    <script>
        function showImage(event) {
            const img_slider = document.getElementById('img_slider');
            const file = event.target.files[0];
            const reader = new FileReader();
            reader.onload = function() {
                img_slider.src = reader.result;
                img_slider.style.display = 'block';
            }
            if (file) {
                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection

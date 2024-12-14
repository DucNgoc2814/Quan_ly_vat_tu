@extends('admin.layouts.master')

@section('title')
    Thêm đơn nhập
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Thêm đơn nhập hàng</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('importOrder.index') }}">Đơn nhập hàng</a></li>
                        <li class="breadcrumb-item active">Thêm đơn nhập hàng</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <div class="card-header border-0 mb-4">
        <div class="row g-4">
            <div class="col-sm-auto">
                <a href="{{ route('importOrder.index') }}" class="btn btn-success" id="addproduct-btn"><i
                        class="ri-arrow-left-line align-bottom me-1"></i>Quay lại</a>
            </div>
        </div>
    </div>
    <form method="POST" action="{{ route('importOrder.store') }}" id="importOrderForm">
        @csrf
        <div class="card">
            <div class="card-body">
                <!-- Nhà cung cấp -->
                <div class="mb-3">
                    <label class="form-label">Tên nhà cung cấp</label>
                    <select class="form-select" id="supplier_id" name="supplier_id" required>
                        <option value="">Chọn nhà cung cấp</option>
                        @foreach ($suppliers as $supplier)
                            <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Nút chọn sản phẩm -->
                <button type="button" class="btn btn-primary mt-3" onclick="openProductModal()">
                    Chọn sản phẩm nhập
                </button>
                <!-- Bảng hiển thị sản phẩm đã chọn -->
                <div class="table-responsive mt-3">
                    <table class="table" id="selectedProductsTable">
                        <thead>
                            <tr>
                                <th>Mã nhập hàng</th>
                                <th>Tên sản phẩm</th>
                                <th>Giá nhập</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Sản phẩm đã chọn sẽ được thêm vào đây -->
                        </tbody>
                    </table>
                </div>
                <div class="mb-3 d-flex justify-content-between align-items-center">
                    <label class="form-label mb-0">Tổng tiền</label>
                    <div class="text-end">
                        <span id="total_amount_display" class="fs-5 fw-bold">0</span>
                        <input type="hidden" name="total_amount" id="total_amount">
                    </div>
                </div>
                <div class="mt-3">
                    <button type="submit" class="btn btn-success">Thêm đơn nhập</button>
                </div>
            </div>
        </div>
    </form>

    <!-- Modal chọn sản phẩm -->
    <div class="modal fade" id="productModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Thêm sản phẩm</h5>
                    <div class="d-flex align-items-center gap-2">
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <input type="text" class="form-control w-50" id="searchInput" placeholder="Tìm kiếm sản phẩm...">
                        <input type="file" id="excelFile" accept=".xlsx, .xls" style="display: none;"
                            onchange="importExcel()">
                        <button class="btn btn-success"
                            onclick="document.getElementById('excelFile').click(); return false;">
                            <i class="ri-download-2-fill align-middle"></i>Nhập Excel
                        </button>
                        <button type="button" class="btn btn-primary" onclick="addSelectedProducts()">
                            Thêm đã chọn
                        </button>
                    </div>
                    <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                        <table class="table">
                            <thead style="position: sticky; top: 0; background: white; z-index: 1;">
                                <tr>
                                    <th>
                                        <input type="checkbox" id="selectAll" class="form-check-input">
                                    </th>
                                    <th>Mã nhập</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Giá nhập</th>
                                    <th>Số lượng</th>
                                </tr>
                            </thead>
                            <tbody id="productList">
                                <!-- Sản phẩm sẽ được render ở đây -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        let productModal;

        document.addEventListener('DOMContentLoaded', function() {
            productModal = new bootstrap.Modal(document.getElementById('productModal'));

            document.getElementById('supplier_id').addEventListener('change', function() {
                const supplierId = this.value;
                if (supplierId) {
                    loadVariations(supplierId);
                }
            });
        });

        function loadVariations(supplierId) {
            fetch(`/products-by-supplier/${supplierId}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(variations => {
                    console.log('Received variations:', variations);
                    renderProducts(variations);
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Có lỗi xảy ra khi tải danh sách sản phẩm: ' + error.message);
                });
        }

        function openProductModal() {
            const supplierId = document.getElementById('supplier_id').value;
            if (!supplierId) {
                alert('Vui lòng chọn nhà cung cấp trước');
                return;
            }
            productModal.show();
        }

        function renderProducts(products) {
            const productList = document.getElementById('productList');
            productList.innerHTML = '';

            products.forEach(product => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>
                        <input type="checkbox" class="form-check-input product-checkbox">
                    </td>
                    <td>${product.sku}</td>
                    <td>${product.name}</td>
                    <td>
                        <input type="number" class="form-control form-control-sm"
                               placeholder="Nhập giá" id="price_${product.id}">
                    </td>
                    <td>
                        <input type="number" class="form-control form-control-sm"
                               placeholder="Nhập số lượng" id="quantity_${product.id}">
                    </td>
                `;
                productList.appendChild(row);
            });

            // Reset checkbox "Chọn tất cả"
            const selectAllCheckbox = document.getElementById('selectAll');
            if (selectAllCheckbox) {
                selectAllCheckbox.checked = false;
            }
        }

        function addSelectedProducts() {
            const rows = document.querySelectorAll('#productList tr');
            let hasError = false;

            const selectedProductsTable = document.querySelector('#selectedProductsTable tbody');
            selectedProductsTable.innerHTML = '';

            rows.forEach(row => {
                const checkbox = row.querySelector('input[type="checkbox"]');
                if (checkbox && checkbox.checked) {
                    const sku = row.cells[1].textContent;
                    const productName = row.cells[2].textContent;
                    const priceInput = row.querySelector('input[placeholder="Nhập giá"]');
                    const quantityInput = row.querySelector('input[placeholder="Nhập số lượng"]');

                    if (!priceInput?.value || !quantityInput?.value) {
                        hasError = true;
                        return;
                    }

                    const price = parseFloat(priceInput.value.replace(/[.,]/g, ''));
                    const quantity = parseInt(quantityInput.value);
                    const lineTotal = price * quantity;

                    const newRow = document.createElement('tr');
                    newRow.innerHTML = `
                        <td>${sku}</td>
                        <td>${productName}</td>
                        <td>${price.toLocaleString('vi-VN')}</td>
                        <td>${quantity}</td>
                        <td>${lineTotal.toLocaleString('vi-VN')}</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-danger" onclick="removeProduct(this)">
                                Xóa
                            </button>
                            <input type="hidden" name="variation_id[]" value="${priceInput.id.split('_')[1]}">
                            <input type="hidden" name="product_price[]" value="${price}">
                            <input type="hidden" name="product_quantity[]" value="${quantity}">
                        </td>
                    `;
                    selectedProductsTable.appendChild(newRow);
                }
            });

            if (hasError) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Lỗi',
                    text: 'Vui lòng nhập đầy đủ giá và số lượng cho các sản phẩm đã chọn',
                    timer: 2000,
                    showConfirmButton: false
                });
                return;
            }

            calculateTotal();
            productModal.hide();
        }

        function calculateTotal() {
            let total = 0;
            const rows = document.querySelectorAll('#selectedProductsTable tbody tr');

            rows.forEach(row => {
                const price = parseFloat(row.querySelector('input[name="product_price[]"]').value) || 0;
                const quantity = parseInt(row.querySelector('input[name="product_quantity[]"]').value) || 0;
                total += price * quantity;
            });

            document.getElementById('total_amount').value = total.toLocaleString('vi-VN');
            document.getElementById('total_amount_display').textContent = total.toLocaleString('vi-VN');
        }

        function removeProduct(button) {
            button.closest('tr').remove();
            calculateTotal();
        }

        document.getElementById('selectAll').addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('.product-checkbox');
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
        });

        $(document).ready(function() {
            $('#searchInput').on('keyup', function() {
                let searchText = $(this).val().toLowerCase();
                $('#productList tr').filter(function() {
                    let productCode = $(this).find('td:eq(1)').text().toLowerCase(); // Mã sản phẩm
                    let productName = $(this).find('td:eq(2)').text().toLowerCase(); // Tên sản phẩm
                    let matches = productCode.includes(searchText) || productName.includes(
                        searchText);
                    $(this).toggle(matches);
                });
            });
        });

        function importExcel() {
            const fileInput = document.getElementById('excelFile');
            const file = fileInput.files[0];

            if (!file) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Chưa chọn file',
                    text: 'Vui lòng chọn file Excel',
                    timer: 1000,
                    showConfirmButton: false
                });
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                try {
                    const data = new Uint8Array(e.target.result);
                    const workbook = XLSX.read(data, {
                        type: 'array'
                    });
                    const firstSheet = workbook.Sheets[workbook.SheetNames[0]];

                    const jsonData = XLSX.utils.sheet_to_json(firstSheet, {
                        header: ['sku', 'name', 'quantity', 'price'],
                        range: 1
                    });

                    // Reset tất cả checkbox và input trước khi import
                    document.querySelectorAll('#productList tr').forEach(row => {
                        const checkbox = row.querySelector('.product-checkbox');
                        const priceInput = row.querySelector('input[placeholder="Nhập giá"]');
                        const quantityInput = row.querySelector('input[placeholder="Nhập số lượng"]');

                        if (checkbox) checkbox.checked = false;
                        if (priceInput) priceInput.value = '';
                        if (quantityInput) quantityInput.value = '';
                    });

                    // Reset checkbox "Chọn tất cả"
                    document.getElementById('selectAll').checked = false;

                    // Kiểm tra và import
                    const invalidProducts = [];
                    jsonData.forEach(row => {
                        if (!row.sku) return;

                        const productRow = Array.from(document.querySelectorAll('#productList tr')).find(tr => {
                            return tr.querySelector('td:nth-child(2)').textContent.trim() === row.sku;
                        });

                        if (!productRow) {
                            invalidProducts.push(row.sku);
                        }
                    });

                    if (invalidProducts.length > 0) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Lỗi import',
                            html: `Các mã sản phẩm sau không tồn tại trong hệ thống:<br><strong>${invalidProducts.join(', ')}</strong>`,
                            timer: 3000,
                            showConfirmButton: false
                        });
                        return;
                    }

                    let importCount = 0;
                    jsonData.forEach(row => {
                        if (!row.sku) return;

                        const productRow = Array.from(document.querySelectorAll('#productList tr')).find(tr => {
                            return tr.querySelector('td:nth-child(2)').textContent.trim() === row.sku;
                        });

                        if (productRow) {
                            const priceInput = productRow.querySelector('input[placeholder="Nhập giá"]');
                            const quantityInput = productRow.querySelector(
                                'input[placeholder="Nhập số lượng"]');
                            const checkbox = productRow.querySelector('.product-checkbox');

                            if (priceInput && quantityInput && checkbox) {
                                priceInput.value = row.price || '';
                                quantityInput.value = row.quantity || '';
                                checkbox.checked = true;
                                importCount++;
                            }
                        }
                    });

                    // Xóa hết sản phẩm trong bảng selectedProductsTable
                    const selectedProductsTable = document.querySelector('#selectedProductsTable tbody');
                    selectedProductsTable.innerHTML = '';

                    Swal.fire({
                        icon: 'success',
                        title: 'Thành công',
                        text: `Import thành công ${importCount} sản phẩm!`,
                        timer: 1000,
                        showConfirmButton: false
                    });

                } catch (error) {
                    console.error('Error processing Excel:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Lỗi',
                        text: 'Có lỗi xảy ra khi xử lý file Excel.',
                        timer: 1000,
                        showConfirmButton: false
                    });
                }
            };

            reader.readAsArrayBuffer(file);
        }

        // Thêm hàm tiện ích để tìm text trong các phần tử
        jQuery.expr[':'].contains = function(a, i, m) {
            return jQuery(a).text().toUpperCase()
                .indexOf(m[3].toUpperCase()) >= 0;
        };

        // Sửa lại event submit form
        document.getElementById('importOrderForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const totalInput = document.getElementById('total_amount');
            const rawValue = parseInt(totalInput.value.replace(/[.,]/g, ''));
            totalInput.value = rawValue;

            // Submit form
            this.submit();
        });
    </script>
@endpush

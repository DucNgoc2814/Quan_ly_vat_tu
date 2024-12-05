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

                <!-- Phương thức thanh toán -->
                <div class="mb-3">
                    <label class="form-label">Phương thức thanh toán</label>
                    <select class="form-select" name="payment_id" required>
                        @foreach ($payments as $payment)
                            <option value="{{ $payment->id }}">{{ $payment->name }}</option>
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
                <div class="mb-3">
                    <label class="form-label">Tổng tiền</label>
                    <input type="number" class="form-control" name="total_amount" id="total_amount" required>
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
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3 d-flex justify-content-between align-items-center">
                        <input type="text" class="form-control me-2" id="searchInput" placeholder="Tìm kiếm sản phẩm...">

                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
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
                <div class="modal-footer">
                    <div class="col-sm-auto">
                        <div>
                            <input type="file" id="excelFile" accept=".xlsx, .xls" style="display: none;" onchange="importExcel()">
                            <a href="#" class="btn btn-success" onclick="document.getElementById('excelFile').click(); return false;">
                                <i class="ri-download-2-fill align-middle me-1"></i>Nhập Excel
                            </a>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary" onclick="addSelectedProducts()">Thêm sản phẩm đã chọn</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
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
                row.setAttribute('data-code', product.code);
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
        }

        function addSelectedProducts() {
            const rows = document.querySelectorAll('#productList tr');
            let hasError = false;

            rows.forEach(row => {
                const checkbox = row.querySelector('input[type="checkbox"]');
                if (checkbox && checkbox.checked) {
                    const productName = row.cells[1].textContent;
                    const priceInput = row.querySelector('input[placeholder="Nhập giá"]');
                    const quantityInput = row.querySelector('input[placeholder="Nhập số lượng"]');

                    console.log('Product:', productName);
                    console.log('Price Input:', priceInput);
                    console.log('Quantity Input:', quantityInput);

                    if (!priceInput?.value || !quantityInput?.value) {
                        hasError = true;
                        return;
                    }

                    const price = parseFloat(priceInput.value);
                    const quantity = parseFloat(quantityInput.value);
                    const lineTotal = price * quantity;

                    const selectedProductsTable = document.querySelector('#selectedProductsTable tbody');
                    const newRow = document.createElement('tr');
                    newRow.innerHTML = `
                        <td>${productName}</td>
                        <td>${price}</td>
                        <td>${quantity}</td>
                        <td>${lineTotal}</td>
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
                alert('Vui lòng nhập đầy đủ giá và số lượng cho các sản phẩm đã chọn');
                return;
            }

            calculateTotal();
            const modal = bootstrap.Modal.getInstance(document.getElementById('productModal'));
            modal.hide();
        }

        function calculateLineTotal(price, quantity) {
            return price * quantity;
        }

        function calculateTotal() {
            let total = 0;
            const rows = document.querySelectorAll('#selectedProductsTable tbody tr');

            rows.forEach(row => {
                const lineTotal = parseFloat(row.querySelector('td:nth-child(4)').textContent);
                total += lineTotal;
            });

            document.getElementById('total_amount').value = total;
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

        document.getElementById('searchInput').addEventListener('input', function() {
            const searchValue = this.value.toLowerCase();
            const productRows = document.querySelectorAll('#productList tr');

            productRows.forEach(row => {
                const productName = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
                if (productName.includes(searchValue)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
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
                    const workbook = XLSX.read(data, { type: 'array' });
                    const firstSheet = workbook.Sheets[workbook.SheetNames[0]];

                    const jsonData = XLSX.utils.sheet_to_json(firstSheet, {
                        header: ['sku', 'name', 'quantity', 'price'],
                        range: 1  // Bỏ qua dòng tiêu đề
                    });

                    // Kiểm tra tất cả sản phẩm trước khi import
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

                    // Nếu có sản phẩm không tồn tại, hiển thị thông báo lỗi
                    if (invalidProducts.length > 0) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Lỗi import',
                            html: `Các mã sản phẩm sau không tồn tại trong hệ thống:<br><strong>${invalidProducts.join(', ')}</strong>`,
                            timer: 3000, // Tăng thời gian hiển thị để người dùng có thể đọc
                            showConfirmButton: false
                        });
                        return; // Dừng quá trình import
                    }

                    // Nếu tất cả sản phẩm hợp lệ, tiến hành import
                    let importCount = 0;
                    jsonData.forEach(row => {
                        if (!row.sku) return;

                        const productRow = Array.from(document.querySelectorAll('#productList tr')).find(tr => {
                            return tr.querySelector('td:nth-child(2)').textContent.trim() === row.sku;
                        });

                        const priceInput = productRow.querySelector('input[placeholder="Nhập giá"]');
                        const quantityInput = productRow.querySelector('input[placeholder="Nhập số lượng"]');
                        const checkbox = productRow.querySelector('.product-checkbox');

                        if (priceInput && quantityInput && checkbox) {
                            priceInput.value = row.price || '';
                            quantityInput.value = row.quantity || '';
                            checkbox.checked = true;
                            importCount++;
                        }
                    });

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

            reader.onerror = function(error) {
                console.error('Error reading file:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi',
                    text: 'Có lỗi xảy ra khi đọc file.',
                    timer: 1000,
                    showConfirmButton: false
                });
            };

            reader.readAsArrayBuffer(file);
        }

        // Thêm hàm tiện ích để tìm text trong các phần tử
        jQuery.expr[':'].contains = function(a, i, m) {
            return jQuery(a).text().toUpperCase()
                .indexOf(m[3].toUpperCase()) >= 0;
        };
    </script>
@endpush

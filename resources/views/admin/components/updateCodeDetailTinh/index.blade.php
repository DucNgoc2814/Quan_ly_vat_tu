<%- include('header') -%>
<div class="container-order">
    <div class="invoice">
        <div class="invoice-header">
            <div class="company-info d-flex">
                <img src="/assets/img/logo.png" alt="Logo" class="logo">
                <div style="margin-left: 200px;">
                    <h2>PANDA SHOP</h2>
                    <p>Địa chỉ: Yên Lâm - Yên Mô - Ninh Bình</p>
                    <p>Điện thoại: (+84) 62201004</p>
                    <p>Email: pandashop@gmail.com</p>
                </div>
            </div>
        </div>
        <div class="invoice-details">
            <div class="invoice-to">
                <h3>Khách hàng:</h3>
                <p><strong><%= order.full_name_user %></strong></p>
                <p><%= order.address_user %></p>
                <p>Điện thoại: <%= order.tel_user %></p>
                <p><strong>Trạng thái đơn hàng:</strong>
                    <span style="background-color: #3498db; color: white;" class="status order-status">
                        <% if(order.code_status == 3) { %>
                        Đang xử lý
                        <% } else if(order.code_status == 4) { %>
                        Đang giao hàng
                        <% } else if(order.code_status == 5) { %>
                        Đã giao hàng
                        <% } else if(order.code_status == 6) { %>
                        Đã hủy
                        <% } else { %>
                        Không xác định
                        <% } %>
                    </span>
                </p>
            </div>
            <div class="invoice-info">
                <h3>Thông tin đơn hàng:</h3>
                <p class="invoice-number" style="font-size: small;">#<%= order.code_oders  %></p>
                <%
function formatDate(date) {
    const d = new Date(date);
    return `${d.getDate()}/${d.getMonth() + 1}/${d.getFullYear()} `;
}
%>
                <p><strong>Ngày đặt hàng:</strong> <%= formatDate(order.createdAt) %></p>
                <% if(order.payment_method == 1) { %>
                <p><strong>Phương thức thanh toán:</strong> Thanh toán khi nhận hàng</p>
                <p><strong>Thanh toán:</strong> <span class="status paid" style="background-color: red;">Chưa thanh
                        toán</span></p>
                <% } else{ %>
                <p><strong>Phương thức thanh toán:</strong> Thanh toán trực tuyến</p>
                <p><strong>Thanh toán:</strong> <span class="status paid">Đã thanh toán</span></p>
                <% } %>
            </div>
        </div>
        <table class="invoice-items">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Sản phẩm</th>
                    <th>Đơn giá</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                <% stt = 0;
                allTotall = 0
                %>
                <% product.forEach(function(item) { %>
                <tr>
                    <td><%= stt+=1 %></td>
                    <td>
                        <a href="/detail-product/<%= item.Variant.Product.id%>">
                            <%= item.Variant.Product.name_product %> (
                            <%= item.Variant.Color.name_color + ','+ item.Variant.Size.name_size  %> )
                        </a>
                    </td>
                    <td><%= formatCurrency( price = item.Variant.Product.price_product-(item.Variant.Product.price_product * (item.Variant.Product.price_sale / 100)))  %>
                    <td><%= item.quantity %> </td>
                    </td>
                    <td><%= formatCurrency(item.quantity * price) %></span>
                        <% allTotall += item.quantity * price; %></td>
                </tr>
                <% }) %>
            </tbody>
        </table>
        <div class="invoice-summary">
            <div class="summary-item">
                <span>Tổng cộng:</span>
                <span><%= formatCurrency(allTotall) %></span>

            </div>
            <div class="summary-item">
                <span>Phí vận chuyển:</span>
                <span>
                    <%=formatCurrency(30000) %></span>
            </div>
            <div class="summary-item">
                <span>Mã giảm giá:</span>
                <span>-<%=formatCurrency(30000) %></span>
            </div>
            <% if(order.payment_method == 1) { %>
            <div class="summary-item total">
                <span>Tổng thanh toán:</span>
                <span><%= formatCurrency(allTotall) %></span>
            </div>
            <% } else{ %>
            <div class="summary-item">
                <span>Đã thanh toán:</span>
                <span>-<%= formatCurrency(allTotall) %></span>
            </div>
            <div class="summary-item total">
                <span>Tổng thanh toán:</span>
                <span><%= formatCurrency(0) %></span>
            </div>
            <% } %>

        </div>
        <div class="invoice-footer">
            <p>Cảm ơn quý khách đã mua hàng!</p>
            <p>Mọi thắc mắc xin liên hệ: pandashop@gmail.com | Hotline: 0862201004</p>
            <div class="barcode">
            </div>
        </div>
    </div>
</div>

<style>
    .container-order {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
        font-family: 'Arial', sans-serif;
        background-color: #f9f9f9;
    }

    .invoice {
        border: 1px solid #ddd;
        padding: 30px;
        background-color: #fff;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    }

    .invoice-header {
        display: flex;
        justify-content: space-between;
        margin-bottom: 30px;
    }

    .company-info {
        text-align: left;
    }

    .logo {
        max-width: 150px;
        margin-bottom: 10px;
    }

    .invoice-title {
        text-align: right;
    }

    h1,
    h2,
    h3 {
        color: #333;
        margin: 0 0 10px 0;
    }

    .invoice-number {
        font-size: 1.2em;
        color: #777;
    }

    .invoice-details {
        display: flex;
        justify-content: space-between;
        margin-bottom: 30px;
        background-color: #f8f8f8;
        padding: 20px;
        border-radius: 5px;
    }

    .invoice-to,
    .invoice-info {
        flex-basis: 48%;
    }

    .invoice-items {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 30px;
    }

    .invoice-items th,
    .invoice-items td {
        border: 1px solid #ddd;
        padding: 12px;
        text-align: left;
    }

    .invoice-items th {
        background-color: #f2f2f2;
        font-weight: bold;
        color: #333;
    }

    .invoice-items tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    .invoice-summary {
        margin-top: 20px;
        background-color: #f8f8f8;
        padding: 20px;
        border-radius: 5px;
    }

    .summary-item {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
    }

    .summary-item.total {
        font-weight: bold;
        font-size: 1.2em;
        margin-top: 10px;
        border-top: 2px solid #ddd;
        padding-top: 10px;
    }

    .invoice-footer {
        margin-top: 30px;
        text-align: center;
        color: #777;
        font-size: 0.9em;
    }

    .status {
        display: inline-block;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 0.8em;
        font-weight: bold;
    }

    .status.paid {
        background-color: #d4edda;
        color: #155724;
    }

    .barcode {
        margin-top: 20px;
    }

    .barcode img {
        max-width: 200px;
    }

    @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap');

    .container-order {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
        font-family: 'Roboto', sans-serif;
        background-color: #f0f4f8;
    }

    .invoice {
        border: none;
        padding: 40px;
        background-color: #ffffff;
        box-shadow: 0 0 30px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
    }

    .invoice-header {
        background-color: #4a90e2;
        color: white;
        padding: 20px;
        border-radius: 10px 10px 0 0;
        margin: -40px -40px 30px -40px;
    }

    h1 {
        font-size: 36px;
        font-weight: 700;
        margin: 0;
    }

    h2,
    h3 {
        color: #2c3e50;
        font-weight: 700;
    }

    .invoice-details {
        background-color: #ecf0f1;
        border-radius: 5px;
    }

    .invoice-items th {
        background-color: #3498db;
        color: white;
    }

    .invoice-items tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    .summary-item.total {
        background-color: #2ecc71;
        color: white;
        padding: 10px;
        border-radius: 5px;
    }

    .status.paid {
        background-color: #27ae60;
        color: white;
    }

    .invoice-footer {
        border-top: 2px solid #3498db;
        padding-top: 20px;
        margin-top: 30px;
    }
</style>
<%  function formatCurrency(amount) {
    return amount.toLocaleString('vi-VN', {
        style: 'currency',
        currency: 'VND'
    });
} %>
<script src="/assets/js/jquery.min.js"></script>

<%- include('footer') -%>
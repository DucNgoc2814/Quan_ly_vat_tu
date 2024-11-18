<h2>Thông báo trạng thái hợp đồng</h2>

<p>Khách hàng {{ $contract->customer_name }} đã {{ $action }} hợp đồng #{{ $contract->id }}</p>

<p>Thông tin hợp đồng:</p>
<ul>
    <li>Tên hợp đồng: {{ $contract->contract_name }}</li>
    <li>Email khách hàng: {{ $contract->customer_email }}</li>
    <li>Số điện thoại: {{ $contract->customer_phone }}</li>
    <li>Thời gian {{ $action }}: {{ now() }}</li>
</ul>

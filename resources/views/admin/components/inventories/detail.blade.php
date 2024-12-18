<table class="table table-bordered">
    <thead>
        <tr>
            <th>Mã biến thể</th>
            <th>Tên sản phẩm</th>
            <th>Số lượng thực tế</th>
            <th>Số lượng hệ thống</th>
            <th>Chênh lệch</th>
        </tr>
    </thead>
    <tbody>
        @foreach($inventory as $detail)
        <tr class="{{ $detail->actual_quantity > 0 && $detail->system_quantity == 0 ? 'table-danger' : '' }}">
            <td>{{ $detail->variation->sku }}</td>
            <td>{{ $detail->variation->name }}</td>
            <td>{{ $detail->actual_quantity }}</td>
            <td>{{ $detail->system_quantity }}</td>
            <td>{{ $detail->deviation }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

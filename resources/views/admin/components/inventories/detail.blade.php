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
        @foreach($inventory->inventoryDetails as $detail)
        <tr>
            <td>{{ $detail->variation->sku }}</td>
            <td>{{ $detail->variation->name }}</td>
            <td>{{ $detail->actual_quantity }}</td>
            <td>{{ $detail->system_quantity }}</td>
            <td>{{ $detail->deviation }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

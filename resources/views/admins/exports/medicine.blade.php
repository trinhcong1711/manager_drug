<table>
    <thead>
    <tr>
        <th>Tên</th>
        <th>Hàm lượng</th>
        <th>Hạn sử dụng</th>
        <th>Quy cách đóng gói</th>
        <th>Tồn kho</th>
        <th>Giá nhập</th>
        <th>Đơn vị tính</th>
        <th>Đơn vị quy đổi</th>
        <th>Giá bán</th>
        <th>Số lượng đã bán</th>
        <th>Trạng thái</th>
    </tr>
    </thead>
    <tbody>
    @foreach($medicines as $medicine)
        <tr>
            <td>{{ $medicine->name }}</td>
            <td>{{ $medicine->amount }}</td>
            <td>{{ date('d-m-Y',strtotime($medicine->exp))}}</td>
            <td>{{ $medicine->package }}</td>
            <td>{{ $medicine->inventory }}</td>
            <td>{{ $medicine->price_import }}</td>
            <td>{{ implode(', ',json_decode($medicine->price,true)['unit']) }}</td>
            <td>{{ implode(', ',json_decode($medicine->price,true)['convert']) }}</td>
            <td>{{ implode(', ',json_decode($medicine->price,true)['price']) }}</td>
            <td>{{ $medicine->sold }}</td>
            <td>{{ $medicine->status }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

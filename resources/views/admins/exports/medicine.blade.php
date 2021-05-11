<table>
    <thead>
    <tr>
        <th>Tên</th>
        <th>Quy cách đóng gói</th>
        <th>Tồn kho</th>
        <th>Định mức tồn</th>
        <th>Đơn vị quy đổi</th>
        <th>Số lượng đã bán</th>
        <th>Trạng thái</th>
    </tr>
    </thead>
    <tbody>
    @foreach($medicines as $medicine)
        <?php
        $units = $medicine->units;
        $str = "";
        foreach ($units as $k => $unit) {
            $char = $k != (count($units) - 1) ? "," : "";
            $str .= $unit->convert . "-" . $unit->name . "-" . $unit->price . $char;
        }
        ?>
        <tr>
            <td>{{ $medicine->name }}</td>
            <td>{{ $medicine->package }}</td>
            <td>{{ $medicine->inventory }}</td>
            <td>{{ $medicine->rest }}</td>
            <td>{{ $str }}</td>
            <td>{{ $medicine->sold }}</td>
            <td>{{ $medicine->status }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

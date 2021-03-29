<table>
    <thead>
    <tr>
        <th>Tên</th>
        <th>Số lượng</th>
        <th>Đơn vị tính</th>
        <th>Ghi chú</th>
    </tr>
    </thead>
    <tbody>
    @foreach($medicines as $medicine)
        <tr>
            <td>{{ $medicine->name }}</td>
            <td>{{ $medicine->pivot->amount }}</td>
            <td>{{ @\App\Entities\Unit::find($medicine->pivot->unit)->name }}</td>
            <td>{{ $medicine->pivot->note }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

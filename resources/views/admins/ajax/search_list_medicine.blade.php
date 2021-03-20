@if(!empty($medicines))

    @foreach($medicines as $medicine)
    <tr>
        <th scope="row">
            <label class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" name="example-checkbox1"
                       value="option1" checked="">
                <span class="custom-control-label"></span>
            </label>
        </th>
        <td>1</td>
        <td contenteditable="true">{{ $medicine->name . ' - ' . $medicine->amount }}</td>
        <td contenteditable="true"></td>
        <td contenteditable="true">0</td>
        <td>
            <div class="btn-list">
                <button type="button" class="btn btn-icon  btn-gray" data-toggle="tooltip"
                        data-title="Sửa & Lưu"><i class="ti-pencil-alt"></i></button>
                <button type="button" class="btn btn-icon  btn-red" data-toggle="tooltip"
                        data-title="Xóa"><i class="ti-close"></i></button>
            </div>
        </td>
    </tr>
    @endforeach
@endif

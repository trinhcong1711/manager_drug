@if(!empty($medicine))
    <tr>
        <th>{{$k+1}}<input type="number" name="medicine_id[]"
                           value="{{$medicine->id}}" hidden></th>
        <th>{{$medicine->name}}</th>
        <th>
            <input type="number" class="form-control"
                   name="import_medicine[{{$k}}][amount]"
                   value=1>
        </th>
        <th>
            <select name="import_medicine[{{$k}}][unit]"
                    class="form-control select2 custom-select"
                    data-placeholder="Chọn đơn vị tính">
                <option label="Chọn đơn vị tính"></option>
                @if(count($units = $medicine->units)>0)
                    @foreach($units as $unit)
                        <option value="{{$unit->id}}">{{$unit->name}}</option>
                    @endforeach
                @endif
            </select>
        </th>
        <th>
                                                <textarea class="form-control" name="import_medicine[{{$k}}][note]"
                                                          rows="1"></textarea>
        </th>
        <th>
            <div class="btn-list">
                <button type="button" class="btn btn-icon  btn-red"
                        data-toggle="tooltip"
                        data-title="Xóa"><i class="ti-close"></i></button>
            </div>
        </th>
    </tr>
@endif


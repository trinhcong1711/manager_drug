@if(isset($medicine))
    <tr class="row-medicine">
        <th>{{$medicine->name}}<input type="number" name="medicine_id[]"
                                      value="{{$medicine->id}}" hidden></th>
        <th>
            <input type="number" class="form-control"
                   name="import_medicine[amount][]"
                   value=1>
        </th>
        <th>
            <select name="import_medicine[unit][]"
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
            <textarea class="form-control" name="import_medicine[note][]"
                      rows="1"></textarea>
        </th>
        <th>
            <div class="btn-list">
                <button type="button" class="btn btn-icon remove_medicine btn-red"><i class="ti-close"></i></button>
            </div>
        </th>
    </tr>
@endif


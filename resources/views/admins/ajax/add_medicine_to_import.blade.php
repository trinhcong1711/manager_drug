@if(isset($medicine))
    <tr class="row-medicine">
        <th>{{$medicine->name}}<input type="number" name="medicine_id[]"
                                      value="{{$medicine->id}}" hidden></th>
        <th>
            <input type="number" class="form-control"
                   name="amounts[]"
                   value=1>
        </th>
        <th>
            <select name="units[]"
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
            <textarea class="form-control" name="notes[]"
                      rows="1"></textarea>
        </th>
        @if(isset($price))
        <th>
            <input class="form-control" name="prices[]">
        </th>
        @endif
        <th>
            <div class="btn-list">
                <button type="button" class="btn btn-icon remove_medicine btn-red"><i class="ti-close"></i></button>
            </div>
        </th>
    </tr>
@endif


@if(isset($medicine))
    <tr class="row_sell">
        <th scope="row">1</th>
        <td>
            <p class="title_product">{{$medicine->name}} </p>
            <span class="specification_product">{{$medicine->package}}</span>
        </td>
        <td>
            <input type="text" class="price_customer border-0" name="amount"
                   placeholder="Nhập số lượng..." value="1">
        </td>
        <td>
            <select class="form-control select2 custom-select units_select">
                </option>
                @if(count($units = $medicine->units)>0)
                    @foreach($units as $unit)
                        <option value="{{$unit->price}}">{!! number_format($unit->price,0,"",",")." / ". $unit->name !!} </option>
                    @endforeach
                @endif
            </select>
        </td>
        <td class="total_price"></td>
        <td>
            <i class="ti-close remove_medicine"></i>
        </td>
    </tr>
@endif


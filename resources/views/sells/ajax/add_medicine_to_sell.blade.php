@if(isset($medicine))
    <tr class="row_sell" data-id_selected="{{$medicine->id}}">
        <input type="hidden" value="{{$medicine->id}}" name="medicine_id[]">
        <th scope="row">1</th>
        <td>
            <p class="title_product">{{$medicine->name}} </p>
            <span class="specification_product">{{$medicine->package}}</span>
        </td>
        <td>
            <input type="text" class="price_customer amount_medicine border-0" name="amount[]"
                   placeholder="Nhập số lượng..." value="1">
        </td>
        <td>
            <select class="form-control select2 custom-select units_select" name="unit_id[]">
                @if(count($units = $medicine->units)>0)
                    @foreach($units as $k=>$unit)
                        <option
                            value="{{$unit->id}}" {{$k==0?"selected":''}} data-unit_price="{{$unit->price}}">{!! number_format($unit->price,0,"",",")." / ". $unit->name !!} </option>
                    @endforeach
                @endif
            </select>
        </td>
        <td class="total_price" data-total_price="0"></td>
        <td>
            <i class="ti-close remove_medicine" style="cursor: pointer; padding: 10px;"></i>
        </td>
    </tr>
    <script>
        $(document).ready(function () {
            $("body").on('keyup', ".amount_medicine", function () {
                let amount = $(this).val();
                let unit_price = $(this).parents(".row_sell").find(".units_select").find(':selected').data("unit_price");
                let price = unit_price*amount;
                $(this).parents(".row_sell").find(".total_price").text(formatPrice(price));
                $(this).parents(".row_sell").find(".total_price").data("total_price",formatPrice(price));
                $(".total_price_bill").text(formatPrice(totalPrice()));
                let price_customer = $("#price_customer").val();
                $(".refund_customer").text(formatPrice(totalPriceRefundCustomer(price_customer)));
            });
            $("body").on('change', ".units_select", function () {
                let unit_price = $(this).find(':selected').data("unit_price");
                let amount = $(this).parents(".row_sell").find(".amount_medicine").val();
                let price = unit_price*amount;
                $(this).parents(".row_sell").find(".total_price").text(formatPrice(price));
                $(this).parents(".row_sell").find(".total_price").data("total_price",formatPrice(price));
                $(".total_price_bill").text(formatPrice(totalPrice()));
                let price_customer = $("#price_customer").val();
                $(".refund_customer").text(formatPrice(totalPriceRefundCustomer(price_customer)));
            });

        });
    </script>
@endif


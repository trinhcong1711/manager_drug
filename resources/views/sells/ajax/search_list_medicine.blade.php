@if(!empty($medicines))
    <div class="table-responsive">
        <table class="table card-table table-vcenter text-nowrap table-secondary">
            <thead class="bg-secondary text-white">
            <tr>
                <th class="text-white">Tên</th>
                <th class="text-white">Tồn</th>
                <th class="text-white">Giá bán</th>
            </tr>
            </thead>
            <tbody>
            @foreach($medicines as $medicine)
                <tr class="row-search" data-medicine_id="{{$medicine->id}}" data-selected="0">
                    <td class="medicine_name">{{$medicine->name}}</td>
                    <td>{{number_format($medicine->inventory,0,"",",")}}</td>
                    <td>{!! $medicine->formatPrice($medicine->units) !!}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@else
    <div class="table-responsive">
        <table class="table card-table table-vcenter text-nowrap table-secondary">
            <tbody>
            <tr>
                <td colspan="2">Không tìm thấy!</td>
            </tr>
            </tbody>
        </table>
    </div>
@endif


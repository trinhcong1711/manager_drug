@extends('admins.layouts.master')
@section('page-header')
    <!-- PAGE-HEADER -->
    <div class="btn-list">
        <button type="button" class="btn btn-outline-secondary" data-toggle="tooltip" title="Thêm thuốc thủ công">
            <a href="/thuoc/them" style="color: inherit;"><i class="fe fe-plus mr-2"></i>Thêm thuốc</a>
        </button>
        <button type="button" class="btn btn-outline-secondary" data-toggle="tooltip" title="Thêm thuốc bằng mã vạch"><i
                class="fa fa-barcode"></i>
        </button>
        <button type="button" class="btn btn-outline-secondary" data-toggle="tooltip" title="Thêm thuốc bằng excel">
            <i class="fa fa-file-excel-o"></i>
        </button>
        <button type="button" class="btn btn-outline-secondary" data-toggle="tooltip"
                title="Tạo phiếu nhập theo bộ lọc">
            <i class="fe fe-plus mr-2"></i>Tạo phiếu nhập
        </button>
        <button type="button" class="btn btn-outline-secondary" data-toggle="tooltip" title="Tạo phiếu kiểm kho">
            <i class="fe fe-plus mr-2"></i>Tạo phiếu kiểm kho
        </button>
    </div>
    <!-- PAGE-HEADER END -->
@endsection
@section('content')
    <!-- ROW-1 -->
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Danh sách Thuốc</h3>
                </div>
                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>STT</th>
                            <th>Tên</th>
                            <th>Hàm lượng</th>
                            <th>HSD</th>
                            <th>Quy cách</th>
                            <th>Tồn kho</th>
                            <th>Giá nhập</th>
                            <th>Giá bán</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($medicines->count()>0)
                            @foreach($medicines as $k=>$medicine)
                                <tr>
                                    <th scope="row">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="example-checkbox1"
                                                   value="option1" checked="">
                                            <span class="custom-control-label"></span>
                                        </label>
                                    </th>
                                    <td>{{$k+1}}</td>
                                    <td>
                                        <div class="item_name">
                                            <a href="{{route('admin.medicine.getEdit',$medicine->id)}}">{{$medicine->name}}</a>
                                            <span class="tool_tip_item_name">
                                                <a href="{{route('admin.medicine.getEdit',$medicine->id)}}">Sửa</a>
                                                <a href="{{route('admin.medicine.getDelete',$medicine->id)}}">Xóa</a>
                                            </span>
                                        </div>
                                    </td>
                                    <td>{{$medicine->amount}}</td>
                                    <td>{{date('d/m/Y',strtotime($medicine->exp))}}</td>
                                    <td>{{$medicine->package}}</td>
                                    <td>{{number_format($medicine->inventory,'0','','.')}}</td>
                                    <td>{{number_format($medicine->price_import,'0','','.')}}</td>
                                    <td>
                                        <table>
                                            @if(count($medicine->prices)>0)
                                                @foreach($medicine->prices as $unit=>$price)
                                                    <tr>
                                                        <td class="border-top-0 p-0 pr-1 text-capitalize">{{$unit}}: </td>
                                                        <td class="border-top-0 p-0">{{number_format($price,'0','','.')}}</td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </table>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
                <!-- table-responsive -->
            </div>
        </div>
    </div>
    <!-- ROW-1 CLOSED -->
@endsection

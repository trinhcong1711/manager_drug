@extends('admins.layouts.master')
@section('css')
    <!-- FILE UPLOADE CSS -->
    <link href="{{URL::asset('assets/plugins/fileuploads/css/fileupload.css')}}" rel="stylesheet" type="text/css"/>

    <!-- SELECT2 CSS -->
    <link href="{{URL::asset('assets/plugins/select2/select2.min.css')}}" rel="stylesheet"/>
    <style>
        .search {
            width: 100%;
            position: relative;
        }

        .search-result {
            position: absolute;
            top: 100%;
            left: 0;
            z-index: 9;
            width: 100%;
            background: #ccc;
        }

        tr.row-search:hover {
            background: #efa0b8;
        }

        tr.row-search {
            cursor: pointer;
        }
    </style>
@endsection
@section('page-header')
    @if($export->status!=1)
        <div class="search">
            <input type="text" name="search" class="form-control" id="add_medicine"
                   placeholder="Nhập tên thuốc muốn thêm vào danh sách nhập....">
            <div class="search-result"></div>
        </div>
    @endif

@endsection
@section('content')

    <!-- ROW-1 -->
    <div class="row">
        <div class="col-md-12 col-lg-12">

            <form action="{{route('admin.export_medicine.postEdit',$export->id)}}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="card-header">
                            <div class="col-6 p-0">
                                <h3 class="mb-0 card-title">Chỉnh sửa danh sách thuốc cần nhập</h3>
                            </div>
                            <div class="col-6 p-0">
                                <div class="btn-list text-right">
                                    <button type="button" class="btn btn-outline-default" data-toggle="tooltip"
                                            title="Quay về trang danh sách thuốc">
                                        <a href="{{route('admin.export_medicine.getIndex')}}" style="color: inherit;"><i
                                                class="icon icon-action-undo mr-2"></i>Quay lại</a>
                                    </button>
                                    <button type="submit" class="btn btn-primary" name="check_invoice" value="1"
                                            id="add_continue"><i
                                            class="ti-save-alt mr-2"></i>Kiểm hàng
                                    </button>

                                    @if($export->status!=1)
                                        <button type="submit" class="btn btn-primary"
                                                id="add_continue"><i
                                                class="ti-save-alt mr-2"></i>Lưu
                                        </button>
                                    @endif
                                </div>
                            </div>

                        </div>

                        <div class="card-body">

                            <div class="row mb-5">
                                <div class="col-md-12">
                                    <table>
                                        <tr>
                                            <th style="padding: 5px">Người tạo:</th>
                                            <th style="padding: 5px">Trịnh Công</th>
                                        </tr>
                                        <tr>
                                            <th style="padding: 5px">Người nhận:</th>
                                            <th style="padding: 5px">Trịnh Nguyên</th>
                                        </tr>
                                        <tr>
                                            <th style="padding: 5px">Ngày tạo phiếu xuất:</th>
                                            <th style="padding: 5px">{{$export->created_at->format("d/m/Y")}}</th>
                                        </tr>
                                        <tr>
                                            <th style="padding: 5px">Tổng giá:</th>
                                            <th style="padding: 5px">{{number_format($export->total_money,0,'',',')}}</th>
                                        </tr>
                                        <tr>
                                            <th style="padding: 5px">Loại:</th>
                                            <th style="padding: 5px">{{show_status([1=>'Hệ thống', 2=>"Trình dược", 3=>'Chợ thuốc'],$export->type)}}</th>
                                        </tr>
                                        <tr>
                                            <th style="padding: 5px">Ghi chú:</th>
                                            <th style="padding: 5px">{{$export->note}}</th>
                                        </tr>
                                        <tr>
                                            <th style="padding: 5px">Trạng thái:</th>
                                            <th style="padding: 5px">
                                                <label class="custom-switch">
                                                    <input type="checkbox" name="status"
                                                           {{$export->status==1?"checked":""}} class="custom-switch-input">
                                                    <span class="custom-switch-indicator"></span>
                                                    <span class="custom-switch-description">{{show_status([0=>'Chưa thanh toán', 1=>"Đã thanh toán"],$export->status)}}</span>
                                                </label>
                                            </th>
                                        </tr>
                                    </table>
                                </div>

                            </div>
                            <div class="row">
                                <table id="import_datatable" class="table card-table table-vcenter text-nowrap">
                                    <thead>
                                    <tr>
                                        <th>Tên thuốc</th>
                                        <th>Số lượng</th>
                                        <th>đơn vị tính</th>
                                        <th>Giá</th>
                                    </tr>
                                    </thead>
                                    <tbody class="list_medicine">
                                    @if(!empty($medicines))
                                        @foreach($medicines as $medicine)
                                            {{--                                            @if($export->status!=1)--}}
                                            {{--                                                <tr class="row-medicine">--}}
                                            {{--                                                    <th>{{$medicine->name}}<input type="number" name="medicine_id[]"--}}
                                            {{--                                                                                  class="medicine_id"--}}
                                            {{--                                                                                  value="{{$medicine->id}}" hidden></th>--}}
                                            {{--                                                    <th>--}}
                                            {{--                                                        <input type="number" class="form-control"--}}
                                            {{--                                                               name="amounts[]"--}}
                                            {{--                                                               value={{$medicine->pivot->amount}}>--}}
                                            {{--                                                    </th>--}}
                                            {{--                                                    <th>--}}
                                            {{--                                                        <select name="units[]"--}}
                                            {{--                                                                class="form-control select2 custom-select"--}}
                                            {{--                                                                data-placeholder="Chọn đơn vị tính">--}}
                                            {{--                                                            <option label="Chọn đơn vị tính"></option>--}}
                                            {{--                                                            @if(count($units = $medicine->units)>0)--}}
                                            {{--                                                                @foreach($units as $unit)--}}
                                            {{--                                                                    <option--}}
                                            {{--                                                                        {{$medicine->pivot->unit == $unit->id?"selected":""}} value="{{$unit->id}}">{{$unit->name}}</option>--}}
                                            {{--                                                                @endforeach--}}
                                            {{--                                                            @endif--}}
                                            {{--                                                        </select>--}}
                                            {{--                                                    </th>--}}
                                            {{--                                                    <th>--}}
                                            {{--                                                <textarea class="form-control" name="notes[]"--}}
                                            {{--                                                          rows="1">{{$medicine->pivot->note}}</textarea>--}}
                                            {{--                                                    </th>--}}
                                            {{--                                                    <th>--}}
                                            {{--                                                        <input class="form-control" name="prices[]"--}}
                                            {{--                                                               value="{{$medicine->pivot->price??0}}">--}}
                                            {{--                                                    </th>--}}

                                            {{--                                                    <th>--}}
                                            {{--                                                        <div class="btn-list">--}}
                                            {{--                                                            <button type="button"--}}
                                            {{--                                                                    class="btn btn-icon remove_medicine btn-red">--}}
                                            {{--                                                                <i class="ti-close"></i></button>--}}
                                            {{--                                                        </div>--}}
                                            {{--                                                    </th>--}}
                                            {{--                                                </tr>--}}
                                            {{--                                            @else--}}
                                            <tr class="row-medicine">
                                                <th>{{$medicine->name}}</th>
                                                <th>
                                                    {{number_format($medicine->pivot->amount??0,0,"",",")}}
                                                </th>
                                                <th>
                                                    {{\App\Entities\Unit::find($medicine->pivot->unit_id)->name??""}}
                                                </th>
                                                <th>
                                                    {{number_format($medicine->pivot->price??0,0,"",",")}}
                                                </th>
                                            </tr>
                                            {{--                                            @endif--}}
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                            <button type="submit" name="save_continue" hidden></button>
                            <button type="submit" name="save_close" hidden></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- ROW-1 CLOSED -->

@endsection

@section('js')
    <!-- FORMELEMENTS JS -->
    <script src="{{ URL::asset('assets/js/form-elements.js')}}"></script>
    <script src="{{ URL::asset('assets/plugins/bootstrap-daterangepicker/moment.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/date-picker/spectrum.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/date-picker/jquery-ui.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/time-picker/jquery.timepicker.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/time-picker/toggles.min.js') }}"></script>

    @if($export->status!=1)
        <script>
            $(document).ready(function () {
                $("body").on('keyup', "#add_medicine", function () {
                    let keyword = $(this).val();
                    let medicine_ids = [];
                    $(".medicine_id").each(function () {
                        medicine_ids.push($(this).val())
                    });
                    if (keyword === "") {
                        $(".search-result").hide();
                    } else {
                        {{--$.ajax({--}}
                        {{--    url: "{{route("admin.export_medicine.ajaxSearchMedicine")}}",--}}
                        {{--    method: "get",--}}
                        {{--    data: {--}}
                        {{--        keyword: keyword,--}}
                        {{--        medicine_ids: medicine_ids,--}}
                        {{--    },--}}
                        {{--    success: function (result) {--}}
                        {{--        $(".search-result").html(result);--}}
                        {{--        $(".search-result").show();--}}
                        {{--    }--}}
                        {{--})--}}
                    }

                });
                $("body").on('click', ".row-search", function () {
                    let medicine_id = $(this).data("medicine_id");
                    let selected = $(this).data("selected");
                    let id_selected = "|";
                    $(".row_sell").each(function () {
                        id_selected += $(this).data("id_selected") + "|";
                    });
                    $(this).data("selected", 1);
                    let that = $(this);
                    if (selected === 0) {
                        $.ajax({
                            {{--                            url: "{{route("admin.export_medicine.ajaxAddImportMedicine")}}",--}}
                            method: "get",
                            data: {
                                id: medicine_id,
                                price: true,
                                status_import: "{{$export->status}}"
                            },
                            success: function (result) {
                                $(".list_medicine").prepend(result);
                                that.hide();
                            }
                        });
                    }
                });
                $("body").on('click', ".remove_medicine", function () {
                    $(this).parents(".row-medicine").remove()
                });
            })
        </script>
    @endif
@endsection

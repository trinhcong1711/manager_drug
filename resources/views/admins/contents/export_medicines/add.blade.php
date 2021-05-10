@extends('admins.layouts.master')
@section('css')
    <!-- TABS STYLES -->
    <link href="{{URL::asset('assets/plugins/tabs/tabs.css')}}" rel="stylesheet"/>

    <!-- FILE UPLOADE CSS -->
    <link href="{{URL::asset('assets/plugins/fileuploads/css/fileupload.css')}}" rel="stylesheet" type="text/css"/>

    <!-- SELECT2 CSS -->
    <link href="{{URL::asset('assets/plugins/select2/select2.min.css')}}" rel="stylesheet"/>
    <style>
        .search {
            width: 100%;
            position: relative;
        }

        .search_medicine_result {
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
    <!-- PAGE-HEADER -->
    <div>
        <div class="btn-list">
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#add_invoice_back"><i class="fe fe-plus mr-2"></i>Tạo phiếu khách trả</button>
        </div>
    </div>
    <!-- PAGE-HEADER END -->
@endsection
@section('content')
    <div class="card">
        <div class="row">
            <form action="" method="post" class="d-flex">
                @csrf
                <div class="col-md-9">
                    <div class="card-header">
                        <h3 class="card-title">Thông tin đơn hàng</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group search">
                            <input type="text" class="form-control" id="search_medicine" name="search_medicine"
                                   placeholder="Tìm kiếm theo tên thuốc, mã vạch">
                            <div class="search_medicine_result"></div>
                        </div>
                        <div class="table-responsive" id="table_sell">
                            <table class="table card-table table-vcenter text-nowrap">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tên Thuốc</th>
                                    <th>S.Lượng</th>
                                    <th>Giá Bán / Đ.Vị Tính</th>
                                    <th>Thành Tiền</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody class="list_medicines">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card-header pl-0">
                        <h3 class="card-title">Hóa đơn</h3>
                    </div>
                    <div class="card-body pl-0">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="font-weight-bold">Người xuất:</label>
                                    <span class="staff_name badgetext  font-weight-bold mb-0">Trịnh Thị Nhàn</span>
                                </div>
                                <div class="form-group">
                                    <ul class="list-group">
                                        <li class="form-group">
                                            <span class="font-weight-bold">Người nhận:</span>
                                            <select name="member_id"
                                                    class="form-control"
                                                    data-placeholder="Chọn người nhận">
                                                <option value="1">Trịnh thị nguyên</option>
                                                <option value="1">Trịnh thị nguyên</option>
                                                <option value="1">Trịnh thị nguyên</option>
                                                <option value="1">Trịnh thị nguyên</option>
{{--                                                @if(count($units = $medicine->units)>0)--}}
{{--                                                    @foreach($units as $unit)--}}
{{--                                                        <option value="{{$unit->id}}">{{$unit->name}}</option>--}}
{{--                                                    @endforeach--}}
{{--                                                @endif--}}
                                            </select>
                                        </li>
                                        <li class="form-group">
                                            <span class="font-weight-bold">Loại đơn xuất:</span>
                                            <select name="type"
                                                    class="form-control"
                                                    data-placeholder="Chọn người nhận">
                                                <option value="1">Hệ thống</option>
                                                <option value="2">Trình dược</option>
                                                <option value="3">Chợ thuốc</option>
                                            </select>
                                        </li>
                                        <li class="form-group">
                                            <span class="font-weight-bold">Tổng tiền:</span>
                                            <span class="total_price_bill badgetext  font-weight-bold mb-0">0</span>
                                        </li>
                                        <li class="form-group">
                                            <div class="form-group mb-0">
                                                <label class="form-label">Ghi chú</label>
                                                <textarea class="form-control" name="note" rows="5"
                                                          placeholder="Nhập ghi chú..."></textarea>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6 text-left">
                                <button type="submit" class="btn btn-info">Xuất</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('js')
    <!--- TABS JS -->
    <script src="{{URL::asset('assets/plugins/tabs/jquery.multipurpose_tabcontent.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/tabs/tab-content.js')}}"></script>

    <!-- FILE UPLOADES JS -->
    <script src="{{URL::asset('assets/plugins/fileuploads/js/fileupload.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/fileuploads/js/file-upload.js')}}"></script>

    <!-- SELECT2 JS -->
    <script src="{{URL::asset('assets/plugins/select2/select2.full.min.js')}}"></script>

    <!-- FORMELEMENTS JS -->
    <script src="{{ URL::asset('assets/js/form-elements.js')}}"></script>
    <script src="{{ URL::asset('assets/plugins/bootstrap-daterangepicker/moment.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/date-picker/spectrum.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/date-picker/jquery-ui.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/time-picker/jquery.timepicker.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/time-picker/toggles.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/customs.js') }}"></script>
    <script>
        $(document).ready(function () {
            // let price_customer = $(".price_customer").val();
            $("#search_medicine").keyup(function () {
                let keyword = $(this).val();
                if (keyword === "") {
                    $(".search_medicine_result").hide();
                } else {
                    $.ajax({
                        url: "{{route("sell.ajax.ajaxSearchMedicine")}}",
                        method: "get",
                        data: {
                            keyword: keyword
                        },
                        success: function (result) {
                            $(".search_medicine_result").html(result);
                            $(".search_medicine_result").show();
                        }
                    })
                }

            });
            $("body").on('click', ".row-search", function () {
                let medicine_id = $(this).data("medicine_id");
                let selected = $(this).data("selected");
                let id_selected = "|";
                $(".row_sell").each(function () {
                    id_selected += $(this).data("id_selected") + "|";
                });
                let price_customer = $("#price_customer").val();
                $(this).data("selected", 1);
                let that = $(this);
                if (selected === 0) {
                    $.ajax({
                        url: "{{route("admin.export_medicine.ajaxAddExportMedicine")}}",
                        method: "get",
                        data: {
                            id: medicine_id,
                            id_selected: id_selected
                        },
                        success: function (result) {
                            $(".list_medicines").after(result);
                            let unit_prices = $(".units_select").first().find(':selected').data("unit_price");
                            let amounts = $(".amount_medicine").val();
                            let prices = unit_prices * amounts;
                            $(".total_price").first().text(formatPrice(prices));
                            $(".total_price_bill").text(formatPrice(totalPrice()));
                            // $(".refund_customer").text(formatPrice(totalPriceRefundCustomer(price_customer)));
                            that.hide();
                        }
                    });
                }
            });
            $("body").on('click', ".remove_medicine", function () {
                $(this).parents(".row_sell").remove();
                $(".total_price_bill").text(formatPrice(totalPrice()));
                // let price_customer = $("#price_customer").val();
                // $(".refund_customer").text(formatPrice(totalPriceRefundCustomer(price_customer)));
            });
            $(".price_customer").keyup(function () {
                let price_customer = $(this).val();
                $(this).val(formatPrice(price_customer));
                // $(".refund_customer").text(formatPrice(totalPriceRefundCustomer(price_customer)));
            });
        })
    </script>
@endsection

@extends('admins.layouts.master')
@section('css')
    <!-- TABS STYLES -->
    <link href="{{URL::asset('assets/plugins/tabs/tabs.css')}}" rel="stylesheet"/>

    <!-- FILE UPLOADE CSS -->
    <link href="{{URL::asset('assets/plugins/fileuploads/css/fileupload.css')}}" rel="stylesheet" type="text/css"/>

    <!-- SELECT2 CSS -->
    <link href="{{URL::asset('assets/plugins/select2/select2.min.css')}}" rel="stylesheet"/>
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
            {{--            <form action="" class="d-flex">--}}
            <div class="col-md-9">
                <div class="card-header">
                    <h3 class="card-title">Thông tin đơn hàng</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <input type="text" class="form-control" name="input"
                               placeholder="Tìm kiếm theo tên thuốc, mã vạch">
                    </div>

                    <div class="table-responsive">
                        <table class="table card-table table-vcenter text-nowrap">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Tên Thuốc</th>
                                <th>Hạn Sử Dụng</th>
                                <th>Đơn Vị Tính</th>
                                <th>S.Lượng</th>
                                <th>Giá Bán</th>
                                <th>Thành Tiền</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>
                                    <p class="title_product">Joan Powell </p>
                                    <span class="specification_product">3g x 10 hộp x 10 gói</span>
                                </td>
                                <td>15/06/2022</td>
                                <td>
                                    <select class="form-control select2 custom-select"
                                            data-placeholder="Chọn đơn vị tính">
                                        <option label="Chọn đơn vị tính">
                                        </option>
                                        <option value="1">Viên</option>
                                        <option value="2">Vỉ</option>
                                        <option value="3">Hộp</option>
                                        <option value="4">Gói</option>
                                        <option value="5">Lọ</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" class="price_customer border-0" name="input"
                                           placeholder="Nhập số lượng...">
                                </td>
                                <td>
                                    <input type="text" class="price_customer border-0" name="input"
                                           placeholder="Nhập giá bán...">
                                </td>
                                <td>100000</td>
                                <td>
                                    <i class="ti-close"></i>
                                </td>
                            </tr>
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
                                <label class="font-weight-bold">Người bán:</label>
                                <span class="staff_name badgetext  font-weight-bold mb-0">Trịnh Thị Nhàn</span>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Khách hàng:</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Nhập tên khách hàng...">
                                    <span class="input-group-append" data-toggle="tooltip"
                                          title="Thêm mới khách hàng">
                                        <button class="btn btn-primary box-shadow-customer" type="button"
                                                data-toggle="modal" data-target="#add_customer">
                                            <i class="ti-plus"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <ul class="list-group">
                                    <li class="form-group">
                                        <span class="font-weight-bold">Tổng tiền:</span>
                                        <span class="total_price badgetext  font-weight-bold mb-0">9.999.999</span>
                                    </li>
                                    <li class="form-group">
                                        <span class="font-weight-bold">Khách thanh toán:</span>
                                        <input type="text" placeholder="0.0"
                                               class="price_customer badgetext text-right border-0">
                                    </li>
                                    <li class="form-group">
                                        <span class="font-weight-bold">Trả lại:</span>
                                        <span class="badgetext  font-weight-bold mb-0">9.999.999</span>
                                    </li>
                                    <li class="form-group">
                                        <div class="form-group mb-0">
                                            <label class="form-label">Ghi chú</label>
                                            <textarea class="form-control" name="example-textarea-input" rows="4" placeholder="Nhập ghi chú.."></textarea>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6 text-left">
                            <button type="button" class="btn btn-info">Thanh toán</button>
                        </div>
                        <div class="col-md-6 text-right">
                            <button type="button" class="btn btn-primary">Thanh toán & in HĐ</button>
                        </div>

                    </div>


                </div>
            </div>
            {{--            </form>--}}
        </div>
    </div>

    <!-- ADD CUSTOMER MODAL -->
    <div class="modal fade" id="add_customer" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="example-Modal3">Thêm mới khách hàng</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="recipient-name" class="form-control-label">Recipient:</label>
                            <input type="text" class="form-control" id="recipient-name">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="form-control-label">Message:</label>
                            <textarea class="form-control" id="message-text"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Send message</button>
                </div>
            </div>
        </div>
    </div>
    <!-- MESSAGE MODAL CLOSED -->

    <!-- TẠO PHIẾU KHÁCH TRẢ -->
    <div class="modal fade" id="add_invoice_back" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="example-Modal3">Tạo phiếu khách trả</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="recipient-name" class="form-control-label">Recipient:</label>
                            <input type="text" class="form-control" id="recipient-name">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="form-control-label">Message:</label>
                            <textarea class="form-control" id="message-text"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Send message</button>
                </div>
            </div>
        </div>
    </div>
    <!-- TẠO PHIẾU KHÁCH TRẢ CLOSED -->
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
@endsection

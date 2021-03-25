@extends('admins.layouts.master')
@section('css')
    <!-- FILE UPLOADE CSS -->
    <link href="{{URL::asset('assets/plugins/fileuploads/css/fileupload.css')}}" rel="stylesheet" type="text/css"/>

    <!-- SELECT2 CSS -->
    <link href="{{URL::asset('assets/plugins/select2/select2.min.css')}}" rel="stylesheet"/>
@endsection
@section('page-header')
    <!-- PAGE-HEADER -->
    <div class="btn-list">

        <button type="button" class="btn btn-outline-default" data-toggle="tooltip"
                title="Quay về trang danh sách phiếu nhập">
            <a href="/nhap-hang"><i class="icon icon-action-undo mr-2"></i>Quay lại</a>
        </button>

        <button type="button" class="btn btn-outline-success" data-toggle="tooltip" title="Lưu và tiếp tục thêm mới"><i
                class="ti-save-alt mr-2"></i>Lưu và tiếp tục
        </button>
        <button type="button" class="btn btn-outline-success" data-toggle="tooltip"
                title="Lưu và quay về trang danh sách phiếu nhập"><i
                class="ti-save-alt mr-2"></i>Lưu và thoát
        </button>
    </div>
    <!-- PAGE-HEADER END -->
@endsection
@section('content')



    <!-- ROW-1 -->
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-header">
                        <h3 class="mb-0 card-title">Thêm phiếu nhập hàng</h3>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Tên phiếu nhập</label>
                                        <input type="text" class="form-control" name="name"
                                               placeholder="Nhập tên phiếu nhập">
                                    </div>
                                    <div class="form-group d-flex">
                                        <div class="col-md-6 pl-0">
                                            <label class="form-label">Ngày tạo phiếu</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                                    </div>
                                                </div>
                                                <input class="form-control fc-datepicker" name="import_date"
                                                       placeholder="MM/DD/YYYY"
                                                       type="text">
                                            </div>
                                        </div>
                                        <div class="col-md-6 pr-0">
                                            <label class="form-label">Ngày kiểm phiếu</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                                    </div>
                                                </div>
                                                <input class="form-control fc-datepicker" name="check_date"
                                                       placeholder="MM/DD/YYYY"
                                                       type="text">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Ghi chú</label>
                                        <textarea class="form-control" name="note" placeholder="Ghi chú"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <div class="form-label">Trạng thái</div>
                                        <label class="custom-switch">
                                            <input type="checkbox" name="status" class="custom-switch-input">
                                            <span class="custom-switch-indicator"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" name="save_continue" hidden></button>
                            <button type="submit" name="save_close" hidden></button>
                        </form>
                    </div>
                </div>
            </div>
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
@endsection

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
                title="Quay về trang danh sách thuốc">
            <a href="/thuoc" style="color: inherit;"><i class="icon icon-action-undo mr-2"></i>Quay lại</a>
        </button>
        <button type="button" class="btn btn-outline-success" data-toggle="tooltip" title="Lưu và tiếp tục sửa"><i
                class="ti-save-alt mr-2"></i>Lưu và tiếp tục
        </button>
        <button type="button" class="btn btn-outline-success" data-toggle="tooltip"
                title="Lưu và quay về trang danh sách thuốc"><i
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
                <div class="card-header">
                    <h3 class="mb-0 card-title">Chỉnh sửa thuốc</h3>
                </div>
                <div class="card-body">
                    <form action="" method="POST">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Tên thuốc</label>
                                    <input type="text" class="form-control" name="name" placeholder="Nhập tên thuốc" value="">
                                </div>
                                <div class="form-group d-flex">
                                    <div class="col-md-6 pl-0">
                                        <label class="form-label">Hạn sử dụng</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                                </div>
                                            </div>
                                            <input class="form-control fc-datepicker" name="exp"
                                                   placeholder="MM/DD/YYYY"
                                                   type="text" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-6 pr-0">
                                        <label class="form-label">Quy cách đóng gói</label>
                                        <input type="text" class="form-control" name="name" value="" placeholder="Nhập quy cách đóng gói">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group d-flex list_unit">
                                    <div class="col-md-5 pl-0">
                                        <label class="form-label">Đơn vị tính</label>
                                        <input type="text" class="form-control" name="name"
                                               placeholder="Nhập đơn vị tính">
                                    </div>
                                    <div class="col-md-5 pr-0">
                                        <label class="form-label">Giá bán</label>
                                        <input type="text" class="form-control" name="name" placeholder="Nhập giá bán">
                                    </div>
                                </div>
                                <div class="col-md-12 p-0" id="add_unit_parent">
                                    <button type="button" class="btn btn-secondary" id="add_unit" data-toggle="tooltip"
                                            title="Thêm mới đơn vị tính">
                                        <i class="ti-plus mr-2"></i> Thêm mới
                                    </button>
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
    <!-- ROW-1 CLOSED -->
@endsection

@section('js')
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
    <script>
        $(document).ready(function () {
            $("body").on('click', '#add_unit', function () {
                let html = '<div class="form-group d-flex list_unit">\n' +
                    '                                    <div class="col-md-5 pl-0">\n' +
                    '                                        <label class="form-label">Đơn vị tính</label>\n' +
                    '                                        <input type="text" class="form-control" name="name"\n' +
                    '                                               placeholder="Nhập đơn vị tính">\n' +
                    '                                    </div>\n' +
                    '                                    <div class="col-md-5 pr-0">\n' +
                    '                                        <label class="form-label">Giá bán</label>\n' +
                    '                                        <input type="text" class="form-control" name="name" placeholder="Nhập giá bán">\n' +
                    '                                    </div>\n' +
                    '                                    <div class="col-md-2 text-center">\n' +
                    '                                        <label class="form-label">Xóa</label>\n' +
                    '                                        <button type="button" class="btn btn-secondary delete_unit" data-toggle="tooltip"\n' +
                    '                                                title="Xóa">\n' +
                    '                                            <i class="ti-close"></i>\n' +
                    '                                        </button>\n' +
                    '                                    </div>\n' +
                    '                                </div>';
                $(this).parent("#add_unit_parent").before(html);
            });
            $("body").on('click', '.delete_unit', function () {
                $(this).parent().parent('.list_unit').remove();
            });
        })
    </script>
@endsection

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
                        <h3 class="mb-0 card-title">Tạo mới phiếu xuất</h3>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Tên phiếu xuất</label>
                                        <input type="text" class="form-control" name="name"
                                               placeholder="Nhập tên phiếu nhập">
                                    </div>
                                    <div class="form-group d-flex">
                                        <div class="col-md-6 pl-0">
                                                <label class="form-label"> Chọn phiếu nhập</label>
                                                <select class="form-control select2-show-search text-danger"
                                                        data-placeholder="Chọn khách hàng">
                                                    <option label="Chọn khách hàng"></option>
                                                    <option value="1">Arizona</option>
                                                    <option value="2">Colorado</option>
                                                    <option value="3">Idaho</option>
                                                    <option value="4">Montana</option>
                                                    <option value="5">Nebraska</option>
                                                    <option value="6">New Mexico</option>
                                                    <option value="7">North Dakota</option>
                                                    <option value="8">Utah</option>
                                                    <option value="9">Wyoming</option>
                                                </select>
                                        </div>
                                        <div class="col-md-6 pr-0">
                                            <label class="form-label"> Chọn khách hàng</label>
                                            <select class="form-control select2-show-search text-danger"
                                                    data-placeholder="Chọn khách hàng">
                                                <option label="Chọn khách hàng"></option>
                                                <option value="1">Arizona</option>
                                                <option value="2">Colorado</option>
                                                <option value="3">Idaho</option>
                                                <option value="4">Montana</option>
                                                <option value="5">Nebraska</option>
                                                <option value="6">New Mexico</option>
                                                <option value="7">North Dakota</option>
                                                <option value="8">Utah</option>
                                                <option value="9">Wyoming</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group text-right">
                                            <div class="form-label">Trạng thái</div>
                                            <label class="custom-switch">
                                                <input type="checkbox" name="status" class="custom-switch-input">
                                                <span class="custom-switch-indicator"></span>
                                            </label>
                                    </div>

                                    <div class="form-group">

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Ghi chú</label>
                                        <textarea class="form-control" name="note" rows="8" placeholder="Ghi chú"></textarea>
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

    <!-- Start Add medicine -->
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-header">
                        <h3 class="card-title">Danh sách thuốc</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table card-table table-vcenter text-nowrap">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>STT</th>
                                <th>Tên thuốc</th>
                                <th>Ghi chú</th>
                                <th>Số lượng</th>
                                <th>Đơn vị tính</th>
                                <th>Giá</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody>

                            <tr>
                                <td></td>
                                <td></td>
                                <td contenteditable="true"></td>
                                <td contenteditable="true"></td>
                                <td contenteditable="true"></td>
                                <td contenteditable="true"></td>
                                <td contenteditable="true"></td>
                                <td>
                                    <button type="button" class="btn btn-icon  btn-purple" data-toggle="tooltip"
                                            data-title="Lưu & Thêm mới"><i class="ti-plus"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">
                                    <label class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="example-checkbox1"
                                               value="option1" checked="">
                                        <span class="custom-control-label"></span>
                                    </label>
                                </th>
                                <td>1</td>
                                <td contenteditable="true">Panadol</td>
                                <td contenteditable="true">Không có thì lấy mẫu khác</td>
                                <td contenteditable="true">10</td>
                                <td contenteditable="true">vỉ</td>
                                <td contenteditable="true">10.000</td>
                                <td>
                                    <div class="btn-list">
                                        <button type="button" class="btn btn-icon  btn-gray" data-toggle="tooltip"
                                                data-title="Sửa & Lưu"><i class="ti-pencil-alt"></i></button>
                                        <button type="button" class="btn btn-icon  btn-red" data-toggle="tooltip"
                                                data-title="Xóa"><i class="ti-close"></i></button>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Add medicine -->
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
                    '                                        <button type="button" class="btn btn-secondary delete_unit">\n' +
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

@extends('admins.layouts.master')
@section('css')
    <!-- FILE UPLOADE CSS -->
    <link href="{{URL::asset('assets/plugins/fileuploads/css/fileupload.css')}}" rel="stylesheet" type="text/css"/>

    <!-- SELECT2 CSS -->
    <link href="{{URL::asset('assets/plugins/select2/select2.min.css')}}" rel="stylesheet"/>
@endsection
@section('content')
    <!-- ROW-1 -->
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <form action="" method="POST">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <div class="col-6 p-0">
                            <h3 class="mb-0 card-title">Thêm Mới Thuốc</h3>
                        </div>
                        <div class="col-6 p-0">
                            <div class="btn-list text-right">
                                <button type="button" class="btn btn-outline-default" data-toggle="tooltip"
                                        title="Quay về trang danh sách thuốc">
                                    <a href="{{route('admin.medicine.getIndex')}}" style="color: inherit;"><i
                                            class="icon icon-action-undo mr-2"></i>Quay lại</a>
                                </button>
                                <button type="submit" class="btn btn-primary" data-toggle="tooltip"
                                        title="Lưu và tiếp tục thêm mới"
                                        id="add_continue"><i
                                        class="ti-save-alt mr-2"></i>Lưu
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Tên thuốc</label>
                                    <input type="text" class="form-control" value="{{old('name')}}" name="name" placeholder="Nhập tên thuốc">
                                    @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group d-flex">
                                    <div class="col-md-4 pl-0">
                                        <label class="form-label">Số lượng</label>
                                        <input type="number" class="form-control" value="{{old('inventory')}}"
                                               name="inventory"
                                               placeholder="Nhập số lượng">
                                    </div>
                                    <div class="col-md-4 pl-0">
                                        <label class="form-label">Định mức tồn</label>
                                        <input type="number" class="form-control" value="{{old('rest')}}"
                                               name="rest"
                                               placeholder="Nhập định mức tồn">
                                    </div>
                                    <div class="col-md-4 pr-0">
                                        <label class="form-label">Quy cách đóng gói</label>
                                        <input type="text" class="form-control" value="{{old('package')}}"
                                               name="package"
                                               placeholder="Nhập quy cách đóng gói">
                                    </div>

{{--                                    <div class="col-md-4 pr-0">--}}
{{--                                        <label class="form-label">Hạn sử dụng</label>--}}
{{--                                        <div class="input-group">--}}
{{--                                            <div class="input-group-prepend">--}}
{{--                                                <div class="input-group-text">--}}
{{--                                                    <i class="fa fa-calendar tx-16 lh-0 op-6"></i>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <input class="form-control fc-datepicker" name="exp"--}}
{{--                                                   placeholder="MM/DD/YYYY"--}}
{{--                                                   value="{{old('exp')}}"--}}
{{--                                                   type="text">--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                </div>
                            </div>

                            <div class="col-md-12">
{{--                                <div class="form-group d-flex list_unit">--}}
{{--                                    <div class="col-md-3 pl-0">--}}
{{--                                        <label class="form-label">Đ/v tính</label>--}}
{{--                                        <input type="text" class="form-control" name="unit[]"--}}
{{--                                               placeholder="Nhập đ/v tính">--}}
{{--                                    </div>--}}
{{--                                    <div class="col-md-3 pl-0">--}}
{{--                                        <label class="form-label">Đ/v Q.đổi</label>--}}
{{--                                        <input type="number" class="form-control" name="convert[]"--}}
{{--                                               placeholder="Nhập đ/v Q.đổi">--}}
{{--                                    </div>--}}
{{--                                    <div class="col-md-4 pr-0">--}}
{{--                                        <label class="form-label">Giá bán</label>--}}
{{--                                        <input type="number" class="form-control" name="price[]"--}}
{{--                                               placeholder="Nhập giá bán">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                @error('unit')--}}
{{--                                <div class="col-md-12">--}}
{{--                                    <span class="text-danger">{{ $message }}</span>--}}
{{--                                </div>--}}
{{--                                @enderror--}}
                                <div class="col-md-12 pl-0" id="add_unit_parent">

                                    <button type="button" class="btn btn-primary" id="add_unit"
                                            title="Thêm mới đơn vị tính">
                                        <i class="ti-plus mr-2"></i> Thêm mới đ/vị tính
                                    </button>
                                </div>
                            </div>

                            <div class="col-md-12 text-center">
                                <div class="form-label">Trạng thái</div>
                                <label class="custom-switch">
                                    <input type="checkbox" name="status" class="custom-switch-input" checked>
                                    <span class="custom-switch-indicator"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
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
            $('body').on('click', '#add_unit', function () {
                let html = '<div class="form-group d-flex list_unit">\n' +
                    '<div class="col-md-3 pl-0">\n' +
                    '                                        <label class="form-label">Đơn vị tính</label>\n' +
                    '                                        <input type="text" class="form-control" name="unit[]"\n' +
                    '                                               placeholder="Nhập đ/v tính">\n' +
                    '                                    </div>\n' +
                    '                                    <div class="col-md-3 pl-0">\n' +
                    '                                        <label class="form-label">Đơn vị quy đổi</label>\n' +
                    '                                        <input type="number" class="form-control" name="convert[]"\n' +
                    '                                               placeholder="Nhập đ/v quy đổi">\n' +
                    '                                    </div>\n' +
                    '                                    <div class="col-md-4 pr-0">\n' +
                    '                                        <label class="form-label">Giá bán</label>\n' +
                    '                                        <input type="number" class="form-control" name="price[]"\n' +
                    '                                               placeholder="Nhập giá bán">\n' +
                    '                                    </div>' +
                    '                                    <div class="col-md-2 text-center">\n' +
                    '                                        <label class="form-label">Xóa</label>\n' +
                    '                                        <button type="button" class="btn btn-primary delete_unit">\n' +
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

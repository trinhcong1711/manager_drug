@extends('admins.layouts.master')
@section('css')
    <link href="{{asset('assets/plugins/fileuploads/css/fileupload.css')}}" rel="stylesheet" type="text/css"/>
@endsection
@section('page-header')
    <!-- PAGE-HEADER -->
    <div class="btn-list">
        <button type="button" class="btn btn-outline-secondary" data-toggle="tooltip" title="Thêm thuốc thủ công">
            <a href="{{route('admin.medicine.getAdd')}}" style="color: inherit;"><i class="fe fe-plus mr-2"></i>Thêm
                thuốc</a>
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
                    <div class="col-6 p-0">
                        <h3 class="mb-0 card-title">Danh sách Thuốc</h3>
                    </div>
                    <div class="col-6 p-0">
                        <div class="btn-list text-right">
                            <div class="btn-group mt-2 mb-2">
                                <button type="button" class="btn btn-info dropdown-toggle mr-2" data-toggle="dropdown">
                                    <i class="icon icon-rocket mr-2"></i>Excel
                                </button>
                                <div class="dropdown-menu ">

                                    <a class="dropdown-item border-bottom" href="{{route('admin.medicine.export')}}"><i
                                            class="ti-export mr-2"></i>Xuất excel</a>
                                    <form action="{{route('admin.medicine.import')}}" method="post"
                                          enctype="multipart/form-data" class="border-bottom">
                                        @csrf
                                        <div class="card-body text-center">
                                            <input type="file" name="import_file" class="dropify" data-height="100"/>
                                            <button type="submit" class="btn btn-primary mt-2"><i
                                                    class="ti-plus mr-2"></i> Nhập từ file excel
                                            </button>
                                        </div>
                                    </form>
                                    <a class="dropdown-item text-center"
                                       href="{{route('admin.medicine.exportDefaultFile')}}"><i
                                            class="ti-import mr-2"></i>Tải file mẫu</a>
                                </div>
                            </div>
                            <div class="btn-group mt-2 mb-2">
                                <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                                    <i class="fe fe-calendar mr-2"></i>Hành động
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" id="delete_selected" href="#">Xóa tất cả</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="medicine_datatable" class="table card-table table-vcenter text-nowrap">
                            <thead>
                            <tr>
                                <th scope="row">
                                    <label class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="select_all_row">
                                        <span class="custom-control-label"></span>
                                    </label>
                                </th>
                                <th>STT</th>
                                <th>Tên</th>
                                <th>Hàm lượng</th>
                                <th>HSD</th>
                                <th>Quy cách</th>
                                <th>Tồn kho</th>
                                <th>Đã bán</th>
                                <th>Giá nhập</th>
                                <th>Giá bán</th>
                                <th>Trạng thái</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <!-- table-responsive -->
            </div>
        </div>
    </div>
    <!-- ROW-1 CLOSED -->
@endsection
@section('js')
    <!-- FILE UPLOADES JS -->
    <script src="{{ asset('assets/plugins/fileuploads/js/fileupload.js')}}"></script>
    <script src="{{ asset('assets/plugins/fileuploads/js/file-upload.js')}}"></script>
    <script>
        $('body').ready(function () {
            //Selected all checkbox
            $('input[name=select_all_row]').click(function () {
                let status = $(this).is(":checked");
                if (status) {
                    $('.select_row').prop("checked", true);
                } else {
                    $('.select_row').prop("checked", false);
                }
            });
            //delete multil
            $('#delete_selected').click(function () {
                // let selected = $('.select_row').is('checked');
                let checkboxValues = [];
                $('input[name=select_row]:checked').each(function () {
                    checkboxValues.push($(this).val());
                });
                let ids = checkboxValues;
                if (!jQuery.isEmptyObject(ids)){
                    $.ajax({
                        url: "{{route('admin.medicine.getDeleteMultil')}}",
                        method: 'get',
                        data: {
                            ids: ids
                        },
                        success: function (result) {
                            if(result.status){
                                window.location.reload();
                            }
                        }
                    })
                }else {
                    alert('ádasd')
                }

            });
            //Datatable
            $('#medicine_datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('admin.medicine.data') }}',
                columns: [
                    {data: 'checkbox', name: 'checkbox', orderable: false, searchable: false},
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'amount', name: 'amount'},
                    {data: 'exp', name: 'exp'},
                    {data: 'package', name: 'package'},
                    {data: 'inventory', name: 'inventory'},
                    {data: 'sold', name: 'sold'},
                    {data: 'price_import', name: 'price_import'},
                    {data: 'price', name: 'price'},
                    {data: 'status', name: 'status'},
                ]
            });
        });
    </script>
@endsection

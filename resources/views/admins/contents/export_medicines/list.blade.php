@extends('admins.layouts.master')
@section('page-header')
    <!-- PAGE-HEADER -->
        <div class="btn-list">
            <button type="button" class="btn btn-outline-secondary" data-toggle="tooltip" title="Tạo mới phiếu xuất kho">
                <a href="{{route('admin.export_medicine.getAdd')}}"><i class="fe fe-plus mr-2"></i>Tạo phiếu xuất</a>
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
                    <h3 class="card-title">Danh sách phiếu xuất</h3>
                </div>
                <div class="table-responsive">
                    <table id="export_datatable" class="table card-table table-vcenter text-nowrap">
                        <thead>
                        <tr>
                            <th>STT</th>
                            <th>Người tạo</th>
                            <th>Người nhận</th>
                            <th>Ngày tạo phiếu</th>
                            <th>Tổng giá</th>
                            <th>Ghi chú</th>
                            <th>Loại</th>
                            <th>Trạng thái</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
                <!-- table-responsive -->
            </div>
        </div>
    </div>
    <!-- ROW-1 CLOSED -->
@endsection
@section('js')
    <script>
        $('body').ready(function () {
            //Datatable
            $('#export_datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('admin.export_medicine.data') }}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'user_id', name: 'user_id', orderable: false, searchable: false},
                    {data: 'member_id', name: 'member_id', orderable: false, searchable: false},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'total_money', name: 'total_money'},
                    {data: 'note', name: 'note', orderable: false, searchable: true},
                    {data: 'type', name: 'type', searchable: false},
                    {data: 'status', name: 'status', searchable: false},
                ],
            });
            {{--$("body").on('click', ".export_hd", function () {--}}
            {{--    let import_id = $(this).data("import_id");--}}
            {{--    let url_export = "{{route("admin.import_medicine.export")}}" + "?id=" + import_id;--}}
            {{--    window.location.href = url_export;--}}
            {{--});--}}
        });
    </script>
@endsection

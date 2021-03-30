@extends('admins.layouts.master')
@section('page-header')
    <!-- PAGE-HEADER -->
        <div class="btn-list">
{{--            <form action="{{route("admin.import_medicine.postAdd")}}" method="post">--}}
{{--                @csrf--}}
            <a href="{{route("admin.import_medicine.getAdd")}}">
                <button type="submit" class="btn btn-outline-secondary">
                    <i class="fe fe-plus mr-2"></i>Tạo phiếu nhập
                </button>
            </a>

{{--            </form>--}}
        </div>
    <!-- PAGE-HEADER END -->
@endsection
@section('content')
    <!-- ROW-1 -->
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Danh sách phiếu nhập</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="import_datatable" class="table card-table table-vcenter text-nowrap">
                            <thead>
                            <tr>
                                <th>STT</th>
                                <th>Người tạo</th>
                                <th>Ngày tạo phiếu</th>
                                <th>Ngày kiểm phiếu</th>
                                <th>Ghi chú</th>
                                <th>Tổng giá</th>
                                <th>Trạng thái</th>
                                <th>Tải về</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
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
    <script>
        $('body').ready(function () {
            //Datatable
            $('#import_datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('admin.import_medicine.data') }}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'user_id', name: 'user_id', orderable: false, searchable: false},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'checked_at', name: 'checked_at'},
                    {data: 'note', name: 'note', orderable: false, searchable: false},
                    {data: 'price', name: 'price', orderable: false, searchable: false},
                    {data: 'status', name: 'status'},
                    {data: 'export', name: 'export', orderable: false, searchable: false},
                ],
            });
            $("body").on('click', ".export_hd", function () {
                let import_id = $(this).data("import_id");
                let url_export = "{{route("admin.import_medicine.export")}}" + "?id=" + import_id;
                window.location.href = url_export;
            });
        });
    </script>
@endsection

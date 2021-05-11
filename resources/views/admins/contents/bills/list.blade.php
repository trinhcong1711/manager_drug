@extends('admins.layouts.master')
@section('page-header')
    <!-- PAGE-HEADER -->
    <div class="btn-list">
        <button type="button" class="btn btn-outline-secondary" data-toggle="tooltip" title="Tạo mới hóa đơn">
            <a href="/hoa-don/them"><i class="fe fe-plus mr-2"></i>Tạo mới</a>
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
                    <h3 class="card-title">Danh sách hóa đơn</h3>
                </div>
                <div class="card-body table-responsive">
                    <table id="bill_datatable" class="table card-table table-vcenter text-nowrap">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nhân viên</th>
                            <th>Khách hàng</th>
                            <th>Thời gian</th>
                            <th>Tổng tiền</th>
                            <th>Ghi chú</th>
                        </tr>
                        </thead>
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
            $('#bill_datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('admin.bill.data') }}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'user_id', name: 'user_id'},
                    {data: 'member_id', name: 'member_id'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'total', name: 'total'},
                    {data: 'note', name: 'note'},
                ],

            });
        });
    </script>
@endsection

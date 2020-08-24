@extends('admins.layouts.master')
@section('page-header')
    <!-- PAGE-HEADER -->
    <div class="btn-list">
        <button type="button" class="btn btn-outline-secondary" data-toggle="tooltip" title="Thêm thuốc thủ công">
            <a href="{{route('admin.medicine.getAdd')}}" style="color: inherit;"><i class="fe fe-plus mr-2"></i>Thêm thuốc</a>
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
                    <h3 class="card-title">Danh sách Thuốc</h3>
                </div>
                <div class="table-responsive">
                    <table id="medicine_datatable" class="table card-table table-vcenter text-nowrap">
                        <thead>
                        <tr>
                            <th>#</th>
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
                <!-- table-responsive -->
            </div>
        </div>
    </div>
    <!-- ROW-1 CLOSED -->
@endsection
@section('js'))
<script>
    $('body').ready(function() {
        $('#medicine_datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('admin.medicine.data') }}',
            columns: [
                { data: 'checkbox', name: 'checkbox', orderable: false, searchable: false },
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'amount', name: 'amount' },
                { data: 'exp', name: 'exp' },
                { data: 'package', name: 'package' },
                { data: 'inventory', name: 'inventory' },
                { data: 'sold', name: 'sold' },
                { data: 'price_import', name: 'price_import' },
                { data: 'price', name: 'price' },
                { data: 'status', name: 'status' },
            ]
        });
    });
</script>
@endsection

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
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Thông tin đơn hàng</h3>
                </div>
                <div class="card-body table-responsive">
                    <div class="row mb-5">
                        <div class="col-md-12 col-lg-12">
                            <table>
                                <tbody>
                                <tr>
                                    <th style="padding: 5px">Nhân viên:</th>
                                    <th style="padding: 5px">{{$refund->user->name??"Không rõ"}}</th>
                                </tr>
                                <tr>
                                    <th style="padding: 5px">Khách hàng:</th>
                                    <th style="padding: 5px">{{$refund->member->name??"Không rõ"}}</th>
                                </tr>
                                <tr>
                                    <th style="padding: 5px">Ngày bán:</th>
                                    <th style="padding: 5px">{{$refund->created_at->format('d/m/Y - H:i:s')}}</th>
                                </tr>
                                <tr>
                                    <th style="padding: 5px">Tổng tiền:</th>
                                    <th style="padding: 5px">{{number_format($refund->total,0,'',',')}}</th>
                                </tr>
                                <tr>
                                    <th style="padding: 5px">Ghi chú:</th>
                                    <th style="padding: 5px">{{$refund->note}}</th>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <table id="bill_medicine_datatable" class="table card-table table-vcenter text-nowrap">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tên</th>
                                    <th>Số lượng</th>
                                    <th>Đơn vị tính</th>
                                    <th>Đơn giá</th>
                                    <th>Tổng tiền</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
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
            $('#bill_medicine_datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('admin.bill_detail.dataDetail',$refund->id) }}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'amount', name: 'amount'},
                    {data: 'unit_id', name: 'unit_id'},
                    {data: 'price', name: 'price'},
                    {data: 'total_price', name: 'total_price'},
                ],

            });
        });
    </script>
@endsection

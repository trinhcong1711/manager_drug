@extends('admins.layouts.master')
@section('css')
    <link href="{{URL::asset('assets/plugins/fileuploads/css/fileupload.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{URL::asset('assets/plugins/select2/select2.min.css')}}" rel="stylesheet"/>
@endsection
@section('content')
    <!-- ROW-1 -->
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="col-6 p-0">
                        <h3 class="mb-0 card-title">Thông tin đơn hàng</h3>
                    </div>
                    <div class="col-6 p-0">
                        <div class="btn-list text-right">
                            <div class="btn-group mt-2 mb-2">
                                <button type="button" class="btn btn-info" id="add_refund">
                                    <i class="icon icon-action-undo mr-2"></i>Trả lại thuốc
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <div class="row mb-5">
                        <div class="col-md-12 col-lg-12">
                            <table>
                                <tbody>
                                <tr>
                                    <th style="padding: 5px">Nhân viên:</th>
                                    <th style="padding: 5px">{{$bill->user->name??"Không rõ"}}</th>
                                </tr>
                                <tr>
                                    <th style="padding: 5px">Khách hàng:</th>
                                    <th style="padding: 5px">{{$bill->member->name??"Không rõ"}}</th>
                                </tr>
                                <tr>
                                    <th style="padding: 5px">Ngày bán:</th>
                                    <th style="padding: 5px">{{$bill->created_at->format('d/m/Y - H:i:s')}}</th>
                                </tr>
                                <tr>
                                    <th style="padding: 5px">Tổng tiền:</th>
                                    <th style="padding: 5px">{{number_format($bill->total,0,'',',')}}</th>
                                </tr>
                                <tr>
                                    <th style="padding: 5px">Ghi chú:</th>
                                    <th style="padding: 5px">{{$bill->note}}</th>
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
                                    <th scope="row">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="select_all_row">
                                            <span class="custom-control-label"></span>
                                        </label>
                                    </th>
                                    <th>ID</th>
                                    <th>Tên</th>
                                    <th>Số lượng</th>
                                    <th>Đơn vị tính</th>
                                    <th>Đơn giá</th>
                                    <th>Tổng tiền</th>
                                    <th>Trạng thái</th>
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
            //Selected all checkbox
            $('input[name=select_all_row]').click(function () {
                let status = $(this).is(":checked");
                if (status) {
                    $('.select_row').prop("checked", true);
                } else {
                    $('.select_row').prop("checked", false);
                }
            });
            //add refund
            $('#add_refund').click(function () {
                let medicine_ids = [];
                $('input[name=select_row]:checked').each(function () {
                    medicine_ids.push($(this).val());
                });
                if (!jQuery.isEmptyObject(medicine_ids)) {
                    Swal.fire({
                        title: 'Bạn có chắc chắn muốn tạo đơn?',
                        type: 'warning',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        cancelButtonText: 'Hủy',
                        confirmButtonText: 'Xác nhận'
                    }).then((result) => {
                        if (result.value) {
                            $.ajax({
                                url: "{{route('admin.refund.postAdd', $bill->id)}}",
                                method: 'post',
                                data: {
                                    _token: "{{csrf_token()}}",
                                    medicine_ids: medicine_ids
                                },
                                success: function (data) {
                                    if (data.status) {
                                        swal.fire({
                                            title: data.message,
                                            type: "success",
                                            icon: 'success',
                                            timer: 1500
                                        }).then(function () {
                                            location.reload();
                                        });
                                    } else {
                                        swal.fire({
                                            title: 'Lỗi...',
                                            type: 'error',
                                            timer: '1500'
                                        })
                                    }
                                }
                            });
                        }
                    });
                } else {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Warning',
                        text: 'Bạn chưa chọn bản ghi nào !!!',
                    })
                }
            });

            //Datatable
            $('#bill_medicine_datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('admin.bill_detail.dataDetail',$bill->id) }}',
                columns: [
                    {data: 'checkbox', name: 'checkbox', orderable: false, searchable: false},
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'amount', name: 'amount'},
                    {data: 'unit_id', name: 'unit_id'},
                    {data: 'price', name: 'price'},
                    {data: 'total_price', name: 'total_price'},
                    {data: 'status', name: 'status'},
                ],

            });
        });
    </script>
@endsection

@extends('admins.layouts.master')

@section('page-header')
    <!-- PAGE-HEADER -->
    <div class="btn-list">
        <a class="mr-2" href="{{route('admin.user.getAdd')}}" style="color: inherit;">
            <button type="button" class="btn btn-outline-secondary" data-toggle="tooltip" title="Thêm thuốc bằng excel">
                <i class="fe fe-plus mr-2"></i>Thêm mới
            </button>
        </a>
    </div>
    <!-- PAGE-HEADER END -->
@endsection
@section('content')
    <!-- ROW-1 -->
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Danh sách nhân viên</h3>
                </div>
                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap" id="user_table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>STT</th>
                            <th>Họ & tên</th>
                            <th>Số điện thoại</th>
                            <th>Email</th>
                            <th>Quyền</th>
                            <th>Ngày tạo</th>
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

                if (!jQuery.isEmptyObject(ids)) {
                    Swal.fire({
                        title: 'Bạn có muốn xóa không?',
                        type: 'warning',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Xóa'
                    }).then((result) => {
                        if (result.value) {
                            $.ajax({
                                url: "{{route('admin.user.getDeleteMultil')}}",
                                method: 'get',
                                data: {
                                    ids: ids
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
            $('#user_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('admin.user.data') }}',
                columns: [
                    {data: 'checkbox', name: 'checkbox', orderable: false, searchable: false},
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'phone', name: 'phone'},
                    {data: 'email', name: 'email'},
                    {data: 'role', name: 'role'},
                    {data: 'created_at', name: 'created_at'},
                ],

            });
        });
    </script>
@endsection

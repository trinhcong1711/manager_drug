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
                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nhân viên</th>
                            <th>Khách hàng</th>
                            <th>Ngày bán</th>
                            <th>Tổng tiền</th>
                            <th>Ghi chú</th>
                        </tr>
                        </thead>
                        <tbody>

                        <tr>
                            <th scope="row">
                                <label class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="example-checkbox1"
                                           value="option1" checked="">
                                    <span class="custom-control-label"></span>
                                </label>
                            </th>
                            <td data-toggle="modal" data-target="#show_invoice_back">1</td>
                            <td data-toggle="modal" data-target="#show_invoice_back">HD001</td>
                            <td data-toggle="modal" data-target="#show_invoice_back">Trịnh Thị Nhàn</td>
                            <td data-toggle="modal" data-target="#show_invoice_back">Trịnh Thị Nhàn</td>
                            <td data-toggle="modal" data-target="#show_invoice_back">19/09/2020</td>
                            <td data-toggle="modal" data-target="#show_invoice_back">100.000</td>
                            <td data-toggle="modal" data-target="#show_invoice_back">Nợ 50K</td>
                            <td data-toggle="modal" data-target="#show_invoice_back">Bán hàng / Khách trả lại</td>
                            <td data-toggle="modal" data-target="#show_invoice_back">Chưa thanh toán/Hoàn tất</td>
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
                            <td>HD001</td>
                            <td>Trịnh Thị Nhàn</td>
                            <td>Trịnh Thị Nhàn</td>
                            <td>19/09/2020</td>
                            <td>100.000</td>
                            <td>Nợ 50K</td>
                            <td>Bán hàng / Khách trả lại</td>
                            <td>Chưa thanh toán/Hoàn tất</td>
                        </tr>

                        </tbody>
                    </table>
                </div>
                <!-- table-responsive -->
            </div>
        </div>
    </div>
    <!-- ROW-1 CLOSED -->




    <!-- TẠO PHIẾU KHÁCH TRẢ -->
    <div class="modal fade" id="show_invoice_back" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="example-Modal3">Khách trả lại</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table card-table table-vcenter text-nowrap">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>STT</th>
                                <th>Mã HĐ</th>
                                <th>Khách hàng</th>
                                <th>Nhân viên</th>
                                <th>Ngày trả lại</th>
                                <th>Trả lại</th>
                                <th>Ghi chú</th>
                                <th>Trạng thái</th>
                            </tr>
                            </thead>
                            <tbody>

                            <tr>
                                <th scope="row">
                                    <label class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="example-checkbox1"
                                               value="option1" checked="">
                                        <span class="custom-control-label"></span>
                                    </label>
                                </th>
                                <td data-toggle="modal" data-target="#show_invoice_back">1</td>
                                <td data-toggle="modal" data-target="#show_invoice_back">HD001</td>
                                <td data-toggle="modal" data-target="#show_invoice_back">Trịnh Thị Nhàn</td>
                                <td data-toggle="modal" data-target="#show_invoice_back">Trịnh Thị Nhàn</td>
                                <td data-toggle="modal" data-target="#show_invoice_back">19/09/2020</td>
                                <td data-toggle="modal" data-target="#show_invoice_back">100.000</td>
                                <td data-toggle="modal" data-target="#show_invoice_back">Nợ 50K</td>
                                <td data-toggle="modal" data-target="#show_invoice_back">Chưa thanh toán/Hoàn tất</td>
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
                                <td>HD001</td>
                                <td>Trịnh Thị Nhàn</td>
                                <td>Trịnh Thị Nhàn</td>
                                <td>19/09/2020</td>
                                <td>100.000</td>
                                <td>Nợ 50K</td>
                                <td>Chưa thanh toán/Hoàn tất</td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Tạo mới</button>
                </div>
            </div>
        </div>
    </div>
    <!-- TẠO PHIẾU KHÁCH TRẢ CLOSED -->
@endsection

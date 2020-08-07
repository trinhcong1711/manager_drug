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
                            <th>#</th>
                            <th>STT</th>
                            <th>Mã HĐ</th>
                            <th>Khách hàng</th>
                            <th>Người bán</th>
                            <th>Ngày bán</th>
                            <th>Tổng tiền</th>
                            <th>Ghi chú</th>
                            <th>Loại</th>
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
                            <td>1</td>
                            <td>HD001</td>
                            <td>
                                <div class="item_name">
                                    <a href="#0">Trịnh Thị Nhàn</a>
                                    <span class="tool_tip_item_name">
                                        <a href="/hoa-don/1">Sửa</a>
                                        <a href="#2">Xóa</a>
                                    </span>
                                </div>
                            </td>
                            <td>Trịnh Thị Nhàn</td>
                            <td>19/09/2020</td>
                            <td>100.000</td>
                            <td>Nợ 50K</td>
                            <td>Bán hàng / Khách trả lại/ Trả lại thuốc</td>
                            <td>Chưa thanh toán/Hoàn tất</td>
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
                            <td>
                                <div class="item_name">
                                    <a href="#0">Trịnh Thị Nhàn</a>
                                    <span class="tool_tip_item_name">
                                        <a href="/hoa-don/1">Sửa</a>
                                        <a href="#2">Xóa</a>
                                    </span>
                                </div>
                            </td>
                            <td>Trịnh Thị Nhàn</td>
                            <td>19/09/2020</td>
                            <td>100.000</td>
                            <td>Nợ 50K</td>
                            <td>Bán hàng / Khách trả lại/ Trả lại thuốc</td>
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
@endsection

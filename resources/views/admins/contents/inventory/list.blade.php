@extends('admins.layouts.master')

@section('page-header')
    <!-- PAGE-HEADER -->
    <div class="btn-list">
        <a href="/kiem-kho/them">
            <button type="button" class="btn btn-outline-secondary" data-toggle="tooltip" title="Thêm thuốc bằng excel">
                <i class="fe fe-plus mr-2"></i>Tạo phiếu kiểm kho

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
                    <h3 class="card-title">Danh sách phiếu kiểm kho</h3>
                </div>
                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>STT</th>
                            <th>Người tạo</th>
                            <th>Ngày tạo</th>
                            <th>Tổng thuốc</th>
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
                            <td>1</td>
                            <td>
                                <div class="item_name">
                                    <a href="#0">Trịnh Thị Nhàn</a>
                                    <span class="tool_tip_item_name">
                                        <a href="/kiem-kho/1">Sửa</a>
                                        <a href="#2">Xóa</a>
                                    </span>
                                </div>
                            </td>
                            <td>19/09/2020</td>
                            <td>1500</td>
                            <td>Ghi chú</td>
                            <td>Hoàn tất/Đang đối sánh</td>
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
                            <td>
                                <div class="item_name">
                                    <a href="#0">Trịnh Thị Nhàn</a>
                                    <span class="tool_tip_item_name">
                                        <a href="/kiem-kho/2">Sửa</a>
                                        <a href="#2">Xóa</a>
                                    </span>
                                </div>
                            </td>
                            <td>19/09/2020</td>
                            <td>1500</td>
                            <td>Ghi chú</td>
                            <td>Hoàn tất/Đang đối sánh</td>
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

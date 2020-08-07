@extends('admins.layouts.master')
@section('page-header')
    <!-- PAGE-HEADER -->
    <div class="btn-list">
        <button type="button" class="btn btn-outline-secondary" data-toggle="tooltip" title="Thêm thuốc thủ công">
            <a href="/thuoc/them" style="color: inherit;"><i class="fe fe-plus mr-2"></i>Thêm thuốc</a>
        </button>
        <button type="button" class="btn btn-outline-secondary" data-toggle="tooltip" title="Thêm thuốc bằng mã vạch"><i
                class="fa fa-barcode"></i>
        </button>
        <button type="button" class="btn btn-outline-secondary" data-toggle="tooltip" title="Thêm thuốc bằng excel">
            <i class="fa fa-file-excel-o"></i>
        </button>
        <button type="button" class="btn btn-outline-secondary" data-toggle="tooltip" title="Tạo phiếu nhập theo bộ lọc">
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
                    <table class="table card-table table-vcenter text-nowrap">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>STT</th>
                            <th>Tên</th>
                            <th>Hàm lượng</th>
                            <th>HSD</th>
                            <th>Quy cách</th>
                            <th>Tồn</th>
                            <th>Giá nhập</th>
                            <th>Giá bán</th>
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
                                    <a href="#0">Panadol</a>
                                    <span class="tool_tip_item_name">
                                        <a href="/thuoc/1">Sửa</a>
                                        <a href="#2">Xóa</a>
                                    </span>
                                </div>
                            </td>
                            <td>500mg</td>
                            <td>19/09/2020</td>
                            <td>10 viên x 3 vỉ x 1 hộp</td>
                            <td>100 viên |30 vỉ | 10 hộp</td>
                            <td>500</td>
                            <td>
                                <table>
                                    <tr>
                                        <td class="border-top-0 p-0 pr-1">Viên:</td>
                                        <td class="border-top-0 p-0">1.000</td>
                                    </tr>
                                    <tr>
                                        <td class="border-top-0 p-0 pr-1">Vỉ:</td>
                                        <td class="border-top-0 p-0">5.000</td>
                                    </tr>
                                    <tr>
                                        <td class="border-top-0 p-0 pr-1">Hộp:</td>
                                        <td class="border-top-0 p-0">10.000</td>
                                    </tr>
                                </table>
                            </td>
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
                                    <a href="#0">Panadol</a>
                                    <span class="tool_tip_item_name">
                                        <a href="/thuoc/1">Sửa</a>
                                        <a href="#2">Xóa</a>
                                    </span>
                                </div>
                            </td>
                            <td>500mg</td>
                            <td>19/09/2020</td>
                            <td>10 viên x 3 vỉ x 1 hộp</td>
                            <td>100 viên |30 vỉ | 10 hộp</td>
                            <td>500</td>
                            <td>
                                <table>
                                    <tr>
                                        <td class="border-top-0 p-0 pr-1">Viên:</td>
                                        <td class="border-top-0 p-0">1.000</td>
                                    </tr>
                                    <tr>
                                        <td class="border-top-0 p-0 pr-1">Vỉ:</td>
                                        <td class="border-top-0 p-0">5.000</td>
                                    </tr>
                                    <tr>
                                        <td class="border-top-0 p-0 pr-1">Hộp:</td>
                                        <td class="border-top-0 p-0">10.000</td>
                                    </tr>
                                </table>
                            </td>
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

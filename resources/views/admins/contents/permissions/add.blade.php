@extends('admins.layouts.master')
@section('content')
    <!-- ROW-1 -->
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <form action="" method="POST">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <div class="col-6 p-0">
                            <h3 class="mb-0 card-title">Thêm Mới Quyền</h3>
                        </div>
                        <div class="col-6 p-0">
                            <div class="btn-list text-right">
                                <button type="button" class="btn btn-outline-default" data-toggle="tooltip"
                                        title="Quay về trang danh sách thuốc">
                                    <a href="{{route('admin.permission.getIndex')}}" style="color: inherit;"><i
                                            class="icon icon-action-undo mr-2"></i>Quay lại</a>
                                </button>
                                <button type="submit" class="btn btn-primary" data-toggle="tooltip"
                                        title="Lưu và tiếp tục thêm mới"
                                        id="add_continue"><i
                                        class="ti-save-alt mr-2"></i>Lưu
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Tên quyền</label>
                                    <input type="text" class="form-control" value="{{old('name')}}" name="name" placeholder="Nhập tên quyền">
                                    @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- ROW-1 CLOSED -->
@endsection
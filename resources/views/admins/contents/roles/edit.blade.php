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
                            <h3 class="mb-0 card-title">Chỉnh sửa nhóm quyền</h3>
                        </div>
                        <div class="col-6 p-0">
                            <div class="btn-list text-right">
                                <button type="button" class="btn btn-outline-default">
                                    <a href="{{route('admin.role.getIndex')}}" style="color: inherit;"><i
                                            class="icon icon-action-undo mr-2"></i>Quay lại</a>
                                </button>
                                <button type="submit" class="btn btn-primary"><i
                                        class="ti-save-alt mr-2"></i>Lưu
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Tên nhóm quyền</label>
                                    <input type="text" class="form-control" value="{{$role->name}}" name="name"
                                           placeholder="Nhập tên nhóm quyền">
                                    @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group form-elements m-0">
                                    <div class="form-label">Chọn quyền</div>
                                    <div class="custom-controls-stacked">
                                        @foreach($permissions as $id=>$name)
                                            <label class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input"
                                                       name="permission_ids[]" {{ in_array($id, $permission)?"checked":"" }} value="{{$id}}">
                                                <span class="custom-control-label">{{$name}}</span>
                                            </label>
                                        @endforeach
                                    </div>
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

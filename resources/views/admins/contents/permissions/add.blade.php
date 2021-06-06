@extends('admins.layouts.master')
@section('css')
    <link href="{{URL::asset('assets/plugins/select2/select2.min.css')}}" rel="stylesheet"/>
@endsection
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
                                    <input type="text" class="form-control" value="{{old('name')}}" name="name"
                                           placeholder="Nhập tên quyền">
                                    @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                @if(count($roles)>0)
                                    <div class="form-group form-elements">
                                        <div class="form-label">Nhóm quyền</div>
                                        <div class="custom-controls-stacked">
                                            @foreach($roles as $id=>$role)
                                                <label class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input"
                                                           name="role_id[]" value="{{$id}}">
                                                    <span class="custom-control-label">{{$role}}</span>
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- ROW-1 CLOSED -->
@endsection
@section('js')
    <script src="{{URL::asset('assets/plugins/select2/select2.full.min.js')}}"></script>
@endsection

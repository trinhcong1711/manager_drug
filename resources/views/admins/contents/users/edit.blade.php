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
                            <h3 class="mb-0 card-title">Chỉnh sửa thành viên: {{$user->name}}</h3>
                        </div>
                        <div class="col-6 p-0">
                            <div class="btn-list text-right">
                                <button type="button" class="btn btn-outline-default">
                                    <a href="{{route('admin.user.getIndex')}}" style="color: inherit;"><i
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
                                    <label class="form-label">Tên thành viên</label>
                                    <input type="text" class="form-control" value="{{old('name')?:$user->name}}" name="name"
                                           placeholder="Nhập tên thành viên">
                                    @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Số điện thoại</label>
                                    <input type="text" class="form-control" value="{{old('phone')?:$user->phone}}" name="phone"
                                           placeholder="Nhập số điện thoại">
                                    @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Email</label>
                                    <input type="text" class="form-control" value="{{old('email')?:$user->email}}" name="email"
                                           placeholder="Nhập email">
                                    @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password" class="form-label">{{ "Mật khẩu" }}</label>

                                    <input id="password" type="password"
                                           class="form-control @error('password') is-invalid @enderror" name="password"
                                           autocomplete="new-password" placeholder="Mật khẩu">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password-confirm"
                                           class="form-label">{{ "Nhập lại mật khẩu" }}</label>

                                    <input id="password-confirm" type="password" class="form-control"
                                           name="password_confirmation" autocomplete="new-password"
                                           placeholder="Nhập lại mật khẩu">

                                </div>
                                <div class="form-group form-elements m-0">
                                    <div class="form-label">Chọn quyền</div>
                                    <div class="custom-controls-stacked">
                                        <select name="role_name" class="form-control custom-select">
                                            @foreach($roles as $role)
                                                <option
                                                    {{$user->roles->first()->name == $role->name ?"selected":""}} value="{{$role->name}}">{{$role->name}}</option>
                                            @endforeach
                                        </select>
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

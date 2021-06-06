<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\CURD\CURDController;
use App\Http\Requests\AddUserRequest;
use App\Http\Requests\EditUserRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class UserController extends CURDController
{
    protected function getIndex()
    {
        return view('admins.contents.users.list');
    }

    protected function data()
    {
        $user = User::select('*');
        return Datatables::of($user)
            ->addColumn('checkbox', function ($user) {
                return $this->checkboxMulti($user);
            })
            ->addColumn('role', function ($user) {
                return $user->getRoleNames()->first();
            })->editColumn('name', function ($user) {
                return $this->actionCurd($user, 'admin.user.getEdit', 'admin.user.getDelete');
            })->editColumn('created_at', function ($user) {
                return $user->created_at->format('d/m/Y');
            })->rawColumns(['checkbox', 'name'])->make(true);
    }

    protected function getAdd()
    {
        $data = [];
        $roles = Auth::user()->parent->list_roles_store;
        if (count($roles) > 0) {
            $data['roles'] = $roles;
        }

        return view('admins.contents.users.add', $data);
    }

    protected function postAdd(AddUserRequest $request)
    {
        $store = Auth::user();
        $parent_id = $store->parent_id;
        $data_user = array_merge($request->only('name', 'email', 'phone'), ['parent_id' => $parent_id, 'password' => Hash::make($request->get('password'))]);
        $user = User::create($data_user);
        if ($user) {
            $user->assignRole($request->get('role_name'));
            Alert::success('Thêm mới thành công!');
            return redirect(route('admin.user.getIndex'));
        }
        Alert::error('Lỗi', 'Có lỗi xảy ra!');
        return redirect()->back();
    }

    protected function getEdit($id)
    {
        $user = User::find($id);
        if (is_object($user)) {
            $data['user'] = $user;
            $roles = Auth::user()->parent->list_roles_store;
            if (count($roles) > 0) {
                $data['roles'] = $roles;
            }
            return view('admins.contents.users.edit', $data);
        }
        return redirect(route('admin.users.getIndex'));
    }

    protected function postEdit($id, EditUserRequest $request)
    {
        $user = User::find($id);
        if (is_object($user)) {
            if (empty($request->get('password'))){
                $data_user = $request->only('name', 'email', 'phone');
            }else{
                $data_user = array_merge($request->only('name', 'email', 'phone'), ['password' => Hash::make($request->get('password'))]);
            }
            $update = $user->update($data_user);
            if ($update) {
                    $user->syncRoles($request->get('role_name'));
                    Alert::success('Cập nhật thành công!');
                    return redirect(route('admin.user.getIndex'));
            }
        }
        Alert::error('Lỗi', 'Có lỗi xảy ra!');
        return redirect()->back();

    }

    protected function getDelete($id)
    {
        $delete = User::destroy([$id]);
        if ($delete) {
            Alert::success('Xóa thành công!');
            return redirect(route('admin.user.getIndex'));
        }

        Alert::error('Lỗi', 'Có lỗi xảy ra!');
        return redirect()->back();
    }

    public function getDeleteMultil(Request $request)
    {
        if (!empty($request->ids)) {
            $delete = User::whereIn('id', $request->ids)->delete();
            if ($delete) {
                return response()->json([
                    'status' => true,
                    'message' => 'Xóa thành công!!!',
                ]);
            }
            return response()->json([
                'status' => false,
                'message' => 'Có lỗi xảy ra! Vui lòng liên hệ tới kỹ thuật viên!',
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => 'Không có bản ghi nào được chọn!',
        ]);
    }

}

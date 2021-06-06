<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\CURD\CURDController;
use App\Http\Requests\AddPermissionRequest;
use App\Http\Requests\EditPermissionRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class PermissionController extends CURDController
{
    public function __construct()
    {

    }

    protected function getIndex()
    {
        return view('admins.contents.permissions.list');
    }

    protected function data()
    {
        $permission = Permission::select('*')->where('user_id',Auth::user()->parent_id)->orderBy('id','desc');
        return Datatables::of($permission)
            ->addColumn('checkbox', function ($permission) {
                return $this->checkboxMulti($permission);
            })->editColumn('name', function ($permission) {
                return $this->actionCurd($permission, 'admin.permission.getEdit', 'admin.permission.getDelete');
            })->rawColumns(['checkbox', 'name'])->make(true);
    }

    protected function getAdd()
    {
        $user_id = Auth::user()->parent_id;
        $data['roles'] = Role::where('user_id',$user_id)->pluck('name','id');
        return view('admins.contents.permissions.add',$data);
    }

    protected function postAdd(AddPermissionRequest $request)
    {
        $data = array_merge(['user_id'=>Auth::user()->parent_id],$request->only('name'));
        $permission = Permission::create($data);
        if ($permission) {
            $role_id = $request->get('role_id');
            if (!empty($role_id)){
                $roles = Role::whereIn('id',$role_id)->get();
                if (count($roles)){
                    $permission->assignRole($roles);
                }
            }
            Alert::success('Thêm mới thành công!');
            return back();
            return redirect(route('admin.permission.getIndex'));
        }
        Alert::error('Lỗi', 'Có lỗi xảy ra!');
        return redirect()->back();
    }

    protected function getEdit($id)
    {
        $permission = Permission::with('roles')->find($id);
        if (is_object($permission)) {
            $user_id = Auth::id();
            $data['role_id']=$permission->roles->pluck('id')->toArray();
            $data['roles'] = Role::where('user_id',$user_id)->pluck('name','id');
            $data['permission'] = $permission;
            return view('admins.contents.permissions.edit', $data);
        }
        return redirect(route('admin.permission.getIndex'));
    }

    protected function postEdit($id, EditPermissionRequest $request)
    {
        $data = array_merge(['user_id'=>Auth::id()],$request->only('name'));
        $permission = Permission::find($id);
        if (is_object($permission)) {
            $update = $permission->update($data);
            if ($update) {
                $role_id = $request->get('role_id');
                if (!empty($role_id)){
                    $roles = Role::whereIn('id',$role_id)->get();
                    if (count($roles)){
                        $permission->syncRoles($roles);
                    }
                }
                Alert::success('Cập nhật thành công!');
                return redirect(route('admin.permission.getIndex'));
            }
        }
        Alert::error('Lỗi', 'Có lỗi xảy ra!');
        return redirect()->back();

    }

    protected function getDelete($id)
    {
        $delete = Permission::destroy([$id]);
        if ($delete) {
            Alert::success('Thành công', 'Xóa thành công');
            return redirect(route('admin.permission.getIndex'));
        }

        Alert::error('Lỗi', 'Có lỗi xảy ra!');
        return redirect()->back();
    }

    public function getDeleteMultil(Request $request)
    {
        if (!empty($request->ids)) {
            $delete = Permission::whereIn('id', $request->ids)->delete();
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

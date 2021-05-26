<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\CURD\CURDController;
use App\Http\Requests\AddRoleRequest;
use App\Http\Requests\EditRoleRequest;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class RoleController extends CURDController
{
    protected function getIndex()
    {
        return view('admins.contents.roles.list');
    }

    protected function data()
    {
        $role = Role::select('*');
        return Datatables::of($role)
            ->addColumn('checkbox', function ($role) {
                return $this->checkboxMulti($role);
            })->editColumn('name', function ($role) {
                return $this->actionCurd($role, 'admin.role.getEdit', 'admin.role.getDelete');
            })->rawColumns(['checkbox', 'name'])->make(true);
    }

    protected function getAdd()
    {
        $data['permissions'] = Permission::pluck('name', 'id');
        return view('admins.contents.roles.add', $data);
    }

    protected function postAdd(AddRoleRequest $request)
    {
        $role = Role::create($request->only('name'));
        if ($role) {
            $permissions = Permission::whereIn('id', $request->get('permission_ids'))->get();
            if (count($permissions) > 0) {
                $role->givePermissionTo($permissions);
                Alert::success('Thêm mới thành công!');
                return redirect(route('admin.permission.getIndex'));
            }
            Alert::warning('Tạo được nhóm quyền! Nhưng chưa gắn được quyền!');
            return redirect()->back();
        }
        Alert::error('Lỗi', 'Có lỗi xảy ra!');
        return redirect()->back();
    }

    protected function getEdit($id)
    {
        $role = Role::with('permissions')->find($id);
        if (is_object($role)) {
            $data['role'] = $role;
            $data['permission'] = $role->permissions->pluck('id')->toArray();
            $data['permissions'] = Permission::pluck('name', 'id');
            return view('admins.contents.roles.edit', $data);
        }
        return redirect(route('admin.roles.getIndex'));
    }

    protected function postEdit($id, EditRoleRequest $request)
    {
        $role = Role::find($id);
        if (is_object($role)) {
            $update = $role->update($request->only('name'));
            if ($update) {
                $permissions = Permission::whereIn('id', $request->get('permission_ids'))->get();
                if (count($permissions) > 0) {
                    $role->syncPermissions($permissions);
                    Alert::success('Cập nhật thành công!');
                    return redirect(route('admin.role.getIndex'));
                }
                Alert::warning('Chỉnh sửa được nhóm quyền! Nhưng chưa gắn được quyền!');
                return redirect()->back();
            }
        }
        Alert::error('Lỗi', 'Có lỗi xảy ra!');
        return redirect()->back();

    }

    protected function getDelete($id)
    {
        $delete = Role::destroy([$id]);
        if ($delete) {
            Alert::success('Xóa thành công!');
            return redirect(route('admin.role.getIndex'));
        }

        Alert::error('Lỗi', 'Có lỗi xảy ra!');
        return redirect()->back();
    }

    public function getDeleteMultil(Request $request)
    {
        if (!empty($request->ids)) {
            $delete = Role::whereIn('id', $request->ids)->delete();
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

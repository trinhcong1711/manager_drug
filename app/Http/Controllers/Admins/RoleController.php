<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\CURD\CURDController;
use App\Http\Requests\AddPermissionRequest;
use App\Http\Requests\EditPermissionRequest;
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
        $permission = Role::select('*');
        return Datatables::of($permission)
            ->addColumn('checkbox', function ($permission) {
                return $this->checkboxMulti($permission);
            })->editColumn('name', function ($permission) {
                return $this->actionCurd($permission, 'admin.role.getEdit', 'admin.role.getDelete');
            })->rawColumns(['checkbox', 'name'])->make(true);
    }

    protected function getAdd()
    {
        $data['permissions'] = Permission::pluck('name','id');
        return view('admins.contents.roles.add',$data);
    }

    protected function postAdd(AddPermissionRequest $request)
    {
        $data = $request->only('name');
        $permission = Role::create($data);
        if ($permission) {
            Alert::success('Thêm mới thành công!');
            return redirect(route('admin.permission.getIndex'));
        }
        Alert::error('Lỗi', 'Có lỗi xảy ra!');
        return redirect()->back();
    }

    protected function getEdit($id)
    {
        $permission = Role::find($id);
        if (is_object($permission)) {
            $data['permission'] = $permission;
            return view('admins.contents.permissions.edit', $data);
        }
        return redirect(route('admin.permission.getIndex'));
    }

    protected function postEdit($id, EditPermissionRequest $request)
    {
        $data = $request->only('name');
        $permission = Role::find($id);
        if (is_object($permission)) {
            $update = $permission->update($data);
            if ($update) {
                Alert::success('Cập nhật thành công!');
                return redirect(route('admin.permission.getIndex'));
            }
        }
        Alert::error('Lỗi', 'Có lỗi xảy ra!');
        return redirect()->back();

    }

    protected function getDelete($id)
    {
        $delete = Role::destroy([$id]);
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

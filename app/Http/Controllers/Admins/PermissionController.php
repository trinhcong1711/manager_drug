<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\CURD\CURDController;
use App\Http\Requests\AddPermissionRequest;
use App\Http\Requests\EditPermissionRequest;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Permission;
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
        $permission = Permission::select('*');
        return Datatables::of($permission)
            ->addColumn('checkbox', function ($permission) {
                return $this->checkboxMulti($permission);
            })->editColumn('name', function ($permission) {
                return $this->actionCurd($permission, 'admin.permission.getEdit', 'admin.permission.getDelete');
            })->rawColumns(['checkbox', 'name'])->make(true);
    }

    protected function getAdd()
    {
        return view('admins.contents.permissions.add');
    }

    protected function postAdd(AddPermissionRequest $request)
    {
        $data = $request->only('name');
        $permission = Permission::create($data);
        if ($permission) {
            Alert::success('Thêm mới thành công!');
            return redirect(route('admin.permission.getIndex'));
        }
        Alert::error('Lỗi', 'Có lỗi xảy ra!');
        return redirect()->back();
    }

    protected function getEdit($id)
    {
        $permission = Permission::find($id);
        if (is_object($permission)) {
            $data['permission'] = $permission;
            return view('admins.contents.permissions.edit', $data);
        }
        return redirect(route('admin.permission.getIndex'));
    }

    protected function postEdit($id, EditPermissionRequest $request)
    {
        $data = $request->only('name');
        $permission = Permission::find($id);
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

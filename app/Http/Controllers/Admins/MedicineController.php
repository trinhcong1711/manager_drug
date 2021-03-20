<?php

namespace App\Http\Controllers\Admins;

use App\Exports\MedicineDefaultExport;
use App\Http\Controllers\CURD\CURDController;
use App\Http\Requests\AddMedicineRequest;
use App\Http\Requests\EditMedicineRequest;
use App\Imports\MedicineImport;
use App\Repositories\MedicinesRepositoryEloquent;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;
use App\Exports\MedicineExport;
use Maatwebsite\Excel\Facades\Excel;
class MedicineController extends CURDController
{
    protected function getIndex()
    {
        return view('admins.contents.medicines.list');
    }

    protected function data(MedicinesRepositoryEloquent $medicines)
    {
        $medicine = $medicines->select('*');
        return Datatables::of($medicine)
            ->addColumn('checkbox', function ($medicine) {
                return $this->checkboxMulti($medicine);
            })->editColumn('name', function ($medicine) {
                return $this->actionCurd($medicine, 'admin.medicine.getEdit', 'admin.medicine.getDelete');
            })->editColumn('exp', function ($medicine) {
                return $this->formatDate($medicine->exp);
            })->editColumn('inventory', function ($medicine) {
                return $this->formatNumber($medicine->inventory);
            })->editColumn('sold', function ($medicine) {
                return $this->formatNumber($medicine->sold);
            })->editColumn('price_import', function ($medicine) {
                return $this->formatNumber($medicine->price_import);
            })->editColumn('price', function ($medicine) {
                return $this->formatPrice($medicine->price);
            })->editColumn('status', function ($medicine) {
                return $this->showStatus($medicine->status);
            })->rawColumns(['checkbox', 'name', 'price', 'status'])->make(true);
    }
    public function export()
    {
        return Excel::download(new MedicineExport, 'medicines.xlsx');
    }
    public function exportDefaultFile()
    {
        return Excel::download(new MedicineDefaultExport, 'medicines_default.xlsx');
    }
    public function import()
    {
        Excel::import(new MedicineImport, request()->file('import_file'));
        Alert::success('Thành công', 'Thêm dữ liệu thành công!');
        return redirect()->back();
    }
    protected function getAdd()
    {
        return view('admins.contents.medicines.add');
    }

    protected function postAdd(AddMedicineRequest $request, MedicinesRepositoryEloquent $medicines)
    {

        $data = array_merge($request->only('name', 'package', 'inventory'), [
            'status' => $request->get('status') == 'on' ? 1 : 0,
        ]);
        $medicine = $medicines->create($data);
        if ($medicine) {
            $exp =
            $unit = $this->formatPriceSave($request->unit, $request->convert, $request->price);
            Alert::success('Thành công', 'Thêm mới thành công');
            return redirect(route('admin.medicine.getIndex'));
        } else {
            Alert::error('Lỗi', 'Có lỗi xảy ra!');
            return redirect()->back();
        }
    }

    protected function getEdit($id, MedicinesRepositoryEloquent $medicines)
    {
        if (isset($id)) {
            $data['medicine'] = $medicines->find($id);
            if (is_object($data['medicine'])) {
                $data['prices'] = (array)json_decode($data['medicine']->price);
                return view('admins.contents.medicines.edit', $data);
            } else {
                return redirect(route('admin.medicine.getIndex'));
            }
        }
    }

    protected function postEdit(EditMedicineRequest $request, $id, MedicinesRepositoryEloquent $medicines)
    {
        $price = $this->formatPriceSave($request->unit, $request->convert, $request->price);
        $exp = $this->jsonDateSave($request->exp);
        $data = array_merge($request->only('name', 'slug', 'package', 'amount', 'inventory', 'price_import'), [
            'slug' => Str::slug($request->get('name')),
            'price' => $price,
            'exp' => $exp,
            'status' => $request->get('status') == 'on' ? 1 : 0,
        ]);
        $update = $medicines->update($data, $id);
        if ($update) {
            Alert::success('Thành công', 'Cập nhật thành công');
            return redirect(route('admin.medicine.getIndex'));
        } else {
            Alert::error('Lỗi', 'Có lỗi xảy ra!');
            return redirect()->back();
        }
    }

    protected function getDelete($id, MedicinesRepositoryEloquent $medicines)
    {
        if (isset($id)) {
            $delete = $medicines->delete($id);
            if ($delete) {
                Alert::success('Thành công', 'Xóa thành công');
                return redirect(route('admin.medicine.getIndex'));
            } else {
                Alert::error('Lỗi', 'Có lỗi xảy ra!');
                return redirect()->back();
            }
        }
    }
    public function getDeleteMultil(Request $request, MedicinesRepositoryEloquent $medicines)
    {
        if (!empty($request->ids)) {
            $delete = $medicines->destroy($request->ids);
            if ($delete) {
                return response()->json([
                    'status'=>true,
                    'message'=>'Xóa thành công!!!',
                ]);
            } else {
                return response()->json([
                    'status'=>false,
                    'message'=>'Có lỗi xảy ra!',
                ]);
            }
        }
    }


}

<?php

namespace App\Http\Controllers\Admins;

use App\Entities\Unit;
use App\Exports\MedicineDefaultExport;
use App\Exports\MedicineExport;
use App\Http\Controllers\CURD\CURDController;
use App\Http\Requests\AddMedicineRequest;
use App\Http\Requests\EditMedicineRequest;
use App\Imports\MedicineImport;
use App\Repositories\MedicinesRepositoryEloquent;
use App\Repositories\UnitRepositoryEloquent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;

class MedicineController extends CURDController
{
    public $unitRepository;

    public function __construct(UnitRepositoryEloquent $unitRepository)
    {
        $this->unitRepository = $unitRepository;
    }

    protected function getIndex()
    {
        return view('admins.contents.medicines.list');
    }

    protected function data(MedicinesRepositoryEloquent $medicines)
    {
        $medicine = $medicines->with(['units'])->select('*');
        return Datatables::of($medicine)
            ->addColumn('checkbox', function ($medicine) {
                return $this->checkboxMulti($medicine);
            })->editColumn('name', function ($medicine) {
                return $this->actionCurd($medicine, 'admin.medicine.getEdit', 'admin.medicine.getDelete');
            })->editColumn('inventory', function ($medicine) {
                return $this->formatNumber($medicine->inventory);
            })->editColumn('sold', function ($medicine) {
                return $this->formatNumber($medicine->sold);
            })->editColumn('rest', function ($medicine) {
                return $this->formatNumber($medicine->rest);
            })->editColumn('price', function ($medicine) {
                return $this->formatPrice($medicine->units);
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
        $data = array_merge($request->only('name', 'package', 'inventory', 'rest'), [
            'status' => $request->get('status') == 'on' ? 1 : 0,

        ]);
        $medicine = $medicines->create($data);
        if ($medicine) {
            if ($request->has('unit')) {
                $units = $request->get("unit");
                $converts = $request->get("convert");
                $prices = $request->get("price");
                $rows = [];
                foreach ($units as $k => $unit) {
                    $rows[$k]['medicine_id'] = $medicine->id;
                    $rows[$k]['name'] = $unit;
                    $rows[$k]['convert'] = $converts[$k];
                    $rows[$k]['price'] = $prices[$k];
                }
                foreach ($rows as $row) {
                    $this->unitRepository->create($row);
                }
            }
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
            $medicine = $medicines->with(['units'])->find($id);
            if (is_object($medicine)) {
                $data['medicine'] = $medicine;
                $units = $medicine->units;
                if (count($units) > 0) {
                    $data['units'] = $units;
                }
                return view('admins.contents.medicines.edit', $data);
            } else {
                return redirect(route('admin.medicine.getIndex'));
            }
        }
    }

    protected function postEdit(EditMedicineRequest $request, $id, MedicinesRepositoryEloquent $medicines)
    {
        $data = array_merge($request->only('name', 'package', 'inventory', 'rest'), [
            'status' => $request->get('status') == 'on' ? 1 : 0,
        ]);
        $medicine = $medicines->update($data, $id);
        if ($medicine) {
            $this->saveUnits("update", $medicine, $request);
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
            $medicine = $medicines->find($id);
            if (is_object($medicine)) {
                $units = $medicine->units()->pluck("id");
                Unit::destroy($units);
                $delete = $medicine->delete($id);
                if ($delete) {
                    Alert::success('Thành công', 'Xóa thành công');
                    return redirect(route('admin.medicine.getIndex'));
                } else {
                    Alert::error('Lỗi', 'Có lỗi xảy ra!');
                    return redirect()->back();
                }
            }


        }
    }

    public function getDeleteMultil(Request $request, MedicinesRepositoryEloquent $medicines)
    {
        if (!empty($request->ids)) {
            $medicine = $medicines->findWhereIn('id', $request->ids)->pluck('id');
            if (count($medicine) > 0) {
                $units = Unit::whereIn('medicine_id', $medicine)->pluck('id');
                Unit::destroy($units);
                $delete = $medicines->destroy($medicine);
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
                'message' => 'Bản ghi không tồn tại!',
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => 'Không có bản ghi nào được chọn!',
        ]);
    }

    private function saveUnits($action, $medicine, $request, $rows = [])
    {
        $medicine->units()->update(['status' => 0]);
        if ($request->has("unit")) {
            $units = array_filter($request->get("unit"));
            if (!empty($units)) {
                $converts = $request->get("convert");
                $prices = $request->get("price");
                foreach ($units as $k => $value) {
                    $rows[$k]['medicine_id'] = $medicine->id;
                    $rows[$k]['name'] = $value;
                    $rows[$k]['convert'] = $converts[$k] == null ? 1 : $converts[$k];
                    $rows[$k]['price'] = $prices[$k] == null ? 0 : $prices[$k];
                }
                if (!empty($rows)) {
                    foreach ($rows as $row) {
                        $this->unitRepository->create($row);
                    }
                }
            }
        }
    }
}

<?php

namespace App\Http\Controllers\Admins;

use App\Entities\Medicine;
use App\Http\Controllers\CURD\CURDController;
use App\Repositories\ImportRepositoryEloquent;
use App\Repositories\MedicinesRepositoryEloquent;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;

class ImportMedicineController extends CURDController
{
    protected function getIndex(){
        return view('admins.contents.import_medicines.list');
    }

    protected function data(ImportRepositoryEloquent $imports)
    {
        $import = $imports->select('*');
        return Datatables::of($import)
            ->editColumn('user_id', function ($import) {
                return $this->actionCurd($import, 'admin.import_medicine.getEdit', '', 'user');
            })->editColumn('created_at', function ($import) {
                return $this->formatDate($import->created_at);
            })->editColumn('checked_at', function ($import) {
                return $this->formatDate($import->checked_at);
            })->editColumn('price', function ($import) {
                return number_format(123, 0, "", ",");
            })->editColumn('status', function ($import) {
                return $import->status == 0 ? "Chưa kiểm" : "Đã kiểm";
            })->rawColumns(['user_id', 'price', 'status'])->make(true);
    }

    protected function getAdd(MedicinesRepositoryEloquent $medicinesRepository)
    {
        $data['medicines'] = Medicine::rests()->with('units')->get();

        return view('admins.contents.import_medicines.add',$data);
    }

    protected function postAdd(Request $request, ImportRepositoryEloquent $importRepository)
    {
        $importMedicine = $importRepository->create([
            'user_id' => 1,
        ]);
        if ($importMedicine) {
            $dataAttach = array_combine($request->get("medicine_id"),$request->get("import_medicine"));
            $importMedicine->medicines()->attach($dataAttach);
            Alert::success('Thêm mới thành công');
            return redirect(route('admin.import_medicine.getIndex'));
        } else {
            Alert::error('Lỗi', 'Có lỗi xảy ra!');
            return redirect()->back();
        }
    }

    protected function getEdit($id, ImportRepositoryEloquent $importRepository)
    {
        if (isset($id)) {
            $import = $importRepository->with(['medicines', 'user'])->find($id);
            if (is_object($import)) {
                $data['import'] = $import;
                $medicines = $import->medicines;
                if (count($medicines) > 0) {
                    $data['medicines'] = $medicines;
                }
                $user = $import->user;
                if (is_object($user)) {
                    $data['user'] = $user;
                }
                return view('admins.contents.import_medicines.edit', $data);
            } else {
                return redirect(route('admin.import_medicines.getIndex'));
            }
        }
    }

    protected function postEdit($id,Request $request, ImportRepositoryEloquent $importRepository)
    {
        $importMedicine = $importRepository->find($id);
        if ($importMedicine) {
            $dataAttach = array_combine($request->get("medicine_id"),$request->get("import_medicine"));
            $importMedicine->medicines()->sync($dataAttach);
            Alert::success('Chỉnh thành công');
            return redirect(route('admin.import_medicine.getIndex'));
        } else {
            Alert::error('Lỗi', 'Có lỗi xảy ra!');
            return redirect()->back();
        }
    }
//  Hàm tìm kiếm thuốc
    protected function ajaxSearchMedicine(Request $request, MedicinesRepositoryEloquent $medicines)
    {
        if ($request->has('inventory')){
                $inventory = $request->get('inventory');
                $medicine = $medicines->select('name', 'amount', 'id')
                                        ->where('inventory', '<=',  $inventory)
                                        ->where('status', 1)->get();
                $data['medicines']=[];
                if ($medicine->count() > 0) {
                    $data['medicines'] = $medicine;
                }
                return view('admins.ajax.search_list_medicine',$data);

        }
    }

}

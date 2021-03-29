<?php

namespace App\Http\Controllers\Admins;

use App\Exports\ImPortMedicineExport;
use App\Http\Controllers\CURD\CURDController;
use App\Repositories\ImportRepositoryEloquent;
use App\Repositories\MedicinesRepositoryEloquent;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;

class ImportMedicineController extends CURDController
{
    protected function getIndex(){
        return view('admins.contents.import_medicines.list');
    }

    protected function data(ImportRepositoryEloquent $imports)
    {
        $import = $imports->orderBy("id", "desc")->select('*');
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
            })->editColumn('export', function ($import) {
                return '<i class="ti-import export_hd" style="cursor:pointer" data-import_id="'.$import->id.'"></i>';
            })->rawColumns(['user_id','export' ,'price', 'status'])->make(true);
    }

    protected function getAdd(MedicinesRepositoryEloquent $medicinesRepository)
    {
        $data['medicines'] = $medicinesRepository->rests()->with('units')->get();
        return view('admins.contents.import_medicines.add',$data);
    }

    protected function postAdd(Request $request, ImportRepositoryEloquent $importRepository)
    {
        $importMedicine = $importRepository->create([
            'user_id' => 1,
        ]);
        if ($importMedicine) {
            $amounts = $request->get("amounts");
            $units = $request->get("units");
            $notes = $request->get("notes");
            $import_medicines =[];
            if (!empty($amounts)){
                foreach($amounts as $key=>$amount){
                    $import_medicines[]=[
                        'amount'=>$amount,
                        'unit'=>$units[$key],
                        'note'=>$notes[$key]
                    ];
                }
            }
            $dataAttach = array_combine($request->get("medicine_id"),$import_medicines);
            $importMedicine->medicines()->attach($dataAttach);
            Alert::success('Thành công', 'Thêm mới thành công');
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

    protected function postEdit()
    {

    }

    public function export(Request $request,ImportRepositoryEloquent $importRepository)
    {
        if ($request->has('id')){
            $import = $importRepository->with('medicines')->find($request->get('id'));
            if (is_object($import)){
                $listExports = $import->medicines;
                if (count($listExports)>0){
                    $data['listExports'] = $listExports;
                    $data['import'] = $import;
                    return Excel::download(new ImPortMedicineExport($data), "HĐ_nhập_".$import->created_at->format('d_m_Y').'.xlsx');
                }
            }
        }
        else{
            Alert::success('Thất bại!', 'Không tìm thấy hóa đơn nhập!');
            return redirect(route('admin.import_medicine.getIndex'));
        }
    }
//  Hàm tìm kiếm thuốc
    protected function ajaxSearchMedicine(Request $request, MedicinesRepositoryEloquent $medicinesRepository)
    {
        if ($request->has('keyword')) {
            $keyword = $request->get('keyword');
            $medicineRestId = $medicinesRepository->rests()->with('units')->pluck("id");
            $medicine = $medicinesRepository->select('name', 'inventory', 'id')
                ->where('name', 'like', "%" . $keyword . "%")
//                ->whereNotIn('id', $medicineRestId)
                ->where('status', 1)->get();
                $data['medicines']=[];
                if ($medicine->count() > 0) {
                    $data['medicines'] = $medicine;
                }
                return view('admins.ajax.search_list_medicine',$data);
        }
    }

//  Hàm thêm thuốc vào danh sách nhập hàng
    protected function ajaxAddImportMedicine(Request $request, MedicinesRepositoryEloquent $medicines)
    {
        $data = [];
        if ($request->has('id')) {
            $id = $request->get('id');
            $medicine = $medicines->select('name', 'inventory', 'status', 'id')->with('units')
                ->find($id);
            if (is_object($medicine) && ($medicine->status == 1)) {
                $data['medicine'] = $medicine;
            }
        }
        return view('admins.ajax.add_medicine_to_import',$data);
    }

}

<?php

namespace App\Http\Controllers\Admins;

use App\Repositories\ExportRepositoryEloquent;
use App\Repositories\MedicinesRepositoryEloquent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;

class ExportMedicineController extends Controller
{
    protected function getIndex(){
        return view('admins.contents.export_medicines.list');
    }
    protected function data(ExportRepositoryEloquent $exports)
    {
        $export = $exports->with('medicines')->orderBy("id", "desc")->select('*');
        try {
            return Datatables::of($export)
                ->editColumn('user_id', function ($export) {
                    return $this->actionCurd($export, 'admin.import_medicine.getEdit', '', 'user');
                })
                ->editColumn('member_id', function ($export) {
                    return $export->member->name;
                })->editColumn('created_at', function ($export) {
                    return $this->formatDate($export->created_at);
                })->editColumn('total_money', function ($export) {
                    return number_format($export->total_money, 0, "", ",");
                })->editColumn('type', function ($export) {
                    if ($export->type == 1){
                        $type = "Hệ thống";
                    }else if ($export->type == 2){
                        $type = "Trình dược";
                    }else{
                        $type = "Chợ thuốc";
                    }
                    return $type;
                })->editColumn('status', function ($export) {
                    return $export->status == 0 ? "Chưa trả tiền" : "Đã trả tiền";
                })->editColumn('export', function ($export) {
                    return '<i class="ti-import export_hd btn btn-success" title="Tải xuống" style="cursor:pointer" data-import_id="' . $export->id . '"></i>';
                })->rawColumns(['user_id', 'export'])->make(true);
        } catch (\Exception $e) {
            Alert::error('Lỗi', 'Có lỗi xảy ra!');
        }
    }
    protected function getAdd(MedicinesRepositoryEloquent $medicinesRepository)
    {
        $data['medicines'] = $medicinesRepository->with('units')->findWhere(['status'=>1]);
        return view('admins.contents.export_medicines.add',$data);
    }
    //  Hàm thêm thuốc vào danh sách xuất hàng
    protected function ajaxAddExportMedicine(Request $request, MedicinesRepositoryEloquent $medicines)
    {
        if ($request->has('id')) {
            $medicine_id = $request->get('id');
            $id_selected = $request->get('id_selected');
            $data = select_medicine_from_search_box($medicine_id, $id_selected, $medicines);
            return view('sells.ajax.add_medicine_to_sell', $data);
        }
        return "";
    }


}

<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\CURD\CURDController;
use App\Repositories\ExportRepositoryEloquent;
use App\Repositories\MedicinesRepositoryEloquent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;

class ExportMedicineController extends CURDController
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
                    return $this->actionCurd($export, 'admin.export_medicine.getEdit','','user');
                })
                ->editColumn('member_id', function ($export) {
                    return $export->member->name??"Không xác định";
                })->editColumn('created_at', function ($export) {
                    return $this->formatDate($export->created_at);
                })->editColumn('total_money', function ($export) {
                    return number_format($export->total_money, 0, "", ",");
                })->editColumn('type', function ($export) {
                    return show_status([1=>'Hệ thống', 2=>"Trình dược", 3=>'Chợ thuốc'],$export->type);
                })->editColumn('status', function ($export) {
                    return show_status([0=>'Chưa thanh toán', 1=>"Đã thanh toán"],$export->status);
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
    protected function postAdd(Request $request, ExportRepositoryEloquent $exportRepository)
    {
        $amounts = $request->get("amount");
        $units = $request->get("unit_id");
        $prices = $request->get("price");
        foreach ($prices as $val) $prices = str_replace(",", "", $prices);
        $total_money = array_sum($prices);


        $export = $exportRepository->create([
            'note'=>$request->get("note"),
            'status'=>0,
            'user_id'=>1,
            'type'=>$request->get("type"),
            'total_money'=>$total_money,
            'member_id'=>$request->get("member_id")
        ]);
        if ($export){
            $export_medicines =[];
            if (!empty($amounts)){
                foreach($amounts as $key=>$amount){
                    $export_medicines[]=[
                        'amount'=>$amount,
                        'unit_id'=>$units[$key],
                        'price'=>$prices[$key]
                    ];
                }
            }
            $export_medicines = array_combine($request->get("medicine_id"),$export_medicines);
            $export->medicines()->attach($export_medicines);
            Alert::success('Thành công', 'Thêm mới thành công');
            return redirect(route('admin.export_medicine.getIndex'));
        } else {
            Alert::error('Lỗi', 'Có lỗi xảy ra!');
            return redirect()->back();
        }
    }

    protected function getEdit($id, ExportRepositoryEloquent $exportRepository)
    {
        if (isset($id)) {
            $export = $exportRepository->with(['medicines', 'user'])->find($id);
            if (is_object($export)) {
                $data['export'] = $export;
                $medicines = $export->medicines;
                if (count($medicines) > 0) {
                    $data['medicines'] = $medicines;
                }
                $user = $export->user;
                if (is_object($user)) {
                    $data['user'] = $user;
                }
                return view('admins.contents.export_medicines.edit', $data);
            } else {
                return redirect(route('admin.export_medicines.getIndex'));
            }
        }
    }

    //  Hàm thêm thuốc vào danh sách xuất hàng
    protected function ajaxAddExportMedicine(Request $request, MedicinesRepositoryEloquent $medicines)
    {
        if ($request->has('id')) {
            $medicine_id = $request->get('id');
            $id_selected = $request->get('id_selected');
            $data = select_medicine_from_search_box($medicine_id, $id_selected, $medicines);
            return view('admins.contents.export_medicines.ajax.add_medicine', $data);
        }
    }
}

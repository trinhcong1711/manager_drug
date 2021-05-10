<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\CURD\CURDController;
use App\Repositories\ExportRepositoryEloquent;
use App\Repositories\MedicinesRepositoryEloquent;
use App\Repositories\UnitRepositoryEloquent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;

class ExportMedicineController extends CURDController
{
    protected function getIndex()
    {
        return view('admins.contents.export_medicines.list');
    }

    protected function data(ExportRepositoryEloquent $exports)
    {
        $export = $exports->with('medicines')->orderBy("id", "desc")->select('*');
        try {
            return Datatables::of($export)
                ->editColumn('user_id', function ($export) {
                    return $this->actionCurd($export, 'admin.export_medicine.getEdit', '', 'user');
                })
                ->editColumn('member_id', function ($export) {
                    return $export->member->name ?? "Không xác định";
                })->editColumn('created_at', function ($export) {
                    return $this->formatDate($export->created_at);
                })->editColumn('total_money', function ($export) {
                    return number_format($export->total_money, 0, "", ",");
                })->editColumn('type', function ($export) {
                    return show_status([1 => 'Hệ thống', 2 => "Trình dược", 3 => 'Chợ thuốc'], $export->type);
                })->editColumn('status', function ($export) {
                    return show_status([0 => 'Chưa thanh toán', 1 => "Đã thanh toán"], $export->status);
                })->editColumn('export', function ($export) {
                    return '<i class="ti-import export_hd btn btn-success" title="Tải xuống" style="cursor:pointer" data-import_id="' . $export->id . '"></i>';
                })->rawColumns(['user_id', 'export'])->make(true);
        } catch (\Exception $e) {
            Alert::error('Lỗi', 'Có lỗi xảy ra!');
        }
    }

    protected function getAdd(MedicinesRepositoryEloquent $medicinesRepository)
    {
        $data['medicines'] = $medicinesRepository->with('units')->findWhere(['status' => 1]);
        return view('admins.contents.export_medicines.add', $data);
    }

    protected function postAdd(Request $request, ExportRepositoryEloquent $exportRepository, UnitRepositoryEloquent $unitRepository)
    {
        $amounts = $request->get("amount");
        $units = $request->get("unit_id");
        $prices = $request->get("price");
        foreach ($prices as $val) $prices = str_replace(",", "", $prices);
        $total_money = array_sum($prices);
        $export = $exportRepository->create([
            'note' => $request->get("note"),
            'status' => 0,
            'user_id' => 1,
            'type' => $request->get("type"),
            'total_money' => $total_money,
            'member_id' => $request->get("member_id")
        ]);
        $warring = "";
        if ($export) {
            $export_medicines = [];
            if (!empty($amounts)) {
                foreach ($amounts as $key => $amount) {
                    $export_medicines[] = [
                        'amount' => $amount,
                        'unit_id' => $units[$key],
                        'price' => $prices[$key]
                    ];
                }
            }
            $export_medicines = array_combine($request->get("medicine_id"), $export_medicines);
            if (!empty($export_medicines)) {
//            Cập nhật số lượng còn lại của thuốc trong kho
                foreach ($export_medicines as $medicine_id => $value) {
                    $unit = $unitRepository->with('medicine')->find($value['unit_id']);
                    if ($unit->medicine_id == $medicine_id) {
                        $medicine = $unit->medicine;
                        if (is_object($medicine)) {
                            $convert = $unit->convert;
//                            Tổng số lượng xuất
                            $total = $convert * $value['amount'];
//                            Số lượng tồn trong kho
                            $inventory = $medicine->inventory;
                            if ($inventory >= $total) {
                                $difference = $inventory - $total;
                                $medicine->update(['inventory' => $difference]);
                            } else {
//                                Xóa sản phẩm có số lượng xuất > số lượng tồn
                                $warring .= " Thuốc " . $medicine->name . ". Do có số lượng tồn < số lượng xuất!.";
                                unset($export_medicines[$medicine_id]);
                            }
                        }
                    }
                }
                if (!empty($export_medicines)) {
                    $export->medicines()->attach($export_medicines);
                    if (empty($warring)) {
                        Alert::success("Thành công!", "Tạo đơn xuất thành công!.");
                    } else {
                        Alert::warning("Thành công!", "Tạo đơn xuất thành công! Ngoại trừ các thuốc sau: " . $warring);
                    }
                    return redirect()->back();
                }
            }
            $export->delete();
            Alert::warning("Thất bại!", "Tất cả sản phẩm đã chọn hiện không tồn tại trong kho!. " . $warring);
            return redirect()->back();
        }
        Alert::error("Thất bại!", 'Không tạo được đơn xuất!');
        return redirect()->back();

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

    protected function postEdit($id, Request $request, ExportRepositoryEloquent $exportRepository)
    {
        $export = $exportRepository->find($id);
        $export->update(['status' => $request->get('status') == 'on' ? 1 : 0]);
        Alert::success('Cập nhật thành công');
        return redirect()->back();
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

<?php

namespace App\Http\Controllers\Sells;

use App\Http\Controllers\Controller;
use App\Repositories\BillRepositoryEloquent;
use App\Repositories\MedicinesRepositoryEloquent;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SellController extends Controller
{
    public function getIndex(){
        return view('sells.sell');
    }

    public function postSell(Request $request,
                             BillRepositoryEloquent $billRepository,
                             MedicinesRepositoryEloquent $medicinesRepository)
    {
        $amounts = $request->get("amount");
        $units = $request->get("unit_id");
        $medicine_id = $request->get("medicine_id");
        $total = 0;
        $data = [];
        if (!empty($medicine_id)) {
            foreach ($medicine_id as $k => $id_medicine) {
                $medicine = $medicinesRepository->find($id_medicine);
                if (is_object($medicine)) {
                    $difference = 0;
                    $id_units = $medicine->units()->pluck('id')->toArray();
                    if (in_array($units[$k], $id_units)) {
                        $unit = $medicine->units()->find($units[$k]);
                        $difference = $unit->convert * $amounts[$k];
                        $total += $unit->price * $amounts[$k];
                        $data[$medicine->id]['amount'] = $amounts[$k];
                        $data[$medicine->id]['unit_name'] = $unit->name;
                        $data[$medicine->id]['price'] = $unit->price;
                        $data[$medicine->id]['total_price'] = $unit->price * $amounts[$k];
                    }
                    $inventory = $medicine->inventory - $difference;
                    $medicine->update(['inventory' => $inventory]);
                }
            }
//        Tạo bill
            if ($total > 0) {
                $bill = $billRepository->create([
                    'user_id' => 1,
                    'member_id' => 1,
                    'total' => $total,
                    'status' => 1,
                    'note' => $request->get('note'),
                ]);
                if ($bill) {
                    $bill->medicines()->attach($data);

                    Alert::success('Tạo đơn thành công!');
                    return redirect()->back();
                }
            }
        }
        Alert::error('Tạo đơn thất bại!');
        return redirect()->back();
    }

    //  Hàm tìm kiếm thuốc
    protected function ajaxSearchMedicine(Request $request, MedicinesRepositoryEloquent $medicinesRepository)
    {
        if ($request->has('keyword')) {
            $keyword = $request->get('keyword');
            $medicine = $medicinesRepository->select('name', 'inventory', 'id')
                ->where('name', 'like', "%" . $keyword . "%")
                ->where('status', 1)
                ->with('units')->get();
            $data['medicines']=[];
            if ($medicine->count() > 0) {
                $data['medicines'] = $medicine;
            }
            return view('sells.ajax.search_list_medicine',$data);
        }
    }

    //  Hàm thêm thuốc vào danh sách nhập hàng
    protected function ajaxSellAddMedicine(Request $request, MedicinesRepositoryEloquent $medicines)
    {
        $data = [];
        if ($request->has('id')) {
            $id = $request->get('id');
            $id_selected = $request->get('id_selected');
            $check_exits = strpos($id_selected, "|" . $id . "|");
            if ($check_exits === false) {
                $medicine = $medicines->select('name', 'inventory', 'status', 'package', 'id')->with('units')
                    ->find($id);
                if (is_object($medicine) && ($medicine->status == 1)) {
                    $data['medicine'] = $medicine;
                    return view('sells.ajax.add_medicine_to_sell', $data);
                }
            }

        }

    }


}

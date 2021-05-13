<?php

namespace App\Http\Controllers\Sells;

use App\Http\Controllers\Controller;
use App\Repositories\BillRepositoryEloquent;
use App\Repositories\MedicinesRepositoryEloquent;
use Illuminate\Http\Request;

class SellController extends Controller
{
    public function getIndex()
    {
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
                        $amount = (!empty($amounts[$k]) && is_numeric($amounts[$k]) && $amounts[$k] > 0) ? $amounts[$k] : 1;
                        $difference = $unit->convert * $amount;
                        $total += $unit->price * $amount;
                        $data[$medicine->id]['amount'] = $amount;
                        $data[$medicine->id]['unit_id'] = $unit->id;
                        $data[$medicine->id]['unit_name'] = $unit->name;
                        $data[$medicine->id]['price'] = $unit->price;

                        $data[$medicine->id]['total_price'] = $unit->price * $amount;
                    }
                    $inventory = $medicine->inventory - $difference;
                    if ($inventory >= 0) {
                        $medicine->update(['inventory' => $inventory, 'sold' => $medicine->sold + $difference]);
                    } else {
                        return response()->json([
                            'status' => false,
                            'msg' => "Thuốc " . $medicine->name . "! Có số lượng bán vượt quá số lượng tồn trong kho!",
                        ]);
                    }
                } else {
                    return response()->json([
                        'status' => false,
                        'msg' => "Có thuốc không tồn tại trong kho!",
                    ]);
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
                    return response()->json([
                        'status' => true,
                        'msg' => "Tạo đơn thành công!",
                    ]);
                }
            }
        }
        return response()->json([
            'status' => true,
            'msg' => "Tạo đơn thất bại!",
        ]);
    }

    //  Hàm tìm kiếm thuốc
    protected function ajaxSearchMedicine(Request $request, MedicinesRepositoryEloquent $medicinesRepository)
    {
        if ($request->has('keyword') && !empty($request->get('keyword'))) {
            $data = search_medicine($request->get('keyword'), $medicinesRepository);
            return view('sells.ajax.search_list_medicine', $data);
        }
    }

    //  Hàm thêm thuốc vào danh sách nhập hàng
    protected function ajaxSellAddMedicine(Request $request, MedicinesRepositoryEloquent $medicines)
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

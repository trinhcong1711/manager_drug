<?php

namespace App\Http\Controllers\Sells;

use App\Repositories\MedicinesRepositoryEloquent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SellController extends Controller
{
    public function getIndex(){
        return view('sells.sell');
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
            $medicine = $medicines->select('name', 'inventory', 'status', 'package', 'id')->with('units')
                ->find($id);
            if (is_object($medicine) && ($medicine->status == 1)) {
                $data['medicine'] = $medicine;
            }
        }
        return view('sells.ajax.add_medicine_to_sell',$data);
    }


}

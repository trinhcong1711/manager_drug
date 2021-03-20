<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\CURD\CURDController;
use App\Repositories\MedicinesRepositoryEloquent;
use Illuminate\Http\Request;

class ImportMedicineController extends CURDController
{
    protected function getIndex(){
        return view('admins.contents.import_medicines.import');
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

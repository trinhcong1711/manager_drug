<?php

namespace App\Http\Controllers\Admins;

use App\Entities\Medicine;
use App\Http\Controllers\CURD\CURDController;
use App\Repositories\MedicinesRepositoryEloquent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class MedicineController extends CURDController
{
    protected function getIndex()
    {
        return view('admins.contents.medicines.list');
    }

    protected function data(MedicinesRepositoryEloquent $medicines)
    {
        $medicine = $medicines->get('*');
        return Datatables::of($medicine)
            ->addColumn('checkbox', function ($medicine) {
                return $this->checkboxMulti($medicine);
            })->editColumn('name', function ($medicine) {
                return $this->actionCurd($medicine, 'admin.medicine.getEdit', 'admin.medicine.getDelete');
            })->editColumn('exp', function ($medicine) {
                return $this->formatDate($medicine->exp);
            })->editColumn('inventory', function ($medicine) {
                return $this->formatNumber($medicine->inventory);
            })->editColumn('sold', function ($medicine) {
                return $this->formatNumber($medicine->sold);
            })->editColumn('price_import', function ($medicine) {
                return $this->formatNumber($medicine->price_import);
            })->editColumn('price', function ($medicine) {
                return $this->formatPrice($medicine->price);
            })->editColumn('status', function ($medicine) {
                return $this->showStatus($medicine->status);
            })->rawColumns(['checkbox', 'name', 'price', 'status'])->make(true);
    }

    protected function getAdd()
    {
        return view('admins.contents.medicines.add');
    }

    protected function postAdd(Request $request,MedicinesRepositoryEloquent $medicines)
    {
        $arr = [];
        $units = $request->unit;
        $converts = $request->convert;
        $prices = $request->price;
        $arr['unit']=$units;
        $arr['convert']=$converts;
        $arr['price']=$prices;
        $price = json_encode($arr);
        $exp = $this->jsonDateSave($request->exp);
        $data = array_merge($request->only('name', 'slug', 'package', 'amount', 'inventory', 'price_import'), [
            'slug' => Str::slug($request->get('name')),
            'price' => $price,
            'exp' => $exp,
            'status' => $request->get('status') == 'on' ? 1 : 0,
        ]);
        $medicines->create($data);
        return redirect(route('admin.medicine.getIndex'))->with('success', 'Thêm mới thành công!');
    }

    protected function getEdit($id,MedicinesRepositoryEloquent $medicines)
    {
        if (isset($id)) {
            $data['medicine'] = $medicines->find($id);
            if (is_object($data['medicine'])) {
                return view('admins.contents.medicines.edit', $data);
            } else {
                return redirect(route('admin.medicine.getIndex'));
            }
        }
    }

    protected function getDelete($id,MedicinesRepositoryEloquent $medicines)
    {
        if (isset($id)) {
            $medicine = $medicines->find($id);
            if (is_object($medicine)) {
                $medicine->delete();
            }
        }
    }

}

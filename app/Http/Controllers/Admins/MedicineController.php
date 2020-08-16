<?php

namespace App\Http\Controllers\Admins;

use App\Entities\Medicine;
use App\Http\Controllers\CURD\CURDController;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MedicineController extends CURDController
{
    protected function getIndex()
    {
        $data['medicines'] = Medicine::where('status', 1)->get();
        return view('admins.contents.medicines.list', $data);
    }

    protected function getAdd()
    {
        return view('admins.contents.medicines.add');
    }
    protected function postAdd(Request $request)
    {
        $price = json_encode(array_combine($request->unit,$request->price));
        $exp = $this->jsonDateSave($request->exp);
        $data = array_merge($request->only('name','slug','package','amount','inventory','price_import'),[
            'slug'=> Str::slug($request->get('name')),
            'price'=> $price,
            'exp'=> $exp,
            'status'=> $request->get('status') =='on'?1:0,
        ]);
        Medicine::create($data);
        return redirect(route('admin.medicine.getIndex'))->with('success','Thêm mới thành công!');
    }

    protected function getEdit($id)
    {
        if (isset($id)) {
            $data['medicine'] = Medicine::find($id);
            if (is_object($data['medicine'])) {
                return view('admins.contents.medicines.edit', $data);
            } else {
                return redirect(route('admin.medicine.getIndex'));
            }
        }
    }
    protected function getDelete($id)
    {
        if (isset($id)) {
            $medicine = Medicine::find($id);
            if (is_object($medicine)){
                $medicine->delete();
            }
        }
    }

}

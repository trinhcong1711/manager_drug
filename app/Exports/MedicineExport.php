<?php

namespace App\Exports;

use App\Entities\Medicine;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class MedicineExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */
//    public function collection()
//    {
//        return Medicine::all();
//    }
    public function view(): View
    {
        $data['medicines'] = Medicine::select('name', 'amount', 'exp', 'package', 'inventory', 'price_import', 'price', 'sold', 'status')->get();
        return view('admins.exports.medicine', $data);
    }
}

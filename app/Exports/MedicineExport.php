<?php

namespace App\Exports;

use App\Entities\Medicine;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class MedicineExport implements FromView
{
    public function view(): View
    {
        $data['medicines'] = Medicine::select('id', 'name', 'package', 'inventory', 'sold', 'status')->with(['units'])->get();
        return view('admins.exports.medicine', $data);
    }
}

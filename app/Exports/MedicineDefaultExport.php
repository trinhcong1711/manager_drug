<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class MedicineDefaultExport implements FromView,ShouldAutoSize,WithStyles
{
    public function view(): View
    {
        return view('admins.exports.medicine_default');
    }
    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:K1')->getFont()->setBold(true);

//        return [
            // Style the first row as bold text.
//            1    => ['font' => ['bold' => true]],
//        ];
    }
}

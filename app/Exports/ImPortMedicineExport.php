<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;

class ImPortMedicineExport implements FromView, WithTitle
{
    protected $medicineImport;
    public function __construct($medicineImport)
    {
        $this->medicineImport = $medicineImport;
    }

    public function view(): View
    {
        $data['medicines'] = $this->medicineImport['listExports'];
        $data['import'] = $this->medicineImport['import'];
        return view('admins.exports.import_medicine', $data);

    }
    public function title(): string
    {
        return $this->medicineImport['import']->created_at->format('d-m-Y');
    }
}

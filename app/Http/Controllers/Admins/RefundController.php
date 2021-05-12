<?php

namespace App\Http\Controllers\Admins;

use App\Entities\Unit;
use App\Exports\MedicineDefaultExport;
use App\Exports\MedicineExport;
use App\Http\Controllers\CURD\CURDController;
use App\Http\Requests\AddMedicineRequest;
use App\Http\Requests\EditMedicineRequest;
use App\Imports\MedicineImport;
use App\Repositories\BillRepositoryEloquent;
use App\Repositories\MedicinesRepositoryEloquent;
use App\Repositories\RefundRepositoryEloquent;
use App\Repositories\UnitRepositoryEloquent;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;

class RefundController extends CURDController
{
    public $unitRepository;
    public $refundRepository;

    public function __construct(UnitRepositoryEloquent $unitRepository, RefundRepositoryEloquent $refundRepository)
    {
        $this->refundRepository = $refundRepository;
        $this->unitRepository = $unitRepository;
    }

    protected function getIndex()
    {
        return view('admins.contents.refunds.list');
    }

    protected function data()
    {
        $refund = $this->refundRepository->with(['user', 'member'])->select('*')->orderByDesc('id');
        return Datatables::of($refund)
            ->editColumn('user_id', function ($refund) {
                return $this->actionCurd($refund, 'admin.refund.getEdit', '', 'user');
            })->editColumn('member_id', function ($refund) {
                return $refund->member->name ?? "Không xác định";
            })->editColumn('created_at', function ($refund) {
                return $refund->created_at->format('d/m/Y H:i:s');
            })->editColumn('total', function ($refund) {
                return $this->formatNumber($refund->total);
            })->rawColumns(['user_id'])->make(true);
    }

    protected function dataDetail($id, BillRepositoryEloquent $refundRepository, MedicinesRepositoryEloquent $medicinesRepository)
    {
        $refund = $this->refundRepository->with(['medicines'])->find($id);
        $medicine = $refund->medicines;
        return Datatables::of($medicine)
            ->editColumn('unit_id', function ($medicine) {
                $unit = Unit::find($medicine->pivot->unit_id);
                if (is_object($unit)) {
                    return $unit->name;
                }
                return "";
            })->editColumn('amount', function ($medicine) {
                return $this->formatNumber($medicine->pivot->amount??0);
            })->editColumn('price', function ($medicine) {
                return $this->formatNumber($medicine->pivot->price??0);
            })->editColumn('total_price', function ($medicine) {
                return $this->formatNumber($medicine->pivot->total_price??0);
            })->make(true);
    }

    protected function getEdit($id)
    {
        if (isset($id)) {
            $data['refund'] = $this->refundRepository->with('medicines')->find($id);
            return view('admins.contents.refunds.edit', $data);
        }
    }

    protected function getAdd()
    {
        return view('admins.contents.refunds.add');
    }

    protected function postAdd(Request $request)
    {
        $importMedicine = $importRepository->create([
            'user_id' => 1,
        ]);
        if ($importMedicine) {
            $amounts = $request->get("amounts");
            $units = $request->get("units");
            $notes = $request->get("notes");
            $import_medicines =[];
            if (!empty($amounts)){
                foreach($amounts as $key=>$amount){
                    $import_medicines[]=[
                        'amount'=>$amount,
                        'unit'=>$units[$key],
                        'note'=>$notes[$key]
                    ];
                }
            }
            $dataAttach = array_combine($request->get("medicine_id"),$import_medicines);
            $importMedicine->medicines()->attach($dataAttach);
            Alert::success('Thành công', 'Thêm mới thành công');
            return redirect(route('admin.import_medicine.getIndex'));
        } else {
            Alert::error('Lỗi', 'Có lỗi xảy ra!');
            return redirect()->back();
        }
    }
}

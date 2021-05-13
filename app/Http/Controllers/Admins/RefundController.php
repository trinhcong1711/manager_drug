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
    public $billRepository;

    public function __construct(UnitRepositoryEloquent $unitRepository, RefundRepositoryEloquent $refundRepository, BillRepositoryEloquent $billRepository)
    {
        $this->refundRepository = $refundRepository;
        $this->unitRepository = $unitRepository;
        $this->billRepository = $billRepository;
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

    protected function postAdd($bill_id, Request $request)
    {
        $bill = $this->billRepository->find($bill_id);
        $update_0 = $bill->medicines()->updateExistingPivot($request->get('medicine_ids'), ['status' => 0]);
        if ($update_0) {
            return response()->json([
                'status' => true,
                'message' => "Trả lại thành công!"
            ]);
        }
        $update = $bill->medicines()->updateExistingPivot($request->get('medicine_ids'), ['status' => 1]);
        if ($update) {
            return response()->json([
                'status' => true,
                'message' => "Hủy trả lại thuốc thành công!"
            ]);
        }
        return response()->json([
            'status' => false,
        ]);

    }
}

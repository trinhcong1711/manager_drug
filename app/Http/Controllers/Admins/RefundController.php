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
    public $billRepository;

    public function __construct(BillRepositoryEloquent $billRepository)
    {
        $this->billRepository = $billRepository;
    }

    protected function postAdd($bill_id, Request $request): \Illuminate\Http\JsonResponse
    {
        $bill = $this->billRepository->find($bill_id);
//        Trả lại thuốc
        $refund = $this->actionRefund($bill, $request->get('medicine_ids'), 1, 0);
        if ($refund) {
            return response()->json([
                'status' => true,
                'message' => "Trả lại thuốc thành công!"
            ]);
        }
//       Hủy trả lại thuốc
        $cancel_refund = $this->actionRefund($bill, $request->get('medicine_ids'), 0, 1);
        if ($cancel_refund) {
            return response()->json([
                'status' => true,
                'message' => "Hủy trả lại thuốc thành công!"
            ]);
        }
        return response()->json([
            'status' => false
        ]);
    }

    private function actionRefund($bill, $medicine_ids, $status, $status_update): bool
    {
        $bill_medicine = $bill->medicines()->wherePivotIn('medicine_id', $medicine_ids)->wherePivot('status', $status);
        $medicine_ids_refund = $bill_medicine->pluck('medicine_id')->toArray();
        $price_refund = $bill_medicine->sum('total_price');
        if ($status_update == 0) {
            $total_bill = $bill->total - $price_refund;
        } else {
            $total_bill = $bill->total + $price_refund;
        }
        $update = $bill->medicines()->updateExistingPivot($medicine_ids_refund, ['status' => $status_update]);
        if ($update) {
            $bill->update(['total' => $total_bill]);
            return true;
        }
        return false;
    }
}

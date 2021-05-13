<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\CURD\CURDController;
use App\Repositories\BillRepositoryEloquent;
use App\Repositories\MedicinesRepositoryEloquent;
use App\Repositories\UnitRepositoryEloquent;
use Yajra\DataTables\DataTables;

class BillController extends CURDController
{
    public $unitRepository;

    public function __construct(UnitRepositoryEloquent $unitRepository)
    {
        $this->unitRepository = $unitRepository;
    }

    protected function getIndex()
    {
        return view('admins.contents.bills.list');
    }

    protected function data(BillRepositoryEloquent $billRepository)
    {
        $bill = $billRepository->with(['user', 'member'])->select('*')->orderByDesc('id');
        return Datatables::of($bill)
            ->editColumn('user_id', function ($bill) {
                return '<div class="item_name">
                        <a href="' . route('admin.bill.getEdit', $bill->id) . '">' . ($bill->user->name ?? 'Không rõ') . '</a>
                        <span class="tool_tip_item_name">
                            <a href="' . route('admin.bill.getEdit', $bill->id) . '">Chi tiết</a>
                        </span>
                    </div>';
            })->editColumn('member_id', function ($bill) {
                return $bill->member->name ?? "Không xác định";
            })->editColumn('created_at', function ($bill) {
                return $bill->created_at->format('d/m/Y H:i:s');
            })->editColumn('total', function ($bill) {
                return $this->formatNumber($bill->total);
            })->rawColumns(['user_id'])->make(true);
    }

    protected function dataDetail($id, BillRepositoryEloquent $billRepository, MedicinesRepositoryEloquent $medicinesRepository)
    {
        $bill = $billRepository->with(['medicines', 'refunds'])->find($id);

        $medicine = $bill->medicines;
        return Datatables::of($medicine)
            ->setRowClass(function ($medicine) {
                return $medicine->pivot->status == 0 ? 'alert-danger' : '';
            })
            ->addColumn('checkbox', function ($medicine) {
                return $this->checkboxMulti($medicine);
            })
            ->editColumn('unit_id', function ($medicine) {
                return $medicine->pivot->unit_name ?? "";
            })->editColumn('amount', function ($medicine) {
                return $this->formatNumber($medicine->pivot->amount ?? 0);
            })->editColumn('price', function ($medicine) {
                return $this->formatNumber($medicine->pivot->price ?? 0);
            })->editColumn('total_price', function ($medicine) {
                return $this->formatNumber($medicine->pivot->total_price ?? 0);
            })->editColumn('status', function ($medicine) {
                return $medicine->pivot->status == 1 ? "Đã bán" : "Trả lại";
            })->rawColumns(['checkbox'])->make(true);
    }

    protected function getEdit($id, BillRepositoryEloquent $billRepository)
    {
        if (isset($id)) {
            $data['bill'] = $billRepository->with('medicines')->find($id);
            return view('admins.contents.bills.edit', $data);
        }
    }


}

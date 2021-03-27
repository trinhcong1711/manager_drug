<?php

namespace App\Imports;

use App\Entities\Medicine;
use App\Entities\Unit;
use App\Http\Controllers\CURD\CURDController;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class MedicineImport extends CURDController implements WithHeadingRow, WithChunkReading, ToCollection
{
    public function headingRow(): int
    {
        return 1;
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $k => $row) {

            $medicine = Medicine::where('name', $row['ten'])->first();
            if (!is_object($medicine)) {
                $create = Medicine::create(
                    [
                        'name' => $row['ten'],
                        'package' => $row['quy_cach_dong_goi'],
                        'inventory' => is_int($row['ton_kho']) ? $row['ton_kho'] : 0,
                        'rest' => is_int($row['dinh_muc_ton']) ? $row['dinh_muc_ton'] : 1,
                    ]
                );
                if ($create) {
                    $units = explode(',', str_replace(" ", "", $row['don_vi_quy_doi']));
                    foreach ($units as $unit) {
                        $uni = explode("-", $unit);
                        if (!empty($uni[1])) {
                            Unit::create([
                                'medicine_id' => $create->id,
                                'name' => $uni[1],
                                'convert' => $uni[0] ?? 0,
                                'price' => $uni[2] ?? 0,
                            ]);
                        }
                    }
                }
            } else {
                $medicine->update(
                    [
                        'name' => $row['ten'],
                        'package' => $row['quy_cach_dong_goi'],
                        'inventory' => is_int($row['ton_kho']) ? $row['ton_kho'] : 0,
                        'rest' => is_int($row['dinh_muc_ton']) ? $row['dinh_muc_ton'] : 1,
                    ]
                );
                $unitsExcel = explode(',', str_replace(" ", "", $row['don_vi_quy_doi']));
                $units = $medicine->units;
                $a = [];
                foreach ($units as $unit) {
                    $price = $unit->price != 0 ? "-" . $unit->price : "";
                    $a[] = $unit->convert . "-" . $unit->name . $price;
                }
//              Tạo mới những đơn vị tính chưa có
                $dataUnitCreate = array_diff($unitsExcel, $a);
                if (!empty($dataUnitCreate)) {
                    foreach ($dataUnitCreate as $unit) {
                        $uni = explode("-", $unit);
                        if (!empty($uni[1])) {
                            Unit::create([
                                'medicine_id' => $medicine->id,
                                'name' => $uni[1],
                                'convert' => $uni[0] ?? 0,
                                'price' => $uni[2] ?? 0,
                            ]);
                        }
                    }
                }
//                Cập nhật status lại những đợn vị tính không dùng nữa
                $dataUnitUpdate = array_diff($a, $unitsExcel);
                if (!empty($dataUnitUpdate)) {
                    foreach ($dataUnitUpdate as $unit) {
                        $uni = explode("-", $unit);
                        $updateUnit = Unit::where([
                            'medicine_id' => $medicine->id,
                            'name' => $uni[1],
                            'convert' => $uni[0] ?? 0,
                            'price' => $uni[2] ?? 0,
                            'status' => 1,
                        ])->first();
                        if (is_object($updateUnit)) {
                            $updateUnit->update(['status' => 0]);
                        }
                    }
                }


            }


        }
    }
//    public function model(array $row)
//    {
//        $curd = new CURDController();
//        $unit = explode(',',$row['don_vi_tinh']);
//        $convert = explode(',',$row['don_vi_quy_doi']);
//        $price = explode(',',$row['gia_ban']);
//        $prices = $curd->formatPriceSave($unit,$convert,$price);
//        return new Medicine([
//            'name'=>$row['ten'],
//            'slug'=>Str::slug($row['ten']),
//            'amount'=>$row['ham_luong'],
//            'exp'=>date('Y-m-d',strtotime($row['han_su_dung'])),
//            'package'=>$row['quy_cach_dong_goi'],
//            'inventory'=>$row['ton_kho'],
//            'price_import'=>$row['gia_nhap'],
//            'price'=>$prices,
//            'sold'=>$row['so_luong_da_ban'],
//            'status'=>$row['trang_thai'],
//        ]);
//    }
    public function chunkSize(): int
    {
        return 1000;
    }
}

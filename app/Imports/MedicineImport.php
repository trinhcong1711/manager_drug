<?php

namespace App\Imports;

use App\Entities\Medicine;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Http\Controllers\CURD\CURDController;


class MedicineImport extends CURDController implements ToModel, WithHeadingRow, WithChunkReading
{
    public function headingRow() : int
    {
        return 1;
    }
    public function model(array $row)
    {
        $curd = new CURDController();
        $unit = explode(',',$row['don_vi_tinh']);
        $convert = explode(',',$row['don_vi_quy_doi']);
        $price = explode(',',$row['gia_ban']);
        $prices = $curd->formatPriceSave($unit,$convert,$price);
        return new Medicine([
            'name'=>$row['ten'],
            'slug'=>Str::slug($row['ten']),
            'amount'=>$row['ham_luong'],
            'exp'=>date('Y-m-d',strtotime($row['han_su_dung'])),
            'package'=>$row['quy_cach_dong_goi'],
            'inventory'=>$row['ton_kho'],
            'price_import'=>$row['gia_nhap'],
            'price'=>$prices,
            'sold'=>$row['so_luong_da_ban'],
            'status'=>$row['trang_thai'],
        ]);
    }
    public function chunkSize(): int
    {
        return 1000;
    }
}

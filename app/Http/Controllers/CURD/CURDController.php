<?php

namespace App\Http\Controllers\CURD;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CURDController extends Controller
{
/*
 * Hàm đinh dạng số
 * $int : int
 */
    protected function formatNumber($int=false)
    {
        if ($int && is_numeric($int)){
            return number_format($int, '0', '', '.');
        }else{
            return 0;
        }

    }

    /* Hàm định dạng lại ngày/tháng/năm khi lưu vào Database
     * return: date Y-m-d;
     */
    protected function jsonDateSave($date = false)
    {
        if ($date) {
            return date('Y-m-d', strtotime($date));
        } else {
            return date('Y-m-d');
        }

    }
}

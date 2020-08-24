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
    protected function formatNumber($int = false)
    {
        if ($int && is_numeric($int)) {
            return number_format($int, '0', '', '.');
        } else {
            return 0;
        }
    }

    /*
     * Hàm format Giá bán
     * $int : int
     */
    protected function formatPrice($json)
    {
        if ($json) {
            $prices = (array)json_decode($json);
            $html = '<table>';
            if (count($prices) > 0) {
                foreach ($prices['unit'] as $k => $price) {
                    $html .= '<tr>
                            <td class="border-top-0 p-0">' . $this->formatNumber($prices['convert'][$k]) . '</td>
                            <td class="border-top-0 p-0 pr-1 text-capitalize">' . $prices['unit'][$k] . ':</td>
                            <td class="border-top-0 p-0">' . $this->formatNumber($prices['price'][$k]) . '</td>
                        </tr>';
                }
            }
            $html .= '</table>';
            return $html;
        } else {
            return '';
        }
    }

    /*
     * Hàm Hiển thị trạng thái
     * $int : int
     */
    protected function showStatus($status)
    {
        $show = ($status == 1) ? "check" : "minus";
        $html = '<i class="icon icon-' . $show . '" style="font-size: 24px;"></i>';
        return $html;
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

    /*
     *Hàm chọn nhiều dòng
     */
    protected function checkboxMulti($collection)
    {
        if ($collection) {
            return '<th scope="row">
                        <label class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" name="select_id[]" value="' . $collection->id . '" checked="">
                            <span class="custom-control-label"></span>
                        </label>
                    </th>';
        } else {
            return '';
        }
    }

    /*
     *Hàm hiển thị nút thêm sửa xóa.
     */
    protected function actionCurd($collection, $nameRouteEdit, $nameRouteDelete)
    {
        if ($collection) {
            return '<div class="item_name">
                        <a href="' . route($nameRouteEdit, $collection->id) . '">' . $collection->name . '</a>
                        <span class="tool_tip_item_name">
                            <a href="' . route($nameRouteEdit, $collection->id) . '">Sửa</a>
                            <a href="' . route($nameRouteDelete, $collection->id) . '">Xóa</a>
                        </span>
                    </div>';
        } else {
            return '';
        }
    }

    /*
     *Hàm format ngày/tháng/năm.
     */
    protected function formatDate($date)
    {
        if ($date) {
            return date('d/m/Y', strtotime($date));
        } else {
            return '';
        }
    }
}

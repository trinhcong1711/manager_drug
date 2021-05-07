<?php

namespace App\Http\Controllers\CURD;

use App\Http\Controllers\Controller;

class CURDController extends Controller
{
    /*
     * Hàm đinh dạng số
     * $int : int
     * return: int
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
     * Hàm format Giá bán để hiển thị ra trang danh sách thuốc
     * $int : int
     * return: string
     */
    protected function formatPrice($prices)
    {
        if ($prices) {
            $html = '';
            if (count($prices) > 0 && !empty($prices)) {
                $html = '<table>';
                foreach ($prices as $k => $price) {
                    $html .= '<tr>
                            <td class="border-top-0 p-0">' . $this->formatNumber($price->convert) . ' </td>
                            <td class="border-top-0 p-0 pr-1 text-capitalize">' . $price->name . ':</td>
                            <td class="border-top-0 p-0">' . $this->formatNumber($price->price) . '</td>
                        </tr>';
                }
                $html .= '</table>';
            }
            return $html;
        } else {
            return '';
        }
    }

    /*
     * Hàm format Giá bán để lưu vào DB
     * $int : int
     * return: array
     */
    protected function formatPriceSave($units, $converts, $prices)
    {
        $arr['unit'] = $units;
        $arr['convert'] = $converts;
        $arr['price'] = $prices;
        $price = json_encode($arr);
        return $price;
    }

    /*
     * Hàm Hiển thị trạng thái
     * $int : int
     * return: string
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
     *
     * return: string
     */
    protected function checkboxMulti($collection)
    {
        if ($collection) {
            return '<th scope="row">
                        <label class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input select_row" name="select_row" value="' . $collection->id . '">
                            <span class="custom-control-label"></span>
                        </label>
                    </th>';
        } else {
            return '';
        }
    }

    /*
     *Hàm hiển thị nút thêm sửa xóa.
     * return: string
     */
    protected function actionCurd($collection, $nameRouteEdit, $nameRouteDelete = "", $relation = false)
    {
        if ($collection) {
            $delete = "";
            if ($nameRouteDelete != "") {
                $delete = " <a href='" . route($nameRouteDelete, $collection->id) . "'>Xóa</a>";
            }
            if ($relation) {
                $name = $relation && is_object($collection->{$relation}) ? $collection->{$relation}->name : 'Không rõ';
                return '<div class="item_name">
                        <a href="' . route($nameRouteEdit, $collection->id) . '">' . $name . '</a>
                        <span class="tool_tip_item_name">
                            <a href="' . route($nameRouteEdit, $collection->id) . '">Sửa</a>
                            <a href="' . route('admin.import_medicine.getCheckMedicine', $collection->id) . '">Kiểm hàng</a>
                            ' . $delete . '
                        </span>
                    </div>';
            }
            return '<div class="item_name">
                        <a href="' . route($nameRouteEdit, $collection->id) . '">' . $relation ? $collection->name : $collection->name . '</a>
                        <span class="tool_tip_item_name">
                            <a href="' . route($nameRouteEdit, $collection->id) . '">Sửa</a>
                            ' . $delete . '
                        </span>
                    </div>';

        } else {
            dd(12);
            return "";
        }
    }

    /*
     *Hàm format ngày/tháng/năm.
     * return: date - d/m/Y
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

<?php
//  Hàm tìm kiếm thuốc
if (!function_exists('search_medicine')) {
    function search_medicine($keyword, $medicinesRepository): array
    {
        $data = [];
        if (!empty($keyword)) {
            $medicines = $medicinesRepository->select('name', 'inventory', 'id')
                ->where('name', 'like', "%" . $keyword . "%")
                ->where('status', 1)
                ->with('units')->get();
            if ($medicines->count() > 0) {
                $data['medicines'] = $medicines;
            }
        }
        return $data;
    }
}
//  Hàm xảy ra khi click chọn thuốc từ danh sách tìm kiếm thuốc
if (!function_exists('select_medicine_from_search_box')) {
    function select_medicine_from_search_box($medicine_id, $id_selected, $medicines): array
    {
        $data = [];
        $check_exits = strpos($id_selected, "|" . $medicine_id . "|");
        if ($check_exits === false) {
            $medicine = $medicines->select('name', 'inventory', 'status', 'package', 'id')->with('units')
                ->find($medicine_id);
            if (is_object($medicine) && ($medicine->status == 1)) {
                $data['medicine'] = $medicine;
            }
        }
        return $data;
    }
}
//  Hiển thị giá trị trạng thái
if (!function_exists('show_status')) {
    function show_status($status = [], $check = null): string
    {
        $html = "";
        if (!empty($status)) {
            if (array_key_exists($check,$status)) {
                $html = $status[$check];
            }
        }
        return $html;
    }
}

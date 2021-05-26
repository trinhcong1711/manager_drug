<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();


Route::group(['prefix'=>'admin', "middleware"=>"auth"], function () {

    Route::get('/sell',  'Sells\SellController@getIndex')->name('sell.getIndex');
    Route::post('/sell',  'Sells\SellController@postSell')->name('sell.postSell');
    Route::get('/sell/ajax-search-medicine',  'Sells\SellController@ajaxSearchMedicine')->name('sell.ajax.ajaxSearchMedicine');
    Route::get('/sell/ajax-sell-add-medicine',  'Sells\SellController@ajaxSellAddMedicine')->name('sell.ajax.ajaxSellAddMedicine');

    Route::get('/medicine', 'Admins\MedicineController@getIndex')->name('admin.medicine.getIndex');
    Route::get('/medicine/export', 'Admins\MedicineController@export')->name('admin.medicine.export');
    Route::get('/medicine/export-default', 'Admins\MedicineController@exportDefaultFile')->name('admin.medicine.exportDefaultFile');
    Route::post('/medicine/import', 'Admins\MedicineController@import')->name('admin.medicine.import');
    Route::get('/medicine/add', 'Admins\MedicineController@getAdd')->name('admin.medicine.getAdd');
    Route::post('/medicine/add', 'Admins\MedicineController@postAdd')->name('admin.medicine.postAdd');
    Route::get('/medicine/data', 'Admins\MedicineController@data')->name('admin.medicine.data');
    Route::get('/medicine/delete-multil', 'Admins\MedicineController@getDeleteMultil')->name('admin.medicine.getDeleteMultil');
    Route::get('/medicine/delete/{id}', 'Admins\MedicineController@getDelete')->name('admin.medicine.getDelete');
    Route::get('/medicine/{id}', 'Admins\MedicineController@getEdit')->name('admin.medicine.getEdit');
    Route::post('/medicine/{id}', 'Admins\MedicineController@postEdit')->name('admin.medicine.postEdit');

//Nhập hàng

    Route::get('/import-medicine/ajax-search-medicine', 'Admins\ImportMedicineController@ajaxSearchMedicine')->name('admin.import_medicine.ajaxSearchMedicine');
    Route::get('/import-medicine/ajax-add-import-medicine', 'Admins\ImportMedicineController@ajaxAddImportMedicine')->name('admin.import_medicine.ajaxAddImportMedicine');
    Route::get('/import-medicine/export-medicine', 'Admins\ImportMedicineController@export')->name('admin.import_medicine.export');

    Route::get('/import-medicine', 'Admins\ImportMedicineController@getIndex')->name('admin.import_medicine.getIndex');
    Route::get('/import-medicine/data', 'Admins\ImportMedicineController@data')->name('admin.import_medicine.data');
    Route::get('/import-medicine/add', 'Admins\ImportMedicineController@getAdd')->name('admin.import_medicine.getAdd');
    Route::post('/import-medicine/add', 'Admins\ImportMedicineController@postAdd')->name('admin.import_medicine.postAdd');
    Route::post('/import-medicine/add', 'Admins\ImportMedicineController@postAdd')->name('admin.import_medicine.postAdd');
    Route::get('/import-medicine/{id}', 'Admins\ImportMedicineController@getEdit')->name('admin.import_medicine.getEdit');
    Route::post('/import-medicine/{id}', 'Admins\ImportMedicineController@postEdit')->name('admin.import_medicine.postEdit');

//Xuất hàng
    Route::get('/export-medicine/ajax-add-export-medicine', 'Admins\ExportMedicineController@ajaxAddExportMedicine')->name('admin.export_medicine.ajaxAddExportMedicine');
    Route::get('/export-medicine/export-medicine', 'Admins\ExportMedicineController@export')->name('admin.export_medicine.export');
    Route::get('/export-medicine', 'Admins\ExportMedicineController@getIndex')->name('admin.export_medicine.getIndex');
    Route::get('/export-medicine/data', 'Admins\ExportMedicineController@data')->name('admin.export_medicine.data');
    Route::get('/export-medicine/add', 'Admins\ExportMedicineController@getAdd')->name('admin.export_medicine.getAdd');
    Route::post('/export-medicine/add', 'Admins\ExportMedicineController@postAdd')->name('admin.export_medicine.postAdd');
    Route::get('/export-medicine/{id}', 'Admins\ExportMedicineController@getEdit')->name('admin.export_medicine.getEdit');
    Route::post('/export-medicine/{id}', 'Admins\ExportMedicineController@postEdit')->name('admin.export_medicine.postEdit');


//Quyền
    Route::get('/permission', 'Admins\PermissionController@getIndex')->name('admin.permission.getIndex');
    Route::get('/permission/data', 'Admins\PermissionController@data')->name('admin.permission.data');
    Route::get('/permission/add', 'Admins\PermissionController@getAdd')->name('admin.permission.getAdd');
    Route::post('/permission/add', 'Admins\PermissionController@postAdd')->name('admin.permission.postAdd');
    Route::get('/permission/delete-multil', 'Admins\PermissionController@getDeleteMultil')->name('admin.permission.getDeleteMultil');
    Route::get('/permission/delete/{id}', 'Admins\PermissionController@getDelete')->name('admin.permission.getDelete');
    Route::get('/permission/{id}', 'Admins\PermissionController@getEdit')->name('admin.permission.getEdit');
    Route::post('/permission/{id}', 'Admins\PermissionController@postEdit')->name('admin.permission.postEdit');

//Quyền
    Route::get('/role', 'Admins\RoleController@getIndex')->name('admin.role.getIndex');
    Route::get('/role/data', 'Admins\RoleController@data')->name('admin.role.data');
    Route::get('/role/add', 'Admins\RoleController@getAdd')->name('admin.role.getAdd');
    Route::post('/role/add', 'Admins\RoleController@postAdd')->name('admin.role.postAdd');
    Route::get('/role/delete-multil', 'Admins\RoleController@getDeleteMultil')->name('admin.role.getDeleteMultil');
    Route::get('/role/delete/{id}', 'Admins\RoleController@getDelete')->name('admin.role.getDelete');
    Route::get('/role/{id}', 'Admins\RoleController@getEdit')->name('admin.role.getEdit');
    Route::post('/role/{id}', 'Admins\RoleController@postEdit')->name('admin.role.postEdit');
//Đơn hàng
    Route::get('/bill', 'Admins\BillController@getIndex')->name('admin.bill.getIndex');
    Route::get('/bill/data', 'Admins\BillController@data')->name('admin.bill.data');
    Route::get('/bill_detail/data/{id}', 'Admins\BillController@dataDetail')->name('admin.bill_detail.dataDetail');
    Route::get('/bill/{id}', 'Admins\BillController@getEdit')->name('admin.bill.getEdit');
//Đơn trả lại
    Route::post('/refund/add/{bill_id}', 'Admins\RefundController@postAdd')->name('admin.refund.postAdd');

});
Route::get('/nhan-vien', function () {
    return view('admins.contents.employees.list');
});


Route::get('/home', 'HomeController@index')->name('home');
//Route::get('/setting', 'Admin\HomeController@getIndex')->name('home1');
//Route::get('/', 'HomeController@index');

Route::get('/home', 'HomeController@index')->name('home');

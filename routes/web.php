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

Route::get('/', function () {
    return view('index');
});

Route::get('/ban-hang', function () {
    return view('admins.contents.cart');
});

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

Route::get('/import-medicine', 'Admins\ImportMedicineController@getIndex')->name('admin.import_medicine.getIndex');
Route::get('/import-medicine/data', 'Admins\ImportMedicineController@data')->name('admin.import_medicine.data');
Route::get('/import-medicine/add', 'Admins\ImportMedicineController@getAdd')->name('admin.import_medicine.getAdd');
Route::post('/import-medicine/add', 'Admins\ImportMedicineController@postAdd')->name('admin.import_medicine.postAdd');
Route::get('/import-medicine/check/{id}', 'Admins\ImportMedicineController@getCheckMedicine')->name('admin.import_medicine.getCheckMedicine');
Route::post('/import-medicine/check/{id}', 'Admins\ImportMedicineController@postCheckMedicine')->name('admin.import_medicine.postCheckMedicine');
Route::post('/import-medicine/add', 'Admins\ImportMedicineController@postAdd')->name('admin.import_medicine.postAdd');
Route::get('/import-medicine/{id}', 'Admins\ImportMedicineController@getEdit')->name('admin.import_medicine.getEdit');
Route::post('/import-medicine/{id}', 'Admins\ImportMedicineController@postEdit')->name('admin.import_medicine.postEdit');

Route::get('/import-medicine/ajax-search-medicine', 'Admins\ImportMedicineController@ajaxSearchMedicine')->name('admin.import_medicine.ajaxSearchMedicine');


Route::get('/nhap-hang/them', function () {
    return view('admins.contents.import_medicines.add');
});
Route::get('/nhap-hang/{id}', function () {
    return view('admins.contents.import_medicines.edit');
});


Route::get('/xuat-hang/', function () {
    return view('admins.contents.export_product.list');
});
Route::get('/xuat-hang/them', function () {
    return view('admins.contents.export_product.add');
});
Route::get('/xuat-hang/{}', function () {
    return view('admins.contents.export_product.edit');
});

Route::get('/kiem-kho', function () {
    return view('admins.contents.inventory.list');
});

Route::get('/kiem-kho/them', function () {
    return view('admins.contents.inventory.add');
});
Route::get('/kiem-kho/{id}', function () {
    return view('admins.contents.inventory.edit');
});

Route::get('/hoa-don', function () {
    return view('admins.contents.bills.list');
});
Route::get('/hoa-don/them', function () {
    return view('admins.contents.bills.add');
});
Route::get('/hoa-don/{id}', function () {
    return view('admins.contents.bills.edit');
});
Route::get('/nhan-vien', function () {
    return view('admins.contents.employees.list');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//Route::get('/setting', 'Admin\HomeController@getIndex')->name('home1');
//Route::get('/', 'HomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

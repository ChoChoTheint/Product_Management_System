<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});
//login view
Route::get('login', function () {
    return view('login.login');
});
//login success with list page
Route::post('index', 'EmployeeController@index')->name('employee');
//login view
Route::get('logout', 'EmployeeController@logout')->name('logout');

//list page
Route::get('index', 'ItemController@index')->name('index');
//normal register view
Route::get('normalRegister', 'ItemController@create')->name('normalRegister');
//normal register create
Route::post('store', 'ItemController@store')->name('store');
//excel download view
Route::get('excelUpload', 'ItemController@excelDownload')->name('excelUpload');
//search item
Route::get('searchData', 'ItemController@search')->name('searchData');
//delete item
Route::post('deleteItem/{id}', 'ItemController@destory')->name('deleteItem');
//detail item
Route::get('showDetailItem/{id}', 'ItemController@showDetail')->name('showDetailItem');
//active and inactive btn
Route::post('/items/toggleInactive', 'ItemController@toggleInactive')->name('toggleInactive');
Route::post('/items/toggleActive', 'ItemController@toggleActive')->name('toggleActive');
//item edit
Route::get('edit/{id}','ItemController@editItem')->name('itemEdit');
//item update
Route::post('update/{id}','ItemController@updateItem')->name('itemUpdate');


//category create
Route::post('category-store', 'CategoryController@store')->name('categories.store');
//category delete
Route::post('category-destory', 'CategoryController@destory')->name('categories.destory');


//excel download
Route::get('export-excel', 'ExportImportController@exportData')->name('excelDownload');
//excel upload
Route::post('import-excel', 'ExportImportController@importData')->name('importExcel');


//pdf download for items
Route::get('generate-pdf','PdfController@generatePDF')->name('generatePDF');
//excel download for items
Route::get('generate-excel','ExportImportController@generateExcel')->name('generateExcelDownload');


//language change 
Route::group(['middleware' => ['web']], function () {
    Route::get('lang/{locale}', 'LanguageController@switchLang')->name('lang.switch');
});

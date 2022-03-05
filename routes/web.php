<?php

use Illuminate\Support\Facades\Auth;
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
    return view('auth.login');
});


Auth::routes();


Route::group(['middleware'=> ['auth','DisabledAccount'],'namespace'=>'App\Http\Controllers'],function (){

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


    Route::resource('invoices', 'InvoiceController');

    Route::resource('sections', 'SectionController');

    Route::resource('InvoiceAttachments', 'InvoiceAttachmentController');

    Route::get('section/{sections_id}','InvoiceController@getAllSections');

    Route::get('InvoicesDetails/{sections_id}','InvoiceDetailController@edit');

    Route::resource('products', 'ProductController');

    Route::get('download/{invoice_number}/{file_name}', 'InvoiceDetailController@get_file');

    Route::get('View_file/{invoice_number}/{file_name}', 'InvoiceDetailController@open_file');

    Route::post('delete_file', 'InvoiceDetailController@destroy')->name('delete_file');

    Route::get('/edit_invoice/{id}', 'InvoiceController@edit');

    Route::get('/Status_show/{id}', 'InvoiceController@show')->name('Status_show');

    Route::post('/Status_Update/{id}', 'InvoiceController@Status_Update')->name('Status_Update');

    Route::resource('Invoice_Archive', 'InvoiceArchiveController');

    Route::get('Invoice_Paid','InvoiceController@Invoice_Paid');

    Route::get('Invoice_Partial','InvoiceController@Invoice_Partial');

    Route::get('Invoice_UnPaid','InvoiceController@Invoice_UnPaid');

    Route::get('Print_invoice/{id}','InvoiceController@Print_invoice');

    Route::get('invoiceExport', 'InvoiceController@export');

    Route::group(['middleware' => ['auth']], function() {

        Route::resource('roles','RoleController');

        Route::resource('users','UserController');

    });
    Route::get('invoices_report', 'InvoiceReportController@index');

    Route::post('Search_invoices', 'InvoiceReportController@Search_invoices');

    Route::get('customers_report', 'InvoiceCustomerController@index')->name("customers_report");

    Route::post('Search_customers', 'InvoiceCustomerController@Search_customers');

    Route::get('MarkAsRead_all','InvoiceController@MarkAsRead_all')->name('MarkAsRead_all');

    Route::get('unreadNotifications_count', 'InvoiceController@unreadNotifications_count')->name('unreadNotifications_count');









});
Route::get('status','App\Http\Controllers\InvoiceController@lol');

Route::get('/baned', [App\Http\Controllers\HomeController::class, 'baned'])->name('baned');


Route::get('/{page}', 'App\Http\Controllers\AdminController@index');


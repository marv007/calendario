<?php
use App\Http\Controllers\LanguageController;
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
// dashboard Routes
Route::get('/','HomeController@index');
Route::get('/sk-layout-1-column','StarterKitController@column_1Sk');
Route::get('/sk-layout-2-columns','StarterKitController@columns_2Sk');
Route::get('/fixed-navbar','StarterKitController@fix_navbar');
Route::get('/sk-layout-fixed','StarterKitController@fix_layout');
Route::get('/sk-layout-static','StarterKitController@static_layout');

// locale Route
Route::get('lang/{locale}',[LanguageController::class,'swap']);

// acess controller
Route::get('/access-control', 'AccessController@index');
Route::get('/access-control/{roles}', 'AccessController@roles');
Route::get('/ecommerce', 'AccessController@home')->middleware('role:Admin');

//custom routes
Route::get('/home', 'HomeController@index');
Route::get('/calendar', 'CalendarController@index')->name('calendar');
Route::get('/getcalendar', 'CalendarController@get')->name('getcalendar');
Route::get('/customers', 'CustomerController@index')->name('customers');
Route::get('/viewcustomer/{id}', 'CustomerController@viewCustomer')->name('viewcustomer');
Route::get('/viewcustomer/save/{id}', 'CustomerController@saveCustomer')->name('savecustomer');
Route::get('/editcustomer/{id}', 'CustomerController@editCustomer')->name('editcustomer');
Route::get('/reservations/customer/{id}', 'ReservationController@index')->name('reservations');

Route::get('/services', 'ServiceController@index')->name('services');
Route::get('/addservice', 'ServiceController@addservice')->name('addservice');
Route::get('/viewservice/{id}', 'ServiceController@viewservice')->name('viewservice');
Route::get('/viewservice/save/{id}', 'ServiceController@saveservice')->name('saveservice');
Route::get('/editservice/{id}', 'ServiceController@editservice')->name('editservice');

Route::post('/reservations/customer/{id}', 'ReservationController@indexfilter')->name('reservationsfiltered');
Route::post('/updatecustomer', 'CustomerController@update')->name('updatecustomer');
Route::post('/deletecustomer', 'CustomerController@delete')->name('deletecustomer');
Route::post('/deleteservice', 'ServiceController@delete')->name('deleteservice');
Route::post('/updateservice', 'ServiceController@update')->name('updateservice');
Auth::routes();
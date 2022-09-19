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
   return redirect()->route('login');
});

Auth::routes();

Route::group(['as'=>'admin.','prefix' => 'admin','middleware' => ['auth', 'isAdmin']], function () {



   Route::get('/home', 'HomeController@index')->name('home');


   Route::resource('employee', 'superadmin\EmployeeController');



   // Route::get('/add_employee', 'superadmin\EmployeeController@index')->name('add_employee');
   // Route::post('/store_employee', 'superadmin\EmployeeController@store')->name('store_employee');
   // Route::get('/show_employee', 'superadmin\EmployeeController@show')->name('show_employee');





});


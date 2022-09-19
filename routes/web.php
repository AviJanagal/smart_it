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

});

Route::group(['as'=>'employee.','prefix' => 'employee','middleware' => ['auth', 'employee']], function () {
   Route::resource('employee','employee\EmployeeController');
   Route::post('log_in_time', 'employee\EmployeeController@log_in_time')->name('log_in_time');
   Route::post('log_out_time', 'employee\EmployeeController@log_out_time')->name('log_out_time');
   Route::get('default_log_in_time', 'employee\EmployeeController@default_log_in_time')->name('default_log_in_time');
   Route::get('attendance_history', 'employee\EmployeeController@attendance_history')->name('attendance_history');
   Route::get('daily_activity', 'employee\EmployeeController@daily_activity')->name('daily_activity');
   
});

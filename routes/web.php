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
   Route::get('/view_employee/{id}', 'superadmin\EmployeeController@view_employee')->name('view_employee');
   Route::get('/del_emp_assigned_project/{id}', 'superadmin\EmployeeController@del_emp_assigned_project')->name('del_emp_assigned_project');


   Route::get('emp_graph', 'superadmin\EmployeeController@emp_graph')->name('emp_graph');
    Route::any('emp_graph_search_status/{id}', 'superadmin\EmployeeController@emp_graph_search_status')->name('emp_graph_search_status');
    Route::any('emp_graph_search_report/{id}', 'superadmin\EmployeeController@emp_graph_search_report')->name('emp_graph_search_report');

   


   
   Route::resource('client', 'superadmin\ClientController');
   Route::resource('project', 'superadmin\ProjectController');
   Route::get('/get_project_assign', 'superadmin\ProjectController@get_project_assign')->name('get_project_assign');
   Route::post('/store_assigned_projects', 'superadmin\ProjectController@store_assigned_projects')->name('store_assigned_projects');
   Route::get('edit_assigned_projects/{id}','superadmin\ProjectController@edit_assigned_projects')->name('edit_assigned_projects');
   Route::get('delete_assigned_project/{id}','superadmin\ProjectController@delete_assigned_project')->name('delete_assigned_project');


});

Route::group(['as'=>'employee.','prefix' => 'employee','middleware' => ['auth', 'employee']], function () {
   Route::resource('employee','employee\EmployeeController');
   Route::post('log_in_time', 'employee\EmployeeController@log_in_time')->name('log_in_time');
   Route::post('log_out_time', 'employee\EmployeeController@log_out_time')->name('log_out_time');
   Route::get('default_log_in_time', 'employee\EmployeeController@default_log_in_time')->name('default_log_in_time');
   Route::get('attendance_history', 'employee\EmployeeController@attendance_history')->name('attendance_history');
   Route::get('daily_activity', 'employee\EmployeeController@daily_activity')->name('daily_activity');
   Route::post('add_daily_activity', 'employee\EmployeeController@add_daily_activity')->name('add_daily_activity');
   Route::get('finish_daily_activity', 'employee\EmployeeController@finish_daily_activity')->name('finish_daily_activity');
   Route::get('all_daily_activities', 'employee\EmployeeController@all_daily_activities')->name('all_daily_activities');
   Route::post('attendance_filter', 'employee\EmployeeController@attendance_filter')->name('attendance_filter');
   Route::post('activity_filter', 'employee\EmployeeController@activity_filter')->name('activity_filter');
   Route::get('graphs', 'employee\EmployeeController@graphs')->name('graphs');
   Route::post('graph_time', 'employee\EmployeeController@graph_time')->name('graph_time');
   
});

// Route::group(['as'=>'employee.','prefix' => 'employee','middleware' => ['auth', 'employee']], function () {
//    Route::resource('employee','employee\EmployeeController');
//    Route::post('log_in_time', 'employee\EmployeeController@log_in_time')->name('log_in_time');
//    Route::post('log_out_time', 'employee\EmployeeController@log_out_time')->name('log_out_time');
//    Route::get('default_log_in_time', 'employee\EmployeeController@default_log_in_time')->name('default_log_in_time');
//    Route::get('attendance_history', 'employee\EmployeeController@attendance_history')->name('attendance_history');
//    Route::get('daily_activity', 'employee\EmployeeController@daily_activity')->name('daily_activity');
   
// });

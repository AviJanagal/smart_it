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

   Route::get('/show_department', 'superadmin\EmployeeController@show_department')->name('show_department');
   Route::post('/add_department', 'superadmin\EmployeeController@add_department')->name('add_department');
   Route::get('/edit_department/{id}', 'superadmin\EmployeeController@edit_department')->name('edit_department');
   Route::post('/update_department/{id}', 'superadmin\EmployeeController@update_department')->name('update_department');
   Route::get('/delete_department/{id}', 'superadmin\EmployeeController@delete_department')->name('delete_department');

   

   Route::get('/show_emp_leave', 'superadmin\EmployeeController@show_emp_leave')->name('show_emp_leave');
   Route::get('view_emp_leave', 'superadmin\EmployeeController@view_emp_leave')->name('view_emp_leave');
   Route::post('leave_approvel', 'superadmin\EmployeeController@leave_approvel')->name('leave_approvel');


   Route::get('/del_emp_assigned_project/{id}', 'superadmin\EmployeeController@del_emp_assigned_project')->name('del_emp_assigned_project');
   Route::post('/employee_graph/{id}', 'superadmin\EmployeeController@employee_graph')->name('employee_graph');
   Route::resource('client', 'superadmin\ClientController');
   Route::resource('project', 'superadmin\ProjectController');
   Route::get('/get_project_assign', 'superadmin\ProjectController@get_project_assign')->name('get_project_assign');
   Route::post('/store_assigned_projects', 'superadmin\ProjectController@store_assigned_projects')->name('store_assigned_projects');
   Route::get('edit_assigned_projects/{id}','superadmin\ProjectController@edit_assigned_projects')->name('edit_assigned_projects');
   Route::get('delete_assigned_project/{id}','superadmin\ProjectController@delete_assigned_project')->name('delete_assigned_project');

   Route::resource('holidays','superadmin\HolidaysController');
   Route::resource('leave','superadmin\LeavesController');




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
   Route::get('calender', 'employee\EmployeeController@Chartjs')->name('calender');
   Route::get('apply_leave', 'employee\EmployeeController@apply_leave')->name('apply_leave');
   Route::post('send_leave', 'employee\EmployeeController@send_leave')->name('send_leave');
   Route::get('getMondays', 'employee\EmployeeController@getMondays')->name('getMondays');
   Route::get('my_profile', 'employee\EmployeeController@my_profile')->name('my_profile');
   Route::get('download_icard', 'employee\EmployeeController@download_icard')->name('download_icard');

});


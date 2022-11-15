<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/





Route::post('register', 'API\UserController@register');
Route::post('login', 'API\UserController@login');
Route::post('add_employee', 'API\UserController@add_employee')->name('add_employee');
Route::post('edit_employee', 'API\UserController@edit_employee');
Route::post('delete_employee', 'API\UserController@delete_employee');
Route::post('add_client', 'API\UserController@add_client');
Route::post('edit_client', 'API\UserController@edit_client');
Route::post('delete_client', 'API\UserController@delete_client');
Route::get('get_clients', 'API\UserController@get_clients');
Route::post('add_project', 'API\UserController@add_project');
Route::post('edit_project', 'API\UserController@edit_project');
Route::post('delete_project', 'API\UserController@delete_project');
Route::get('get_projects', 'API\UserController@get_projects');
Route::post('add_project_assign', 'API\UserController@add_project_assign');
Route::post('delete_project_assign', 'API\UserController@delete_project_assign');
Route::get('get_projects_assigned', 'API\UserController@get_projects_assigned');
Route::get('get_superadmin', 'API\UserController@get_superadmin');
Route::get('get_employee', 'API\UserController@get_employee');
Route::post('get_single_emp', 'API\UserController@get_single_emp');

Route::post('add_department', 'API\UserController@add_department');
Route::post('edit_department', 'API\UserController@edit_department');
Route::post('delete_department', 'API\UserController@delete_department');
Route::get('get_departments', 'API\UserController@get_departments');

Route::get('show_employee_leaves', 'API\UserController@show_employee_leaves');
Route::post('leave_approvel', 'API\UserController@leave_approvel');


Route::post('add_holiday', 'API\UserController@add_holiday');
Route::post('edit_holiday', 'API\UserController@edit_holiday');
Route::get('get_holidays', 'API\UserController@get_holidays');
Route::post('delete_holidays', 'API\UserController@delete_holidays');

Route::get('dashboard', 'API\UserController@dashboard');


Route::get('get_leaves', 'API\UserController@get_leaves');
Route::post('add_leaves', 'API\UserController@add_leaves');
Route::post('edit_leave', 'API\UserController@edit_leave');
Route::post('delete_leaves', 'API\UserController@delete_leaves');









Route::group(['middleware' => 'auth:api'], function () {

    Route::post('logout', 'API\UserController@logout');
});

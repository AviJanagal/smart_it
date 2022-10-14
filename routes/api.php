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





Route::post('register','API\UserController@register');
Route::post('login','API\UserController@login');
Route::post('add_employee','API\UserController@add_employee')->name('add_employee');
Route::post('add_client','API\UserController@add_client');
Route::post('edit_client','API\UserController@edit_client');
Route::post('delete_client','API\UserController@delete_client');
Route::get('get_clients','API\UserController@get_clients');
Route::post('add_project','API\UserController@add_project');
Route::post('edit_project','API\UserController@edit_project');
Route::post('delete_project','API\UserController@delete_project');
Route::get('get_projects','API\UserController@get_projects');
Route::post('add_project_assign','API\UserController@add_project_assign');
Route::post('delete_project_assign','API\UserController@delete_project_assign');
Route::get('get_projects_assigned','API\UserController@get_projects_assigned');
Route::get('get_superadmin','API\UserController@get_superadmin');
Route::get('get_employee','API\UserController@get_employee');
Route::post('get_single_emp','API\UserController@get_single_emp');









Route::group(['middleware' => 'auth:api'], function()
{

    Route::post('edit_employee','API\UserController@edit_employee');
    Route::post('logout','API\UserController@logout');
    Route::post('delete_employee','API\UserController@delete_employee');


});
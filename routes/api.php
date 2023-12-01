<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CompanyAdminsController;
use App\Http\Controllers\API\AddUserController;
use App\Http\Controllers\API\HolidayController;
use App\Http\Controllers\API\DepartmentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['middleware' => 'tokenauth'], function () {
    // AddUserController
    Route::post('add_user','App\Http\Controllers\API\AddUserController@add_user');
    Route::post('update_user','App\Http\Controllers\API\AddUserController@update_user');
    Route::get('index_user','App\Http\Controllers\API\AddUserController@index_user');
    Route::get('delete_user/{id}','App\Http\Controllers\API\AddUserController@delete_user');
    Route::get('search_user/{name}',[AddUserController::class,'searchuser']);

    // HolidayController
    Route::post('add_holiday','App\Http\Controllers\API\HolidayController@add_holiday');
    Route::post('update_holiday','App\Http\Controllers\API\HolidayController@update_holiday');
    Route::get('index_holiday','App\Http\Controllers\API\HolidayController@index_holiday');
    Route::get('delete_holiday/{id}','App\Http\Controllers\API\HolidayController@delete_holiday');
    Route::get('search_holiday/{name}',[HolidayController::class,'searchholiday']);

    //DepartmentController
    Route::post('add_department','App\Http\Controllers\API\DepartmentController@add_department');
    Route::post('update_department','App\Http\Controllers\API\DepartmentController@update_department');
    Route::get('index_department','App\Http\Controllers\API\DepartmentController@index_department');
    Route::get('delete_department/{id}','App\Http\Controllers\API\DepartmentController@delete_department');
    Route::get('search_department/{name}',[DepartmentController::class,'searchdepartment']);
});




Route::post('company_register', 'App\Http\Controllers\API\CompanyAdminsController@store');
Route::post('company_login', 'App\Http\Controllers\API\CompanyAdminsController@company_login');
// Route::post('company_dashboard', 'App\Http\Controllers\API\CompanyAdminsController@company_dashboard');
Route::get('/verify/email-auth/{email}', [CompanyAdminsController::class,'sendVerificationEmail'])->name('verify_email.auth');
Route::post('company_login', 'App\Http\Controllers\API\CompanyAdminsController@company_login');

// priti
Route::post('add_user',[AddUserController::class,'add_user']);

// pagination


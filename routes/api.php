<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CompanyAdminsController;
use App\Http\Controllers\API\AddUserController;
use App\Http\Controllers\API\DataTableController;
use App\Http\Controllers\API\CompanyAnnouncementController;


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

    //Announcement 
    Route::post('add_announcement','App\Http\Controllers\API\CompanyAnnouncementController@add_announcement');
});

Route::post('company_register', 'App\Http\Controllers\API\CompanyAdminsController@store');
Route::post('company_login', 'App\Http\Controllers\API\CompanyAdminsController@company_login');
// Route::post('company_dashboard', 'App\Http\Controllers\API\CompanyAdminsController@company_dashboard');
Route::get('/verify/email-auth/{email}', [CompanyAdminsController::class,'sendVerificationEmail'])->name('verify_email.auth');
Route::post('company_login', 'App\Http\Controllers\API\CompanyAdminsController@company_login');


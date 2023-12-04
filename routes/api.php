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
    Route::post('edit_companyuser','App\Http\Controllers\API\AddUserController@edit_companyuser');
    Route::post('update_user','App\Http\Controllers\API\AddUserController@update_user');
    Route::get('view_companyuser','App\Http\Controllers\API\AddUserController@view_companyuser');
    Route::post('delete_user','App\Http\Controllers\API\AddUserController@delete_user');
    Route::get('search_user/{name}',[AddUserController::class,'searchuser']);

    //Announcement 
    Route::post('add_announcement','App\Http\Controllers\API\CompanyAnnouncementController@add_announcement');
    Route::post('edit_announcement','App\Http\Controllers\API\CompanyAnnouncementController@edit_announcement');
    Route::post('update_announcement','App\Http\Controllers\API\CompanyAnnouncementController@update_announcement');
    Route::post('delete_announcement','App\Http\Controllers\API\CompanyAnnouncementController@delete_announcement');
    Route::post('index_announcement','App\Http\Controllers\API\CompanyAnnouncementController@index_announcement');
    Route::post('search_announcement','App\Http\Controllers\API\CompanyAnnouncementController@search_announcement');
    Route::get('view_announcement','App\Http\Controllers\API\CompanyAnnouncementController@view_announcement');
    
     //Preveligies 
     Route::post('add_previligies','App\Http\Controllers\API\CompanyPreviligiesController@add_previligies');
     Route::post('edit_previligies','App\Http\Controllers\API\CompanyPreviligiesController@edit_previligies');
     Route::post('update_previligies','App\Http\Controllers\API\CompanyPreviligiesController@update_previligies');
     Route::post('delete_previligies','App\Http\Controllers\API\CompanyPreviligiesController@delete_previligies');
     Route::post('index_previligies','App\Http\Controllers\API\CompanyPreviligiesController@index_previligies');
     Route::post('search_previligies','App\Http\Controllers\API\CompanyPreviligiesController@search_previligies');
    
});

Route::post('company_register', 'App\Http\Controllers\API\CompanyAdminsController@store');
Route::post('company_login', 'App\Http\Controllers\API\CompanyAdminsController@company_login');
// Route::post('company_dashboard', 'App\Http\Controllers\API\CompanyAdminsController@company_dashboard');
Route::get('/verify/email-auth/{email}', [CompanyAdminsController::class,'sendVerificationEmail'])->name('verify_email.auth');
Route::post('company_login', 'App\Http\Controllers\API\CompanyAdminsController@company_login');


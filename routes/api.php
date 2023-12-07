<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CompanyAdminsController;
use App\Http\Controllers\API\AddUserController;
use App\Http\Controllers\API\CompanyDepartmentController;
use App\Http\Controllers\API\CompanyHolidayController;
use App\Http\Controllers\API\CompanyDesignationController;

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
    // Route::post('add_user','App\Http\Controllers\API\AddUserController@add_user');
    // Route::post('edit_companyuser','App\Http\Controllers\API\AddUserController@edit_companyuser');
    // Route::post('update_user','App\Http\Controllers\API\AddUserController@update_user');
    // Route::get('view_companyuser','App\Http\Controllers\API\AddUserController@view_companyuser');
    // Route::post('delete_user','App\Http\Controllers\API\AddUserController@delete_user');
    // Route::get('search_user/{name}',[AddUserController::class,'searchuser']);
 

    //CompanyAdminsController
    Route::post('edit_companyadmin','App\Http\Controllers\API\CompanyAdminsController@edit_companyadmin');
    Route::post('update_companyadmin','App\Http\Controllers\API\CompanyAdminsController@update_companyadmin');

    //CompanyDesignationController
    Route::post('add_designation','App\Http\Controllers\API\CompanyDesignationController@add_designation');
    Route::post('edit_designation','App\Http\Controllers\API\CompanyDesignationController@edit_designation');
    Route::post('update_designation','App\Http\Controllers\API\CompanyDesignationController@update_designation');
    Route::post('delete_designation','App\Http\Controllers\API\CompanyDesignationController@delete_designation');
    Route::get('view_designation','App\Http\Controllers\API\CompanyDesignationController@view_designation');
    Route::get('paginate_designation','App\Http\Controllers\API\CompanyDesignationController@paginate_designation');
    Route::post('search_designation','App\Http\Controllers\API\CompanyDesignationController@search_designation');

    // CompanyHolidayController

    Route::post('add_holiday','App\Http\Controllers\API\CompanyHolidayController@add_holiday');
    Route::post('edit_holiday','App\Http\Controllers\API\CompanyHolidayController@edit_holiday');
    Route::post('update_holiday','App\Http\Controllers\API\CompanyHolidayController@update_holiday');
    Route::get('view_holiday','App\Http\Controllers\API\CompanyHolidayController@view_holiday');
    Route::post('delete_holiday','App\Http\Controllers\API\CompanyHolidayController@delete_holiday');
    Route::get('paginate_holiday','App\Http\Controllers\API\CompanyHolidayController@paginate_holiday');
    Route::post('search_holiday','App\Http\Controllers\API\CompanyHolidayController@search_holiday');

     //CompanyDepartmentController
     Route::post('add_department','App\Http\Controllers\API\CompanyDepartmentController@add_department');
     Route::post('edit_department','App\Http\Controllers\API\CompanyDepartmentController@edit_department');
     Route::post('update_department','App\Http\Controllers\API\CompanyDepartmentController@update_department');
     Route::get('view_department','App\Http\Controllers\API\CompanyDepartmentController@view_department');
     Route::post('delete_department','App\Http\Controllers\API\CompanyDepartmentController@delete_department');
     Route::get('paginate_department','App\Http\Controllers\API\CompanyDepartmentController@paginate_department');
    Route::post('search_department','App\Http\Controllers\API\CompanyDepartmentController@search_department');

      //CompanyEmployeeController
    Route::post('add_employee','App\Http\Controllers\API\CompanyEmployeeController@add_employee');
    // AddUserController
    Route::post('add_user','App\Http\Controllers\API\CompanyUserController@add_user');
    Route::post('edit_user','App\Http\Controllers\API\CompanyUserController@edit_user');
    Route::post('update_user','App\Http\Controllers\API\CompanyUserController@update_user');
    Route::post('delete_user','App\Http\Controllers\API\CompanyUserController@delete_user');
    Route::get('view_user','App\Http\Controllers\API\CompanyUserController@view_user');
    Route::get('paginate_user','App\Http\Controllers\API\CompanyUserController@paginate_user');
    Route::post('search_user','App\Http\Controllers\API\CompanyUserController@search_user');

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
    
     //Company Employee
     Route::post('add_employee','App\Http\Controllers\API\CompanyEmployeeController@add_employee');
     Route::post('edit_employee','App\Http\Controllers\API\CompanyEmployeeController@edit_employee');
     Route::post('update_employee','App\Http\Controllers\API\CompanyEmployeeController@update_employee');
     Route::post('delete_employee','App\Http\Controllers\API\CompanyEmployeeController@delete_employee');
     
});

Route::post('company_register', 'App\Http\Controllers\API\CompanyAdminsController@store');
Route::post('company_login', 'App\Http\Controllers\API\CompanyAdminsController@company_login');
// Route::post('company_dashboard', 'App\Http\Controllers\API\CompanyAdminsController@company_dashboard');
Route::get('/verify/email-auth/{email}', [CompanyAdminsController::class,'sendVerificationEmail'])->name('verify_email.auth');
Route::post('company_login', 'App\Http\Controllers\API\CompanyAdminsController@company_login');

// priti
Route::post('add_user',[AddUserController::class,'add_user']);

// pagination


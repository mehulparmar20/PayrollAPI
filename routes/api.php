<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CompanyAdminsController;
use App\Http\Controllers\API\AddUserController;
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

// Route::group(['middleware' => 'tokenauth'], function () {
//     Route::post('add_user','App\Http\Controllers\API\AddUserController@add_user');
// });


// Route::post('company_register', 'App\Http\Controllers\API\CompanyAdminsController@store');

// Route::post('company_login', 'App\Http\Controllers\API\CompanyAdminsController@company_login');

// // Route::post('company_dashboard', 'App\Http\Controllers\API\CompanyAdminsController@company_dashboard');
// Route::get('/verify/email-auth/{email}', [CompanyAdminsController::class,'sendVerificationEmail'])->name('verify_email.auth');
// Route::post('company_login', 'App\Http\Controllers\API\CompanyAdminsController@company_login');

// priti
// Route::post('add_user',[AddUserController::class,'add_user']);

Route::group([
        'middleware' => ['api', 'cors'],
        // 'prefix' => 'api',
    ], function ($router) {
         
        //  Route::apiResource('/posts','PostController');
        Route::post('company_register', 'App\Http\Controllers\API\CompanyAdminsController@store');
// Route::post('company_dashboard', 'App\Http\Controllers\API\CompanyAdminsController@company_dashboard');
Route::get('/verify/email-auth/{email}', [CompanyAdminsController::class,'sendVerificationEmail'])->name('verify_email.auth');
Route::post('company_login', 'App\Http\Controllers\API\CompanyAdminsController@company_login');

    });
    
    
Route::group(['middleware' => 'tokenauth'], function () {
    Route::post('add_user','App\Http\Controllers\API\AddUserController@add_user');
});



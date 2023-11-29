<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AddUserController;
use App\Http\Controllers\API\CompanyController;

use App\Http\Controllers\API\CompanyAdminsController;
// use App\Http\Controllers\API\AddUserController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('company_register', 'API\CompanyController@company_register');

// Route::get("data",[AddUserController::class,'data']);
Route::post('datastore',[AddUserController::class,'datastore']);
Route::post('company_login', 'App\Http\Controllers\API\CompanyAdminsController@company_login');

// Route::post('company_dashboard', 'App\Http\Controllers\API\CompanyAdminsController@company_dashboard');

Route::get('/verify/email-auth/{email}', [CompanyAdminsController::class,'sendVerificationEmail'])->name('verify_email.auth');

// priti
Route::post('add_user',[AddUserController::class,'add_user']);

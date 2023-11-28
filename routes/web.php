<?php

use App\Http\Controllers\Admin\MasterAdminController;
use App\Http\Controllers\Admin\PlanController;
use App\Http\Controllers\Admin\TaxMasterController;


use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [MasterAdminController::class, 'admin'])->name('admin');
});
Route::get('/', [MasterAdminController::class, 'welcome'])->name('welcome');
// Route::get('login', [MasterAdminController::class, 'login'])->name('login');
Route::post('custom-login', [MasterAdminController::class, 'customLogin'])->name('custom-login'); 
Route::get('logout', [MasterAdminController::class, 'logout'])->name('log-out');

//PlanController
Route::get('plan-create', [PlanController::class,'create'])->name('admin.plan.create');
Route::post('plan-store', [PlanController::class, 'store'])->name('plan-store');
Route::get('plan-index', [PlanController::class, 'index'])->name('admin.plan.index');
Route::get('plan-edit/{id}', [PlanController::class, 'edit'])->name('admin.plan.edit');
Route::post('plan-update/{id}', [PlanController::class, 'update'])->name('plan-update');
Route::get('plan-delete/{id}', [PlanController::class, 'destroy'])->name('plan-delete'); 
Route::get('plan-view', [PlanController::class,'show'])->name('admin.plan.view');

// TaxmasterController
Route::get('tax-create', [TaxMasterController::class,'create'])->name('admin.tax.create');
Route::post('tax-store', [TaxMasterController::class, 'store'])->name('tax-store');
Route::get('tax-index', [TaxMasterController::class, 'index'])->name('admin.tax.index');
Route::get('tax-edit/{id}', [TaxMasterController::class, 'edit'])->name('admin.tax.edit');
Route::post('tax-update/{id}', [TaxMasterController::class, 'update'])->name('tax-update');
Route::get('tax-delete/{id}', [TaxMasterController::class, 'destroy'])->name('tax-delete'); 
Route::get('tax-view', [TaxMasterController::class,'show'])->name('admin.tax.view');

//AdminMasterController
Route::get('masteradmin', [MasterAdminController::class,'masteradmin'])->name('masteradmin');
Route::post('masteradmin-store', [MasterAdminController::class, 'store'])->name('masteradmin-store');
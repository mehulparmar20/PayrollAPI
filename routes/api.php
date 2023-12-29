<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CompanyAdminsController;
use App\Http\Controllers\API\AddUserController;
use App\Http\Controllers\API\CompanyDepartmentController;
use App\Http\Controllers\API\CompanyHolidayController;
use App\Http\Controllers\API\CompanyDesignationController;
use App\Http\Controllers\API\CompanyTimeController;
use App\Http\Controllers\API\CompanyLeaveTypeController;
use App\Http\Controllers\API\CompanyComposeController;
use App\Http\Controllers\API\CompanyJoiningController;
use App\Http\Controllers\API\CompanyBranchController;
use App\Http\Controllers\API\CompanyWorkingdayController;
use App\Http\Controllers\API\CompanyResignationController;
use App\Http\Controllers\API\CompanyFileuploadController;
use App\Http\Controllers\API\CompanyCreditLeaveController;
use App\Http\Controllers\API\CompanyEmployeeLeaveController;
use App\Http\Controllers\API\CompanyDocumentController;
use App\Http\Controllers\API\CompanyLogoController;


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

Route::group([
        'middleware' => ['api', 'cors'],
    ], function ($router) {
        Route::post('company_register', 'App\Http\Controllers\API\CompanyAdminsController@store');
        Route::get('/verify/email-auth/{email}', [CompanyAdminsController::class,'sendVerificationEmail'])->name('verify_email.auth');
        Route::post('company_login', 'App\Http\Controllers\API\CompanyAdminsController@company_login');
    });
    
    
Route::group(['middleware' => 'tokenauth'], function () {

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

    // CompanyTimeController
    Route::post('add_time','App\Http\Controllers\API\CompanyTimeController@add_time');
    Route::post('edit_time','App\Http\Controllers\API\CompanyTimeController@edit_time');
    Route::post('update_time','App\Http\Controllers\API\CompanyTimeController@update_time');
    Route::get('view_time','App\Http\Controllers\API\CompanyTimeController@view_time');
    Route::post('delete_time','App\Http\Controllers\API\CompanyTimeController@delete_time');
    Route::get('paginate_time','App\Http\Controllers\API\CompanyTimeController@paginate_time');
    Route::post('search_time','App\Http\Controllers\API\CompanyTimeController@search_time');

    //CompanyLeaveTypeController
    Route::post('add_leave','App\Http\Controllers\API\CompanyLeaveTypeController@add_leave');
    Route::post('edit_leave','App\Http\Controllers\API\CompanyLeaveTypeController@edit_leave');
    Route::post('update_leave','App\Http\Controllers\API\CompanyLeaveTypeController@update_leave');
    Route::get('view_leave','App\Http\Controllers\API\CompanyLeaveTypeController@view_leave');
    Route::post('delete_leave','App\Http\Controllers\API\CompanyLeaveTypeController@delete_leave');
    Route::get('paginate_leave','App\Http\Controllers\API\CompanyLeaveTypeController@paginate_leave');
    Route::post('search_leave','App\Http\Controllers\API\CompanyLeaveTypeController@search_leave');
    
    //CompanyComposeController
    Route::post('add_compose','App\Http\Controllers\API\CompanyComposeController@add_compose');
    Route::get('view_compose','App\Http\Controllers\API\CompanyComposeController@view_compose');

    //CompanyJoiningController
    Route::post('view_joinemployee','App\Http\Controllers\API\CompanyJoiningController@view_joinemployee');
    Route::post('add_joining','App\Http\Controllers\API\CompanyJoiningController@add_joining');
    Route::post('edit_joining','App\Http\Controllers\API\CompanyJoiningController@edit_joining');
    Route::post('update_joining','App\Http\Controllers\API\CompanyJoiningController@update_joining');
    Route::get('view_joining','App\Http\Controllers\API\CompanyJoiningController@view_joining');
    Route::post('delete_joining','App\Http\Controllers\API\CompanyJoiningController@delete_joining');
    Route::get('paginate_joining','App\Http\Controllers\API\CompanyJoiningController@paginate_joining');
    Route::post('search_joining','App\Http\Controllers\API\CompanyJoiningController@search_joining');

    //CompanyBranchController
    Route::post('add_branch','App\Http\Controllers\API\CompanyBranchController@add_branch');
    Route::post('edit_branch','App\Http\Controllers\API\CompanyBranchController@edit_branch');
    Route::post('update_branch','App\Http\Controllers\API\CompanyBranchController@update_branch');
    Route::get('view_branch','App\Http\Controllers\API\CompanyBranchController@view_branch');
    Route::post('delete_branch','App\Http\Controllers\API\CompanyBranchController@delete_branch');
    Route::get('paginate_branch','App\Http\Controllers\API\CompanyBranchController@paginate_branch');
    Route::post('search_branch','App\Http\Controllers\API\CompanyBranchController@search_branch');

    //CompanyWorkingdayController
    Route::post('add_workingdays','App\Http\Controllers\API\CompanyWorkingdayController@add_workingdays');
    Route::post('edit_workingdays','App\Http\Controllers\API\CompanyWorkingdayController@edit_workingdays');
    Route::post('update_workingdays','App\Http\Controllers\API\CompanyWorkingdayController@update_workingdays');
    Route::get('view_workingdays','App\Http\Controllers\API\CompanyWorkingdayController@view_workingdays');
    Route::post('delete_workingdays','App\Http\Controllers\API\CompanyWorkingdayController@delete_workingdays');
    Route::get('paginate_workingdays','App\Http\Controllers\API\CompanyWorkingdayController@paginate_workingdays');
    Route::post('search_workingdays','App\Http\Controllers\API\CompanyWorkingdayController@search_workingdays');

    //CompanyResignationController

    Route::post('add_resignation','App\Http\Controllers\API\CompanyResignationController@add_resignation');
    Route::post('edit_resignation','App\Http\Controllers\API\CompanyResignationController@edit_resignation');
    Route::post('update_resignation','App\Http\Controllers\API\CompanyResignationController@update_resignation');
    Route::get('view_resignation','App\Http\Controllers\API\CompanyResignationController@view_resignation');
    Route::post('delete_resignation','App\Http\Controllers\API\CompanyResignationController@delete_resignation');
    Route::get('paginate_resignation','App\Http\Controllers\API\CompanyResignationController@paginate_resignation');
    Route::post('search_resignation','App\Http\Controllers\API\CompanyResignationController@search_resignation');

    //CompanyFileuploadController
    Route::post('add_fileupload','App\Http\Controllers\API\CompanyFileuploadController@add_fileupload');
    Route::get('view_fileupload','App\Http\Controllers\API\CompanyFileuploadController@view_fileupload');
    Route::post('delete_fileupload','App\Http\Controllers\API\CompanyFileuploadController@delete_fileupload');
    
   //CompanyDocumentController
    Route::post('add_document','App\Http\Controllers\API\CompanyDocumentController@add_document');
    Route::get('view_document','App\Http\Controllers\API\CompanyDocumentController@view_document');
    Route::post('delete_document','App\Http\Controllers\API\CompanyDocumentController@delete_document');
   

    //CompanyLogoController
    Route::post('add_logo','App\Http\Controllers\API\CompanyLogoController@add_logo');
    Route::get('view_logo','App\Http\Controllers\API\CompanyLogoController@view_logo');
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
     Route::get('view_employee','App\Http\Controllers\API\CompanyEmployeeController@view_employee');
     Route::get('paginate_employee','App\Http\Controllers\API\CompanyEmployeeController@paginate_employee');
     Route::post('search_employee','App\Http\Controllers\API\CompanyEmployeeController@search_employee');
     Route::post('changepassword_employee','App\Http\Controllers\API\CompanyEmployeeController@changepassword_employee');
    

     //Employee History
     Route::get('employee_history','App\Http\Controllers\API\CompanyEmployeeController@employee_history');
     
     //Employee Leave 
     Route::post('add_employee_leave','App\Http\Controllers\API\CompanyEmployeeLeaveController@add_employee_leave');
     Route::post('delete_employee_leave','App\Http\Controllers\API\CompanyEmployeeLeaveController@delete_employee_leave');
     Route::get('view_employee_leave','App\Http\Controllers\API\CompanyEmployeeLeaveController@view_employee_leave');

     //Employee Attendance
     Route::post('add_employee_attendance','App\Http\Controllers\API\EmployeeAttendanceController@add_employee_attendance');
     Route::get('view_employee_attendance','App\Http\Controllers\API\EmployeeAttendanceController@view_employee_attendance');
    
      //Company Shift
      Route::post('add_company_shift','App\Http\Controllers\API\CompanyShiftController@add_company_shift');
      Route::get('view_company_shift','App\Http\Controllers\API\CompanyShiftController@view_company_shift');
      
});


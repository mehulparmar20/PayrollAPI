<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\API\Company_Admins;
use Auth;
use Session;
// use Jenssegers\Mongodb\Facades\DB;
// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
// use Illuminate\Foundation\Auth\User as Authenticatable;
// use Illuminate\Notifications\Notifiable;


class CompanyAdminsController extends Controller
{
    public function store(Request $request)
    {
        // dd($request);

        // request()->validate([
        //     'company_name' => 'required|unique:user',
        //     'company_address' => 'required',
        //     'admin_name' => 'required',
        //     'admin_contact' => 'required',
        //     'company_email' => 'required',
        //     'admin_username' => 'required',
        //     'admin_password' => 'required',
        //     'total_employee' => 'required',
        // ]);
        // if($request->company_name == null){
        //     $request->company_name = '';
        // }
        // if($request->company_address == null){
        //     $request->company_address = '';
        // }
        // if($request->admin_name == null){
        //     $request->admin_name = '';
        // }
        // if($request->admin_contact == null){
        //     $request->admin_contact = '';
        // }
        // if($request->company_email == null){
        //     $request->company_email = '';
        // }
        // if($request->admin_username == null){
        //     $request->admin_username = '';
        // }
        // if($request->admin_password == null){
        //     $request->admin_password = '';
        // }
        // if($request->total_employee == null){
        //     $request->total_employee = '';
        // }
        $password = hash('sha1',$request->admin_password);
       
        $getCompany = Company_Admins::max('_id');
        $new_id=$getCompany+1;
      
        // dd($new_id);
        $data=array(
            '_id' => $new_id,
            // 'counter' => 0,
            // 'companyID' => (int)$companyId,
            'company_name' => $request->input('company_name'),
            'company_address' => $request->input('company_address'),
            'admin_name' => $request->input('admin_name'),
            'password' => $password,
            'admin_contact' => $request->input('admin_contact'),
            'company_email' => $request->input('company_email'),
            'admin_username' => $request->input('admin_username'),
            'total_employee' => $request->input('total_employee'),
            // 'userId' => (int)Auth::user()->_id,
            // 'insertedUserId' => Auth::user()->userName,
            // 'deleteStatus' => '0',
            // 'mode' => 'day',
            // 'emailVerificationStatus' => 1,
            'subscription_id' => '',
            'subscription_status' => '',
            'otp' => '',
            'plan_name' => '',
            'plan_start' => '',
            'plan_end' => '',
            'api_status' => '',
            'company_upload_storage' => '',
            'register_ip' => '',
            'last_login_id' => '',
            'country' => '',
            'city' => '',
            'state' => '',
            'pincode' => '',
            'fax' => '',
            'os' => '',
            'browser' => '',
            'login_time' => '',
            'password_change' => '',
            'forgototp' => '',
            'updated_at' => '',
            'created_at' => '',
            // 'deleted_at' => '',
            // 'deleteTime' => '',
            // 'deleteUser' => '',
        );
        $result=Company_Admins::raw()->insertOne($data);
        // dd($result);
        if($result){
            $result=$data;
            $success = true;
            $message = "Company added successfully";
        } else {
            $success = false;
            $message = "Company not added. Please try again";
            $result=$data;
        }

        //  Return response
        return response()->json([
            'success' => $success,
            'message' => $message,
            'data'=>$result,
        ]);
 
        return response()->json(["result" => "ok"], 201);
    }

    // public function company_dashboard(Request $request)
    // {
    //     // $companyID=Auth::user()->companyID;
    //     // $employement = Company_Admins::where('id',$companyID)->first();
    //     // return response()->json($employement); 
    //     $companyID=$request->input('company_id');
     
    //     $company = Company_Admins::where('_id',$companyID)->get();
    //     dd($company);
    //     return response()->json($company); 
     
    //     // return response()->json($customerCurr, 200, [], JSON_PARTIAL_OUTPUT_ON_ERROR);
    // }
}

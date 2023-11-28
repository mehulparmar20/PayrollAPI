<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\API\Company_Admins;
use Auth;
use Mail; 
use Hash;
use Session;
use App\Mail\Mails;
use Illuminate\Support\Str;
// use Jenssegers\Mongodb\Facades\DB;
// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
// use Illuminate\Foundation\Auth\User as Authenticatable;
// use Illuminate\Notifications\Notifiable;


class CompanyAdminsController extends Controller
{
    public function store(Request $request)
    {
        // $request->validate([
            // 'company_name' => 'required|unique:user',
            // 'company_address' => 'required',
            // 'admin_name' => 'required',
            // 'admin_contact' => 'required',
            // 'company_email' => 'required|unique:company_admin',
            // 'admin_username' => 'required',
            // 'admin_password' => 'required',
            // 'total_employee' => 'required',
        // ]);
        if(Company_Admins::where('company_email', $request->company_email)->first() != null)
        {
            return response()->json(["result" => "Email already exits!"], 500);
        }
        
        // if($request->company_name == null){
        //     $request->company_name = '';
        // }
        $password = hash('sha1',$request->admin_password);
      
        $getCompany = Company_Admins::max('_id');
        $new_id=$getCompany+1;
      
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
            'emailVerificationStatus' => 0,
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
       
        if($result){
            $result=$data;
            $success = true;
            $message = "Company added successfully and please check your email";
        } else {
            $success = false;
            $message = "Company not added. Please try again";
            $result=$data;
        }

        if($data['emailVerificationStatus'] == 0)
        {
            $array=array();
            $array['email'] = $request->input('company_email');
            Mail::send('emails.verify_email', $array,function($message) use ($array) {
                $message->to($array['email']);
                $message->subject('email verify');
            });
        }
     
        return response()->json([
            'success' => $success,
            'message' => $message,
            'data'=>$result,
        ]);
    
        return response()->json(["result" => "ok"], 201);
    }
   
    public function sendVerificationEmail(Request $request)
    {
        $email=$request->email;
        $comapny_admin=Company_Admins::where('company_email',$email)->first();
        $comapny_admin->emailVerificationStatus="1";
        $comapny_admin->email_verified_at=now();
        $comapny_admin->save();
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

<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\API\Company_admin;
use App\Models\API\Company_user;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AddUserController extends Controller
{
    // public function datastore(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'user_email' => 'required',
    //         'user_name'=>'required',
    //         'user_password'=>'required',
    //         'user_type'=>'required',
    //         'user_add_date'=>'required',
           
            
    //     ]);

    //     $data = new Company_user([
    //         'user_email' => $validatedData['user_email'],
    //         'user_name' => $validatedData['user_name'],
    //         'user_password' => Hash::make($validatedData['user_password']),
    //         'user_type' => $validatedData['user_type'],
    //         'user_add_date' => $validatedData['user_add_date'],
    //     ]);
    //     $data->save();
    //     return response()->json(['message' => 'Add User successfully'], 201);
    // }//priti changes


public function datastore(Request $request)
{
    // Validate the incoming request data
    $validatedData = $request->validate([
            'user_email' => 'required',
            'user_name'=>'required',
            'user_password'=>'required',
            'user_type'=>'required',
            'user_add_date'=>'required',
           
    ]);
    $password = Hash::make($validatedData['user_password']);
    $new_id = Company_user::max('_id') + 1;

    $data = [
        '_id' => $new_id,
        'user_email' => $validatedData['user_email'],
        'user_name' => $validatedData['user_name'],
        'user_password' =>$password,
        'user_type' => $validatedData['user_type'],
        'user_add_date' => $validatedData['user_add_date'],
        'otp' => 0,
        'otpexperience' => '',
        'last_change_password' => '',
        'last_login' => '',
        'entry_time' => '',
        'user_status' => '',
        'shift_id' => '',
        'employee' => '',
        'payroll' => '',
        'attendance' => '',
        'break' => '',
        'leave' => '',
        'letter' => '',
        'administration' => '',
        'recruitment' => '',
        'ip' => '',
        'browser' => '',
        'city' => '',
        'state' => '',
        'os' => '',
        'created_at' => now(),
        'updated_at' => now(),
    ];

    
    $result = Company_user::insert($data);

    
    if ($result) {
        return response()->json(['message' => 'User Adder successfully'], 201);
    } else {
        return response()->json(['message' => 'Failed to Add user'], 500);
    }
}


    }

// $getCompany = Company_Admins::max('_id');
// $new_id=$getCompany+1;

// $data=array(
// '_id' => $new_id,
// 'company_name' => $request->input('company_name'),
// 'company_address' => $request->input('company_address'),
// 'admin_name' => $request->input('admin_name'),
// 'password' => $password,
// 'admin_contact' => $request->input('admin_contact'),
// 'company_email' => $request->input('company_email'),
// 'admin_username' => $request->input('admin_username'),
// 'total_employee' => $request->input('total_employee'),
// // 'userId' => (int)Auth::user()->_id,
// // 'insertedUserId' => Auth::user()->userName,
// // 'deleteStatus' => '0',
// // 'mode' => 'day',
// 'emailVerificationStatus' => 0,
// 'subscription_id' => '',
// 'subscription_status' => '',
// 'otp' => '',
// 'plan_name' => '',
// 'plan_start' => '',
// 'plan_end' => '',
// 'api_status' => '',
// 'company_upload_storage' => '',
// 'register_ip' => '',
// 'last_login_id' => '',
// 'country' => '',
// 'city' => '',
// 'state' => '',
// 'pincode' => '',
// 'fax' => '',
// 'os' => '',
// 'browser' => '',
// 'login_time' => '',
// 'password_change' => '',
// 'forgototp' => '',
// 'updated_at' => '',
// 'created_at' => '',
// // 'deleted_at' => '',
// // 'deleteTime' => '',
// // 'deleteUser' => '',
// );
// $result=Company_Admins::raw()->insertOne($data);

    // public function data()
    // {
    // //  return ["name"=>"Anil"];
    // return User::all();
    // }
    // public function store(Request $request)
    // {
    //     // return $request;
    //         $data=new User;
    //         $data->name=$request->name;
    //         $data->email=$request->email;
    //         $data->password=$request->password;
    //        $result= $data->save();
    //        if($result)
    //        {
    //         return ["result"=>"Data Saved"];
    //        }
    //        else{
    //         return ["result"=>"Data Failed"];
    //        }


    // }


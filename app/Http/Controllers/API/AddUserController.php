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
    
    // $data = Company_user::with('companyAdmin')->first();  
    $data = Company_user::with('companyAdmin')->get();
    // dd($data[2]);
    // $data=$company_ad->companyAdmin->total_employee;
    $admin=11;
    // $emp=$data[2]->total_employee;
    $emp=10;
    if ($emp>=1 && $emp<=10) {
       
        $totalEmployee = $emp;
    //    dd($totalEmployee);
    } else {
    //    dd('empty');
    }
    // dd($data);
    $data = [
        '_id' => $new_id,
        // 'company_id'=>$data[2]->_id,
        'company_id'=>$admin,
        // 'counter'=>$data[2]->total_employee,
        'counter'=>$totalEmployee,
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


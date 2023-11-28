<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\API\Company_admin;
use App\Models\User;
use Illuminate\Http\Request;

class AddUserController extends Controller
{
    public function store(Request $request)
    {
        return Company_admin::all();
        // $validatedData = $request->validate([
        //     'user_email' => 'required',
        //     'user_name'=>'required',
        //     'admin_name'=>'required',
        //     'admin_contact'=>'required',
        //     'company_email'=>'required',
        //     'admin_username'=>'required',
        //     'admin_password'=>'required|string|min:6',
        //     'total_employee'=>'required',
        //     // 'company_address' => 'required|string|email|max:255|unique:users',
            
        // ]);

        // $user = new User([
        //     'company_name' => $validatedData['company_name'],
        //     'company_address' => $validatedData['company_address'],
        //     'admin_name' => $validatedData['admin_name'],
        //     'admin_contact' => $validatedData['admin_contact'],
        //     'company_email' => $validatedData['company_email'],
        //     'admin_username' => $validatedData['admin_username'],
        //     'total_employee' => $validatedData['total_employee'],
        //     'admin_password' => Hash::make($validatedData['admin_password']),
        // ]);

        // $user->save();

        // return response()->json(['message' => 'User registered successfully'], 201);
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
}

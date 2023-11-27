<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\API\Company_admin;

class CompanyController extends Controller
{
    public function company_register(Request $request)
    {
        $validatedData = $request->validate([
            'company_name' => 'required',
            'company_address'=>'required',
            'admin_name'=>'required',
            'admin_contact'=>'required',
            'company_email'=>'required',
            'admin_username'=>'required',
            'admin_password'=>'required|string|min:6',
            'total_employee'=>'required',
            // 'company_address' => 'required|string|email|max:255|unique:users',
            
        ]);

        $user = new User([
            'company_name' => $validatedData['company_name'],
            'company_address' => $validatedData['company_address'],
            'admin_name' => $validatedData['admin_name'],
            'admin_contact' => $validatedData['admin_contact'],
            'company_email' => $validatedData['company_email'],
            'admin_username' => $validatedData['admin_username'],
            'total_employee' => $validatedData['total_employee'],
            'admin_password' => Hash::make($validatedData['admin_password']),
        ]);

        $user->save();

        return response()->json(['message' => 'User registered successfully'], 201);
    }

    // public function login(Request $request)
    // {
    //     $credentials = $request->only('email', 'password');

    //     if (Auth::attempt($credentials)) {
    //         $user = Auth::user();
    //         // Generate token or perform any required logic upon successful login
    //         return response()->json(['token' => $user->createToken('authToken')->accessToken]);
    //     } else {
    //         return response()->json(['message' => 'Invalid credentials'], 401);
    //     }
    // }
}

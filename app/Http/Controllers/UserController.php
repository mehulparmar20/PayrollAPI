<?php

namespace App\Http\Controllers;
use Session;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
       return view('/login');  
    }
    public function customLogin(Request $request)
    {
        // $credentials = $request->only('email', 'password');
        // if (Auth::attempt($credentials)) {
        //     return redirect('/dashboard')->with('success', 'Login Successfully!');
        
        // }
        // else{
        // return redirect('/login')->with('error', 'Invalid credentials');
        // }
    }
    public function register()
    {
       
        return view('user.register');
    }
    public function customregister(Request $request)
    {
        // dd($request);
        // $validated = $request->validate([
        //     'first_name' => 'required',
        //     'last_name' => 'required',
        //     'contact_no' => 'required',
        //     'email' => 'required|unique:users|max:255',
        //     'password' => 'required',
        //      'user_type'=>'required',
        // ]);
        // // dd($request);
        // $data=User::create([
        //     'first_name' => $request->first_name,
        //     'last_name' => $request->last_name,
        //     'contact_no' => $request->contact_no,
        //     'email' => $request->email,
        //     'password' => Hash::make($request->password),
        //     'user_type'=>$request->user_type,
        // ]);

        // return redirect('/login')->with('success', 'Register Successfully!');
    }
    public function logout(Request $request) {
        // Auth::logout(); // Log the user out

        // $request->session()->invalidate();
        // $request->session()->regenerateToken();

        // return redirect('/login'); 
}
}
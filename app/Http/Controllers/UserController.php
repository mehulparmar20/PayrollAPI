<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    public function index()
    {
       return view('/login');  
    }
    public function customLogin(UserRequest $request)
    {
        $credentials = $request->only('email', 'password');
dd($credentials);
        if (Auth::attempt($credentials) && auth()->user()->isAdmin) {
            return redirect()->intended('/admin')->with('success', 'Login Successfully!');
        }

        return redirect()->back()->withErrors(['email' => 'Invalid credentials']);
    }
    // public function customLogin(UserRequest $request)
    // {
    //     $credentials = $request->only('email', 'password');
    //     // dd($credentials);
    //     if (Auth::attempt($credentials)) {
    //         return redirect('/admin')->with('success', 'Login Successfully!');
        
    //     }
    //     else{
    //     return redirect('/')->with('error', 'Invalid credentials');
    //     }
    // }
   
    public function logout(Request $request) {
        // Auth::logout(); // Log the user out

        // $request->session()->invalidate();
        // $request->session()->regenerateToken();

        // return redirect('/login'); 
}
   
}
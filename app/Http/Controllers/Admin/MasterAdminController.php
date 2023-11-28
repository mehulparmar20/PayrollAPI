<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterAdminRequest;
use App\Models\MasterAdmin;
use App\Models\Plan;
use App\Models\Taxmaster;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;

class MasterAdminController extends Controller
{
   public function masteradmin(Request $request)
    {
    //     return view('masteradmin');
    // }
    // public function store(MasterAdminRequest $request)
    // {
    //     // dd($request);
    //     $input= $request->all();
    //     // dd($input);
    //     $input['name']=($input['name']);
    //     $input['email']=($input['email']);
    //     $input['password']=($input['password']);
        
    //       MasterAdmin::create($input);
    // // dd($request);
    //    return redirect()->back()->with('success','Master Admin Created Successfully');
    }
    public function admin() {
		$count = [];
		$count['plan'] = Plan::count();
        $count['tax'] = Taxmaster::count();
		// $count['user'] = User::count();
		$count['sell'] = 0;
		return view('admin',compact('count'));
	}
    // public function login()
    // {
    //    return view('login');  
    // }
    public function welcome()
    {
       return view('welcome');  
    }
    public function customLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('/admin')->with('success', 'Login Successfully!');
        }

        return redirect()->back()->withErrors(['email' => 'Invalid credentials']);
    }
      
    public function logout(Request $request) {
       Auth::logout(); // Log the user out

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // return redirect('/login'); 
        return redirect('/');
    }
    // public function getTable(Request $request){
     
    //     $subscription = array();
    //     $admin_id = (int)Auth::user()->admin_id;
    //     $users = \App\Models\MasterAdmin::raw()->aggregate([
    //         ['$project' => ['userFirstName' => 1, 'userLastName' => 1, '_id' => 1]]]);
    //     foreach($users as $u){

    //         for($i = 0; $i < sizeof($u); $i++) {

    //             $uid= (string)$u['_id'];
    //             $userlist[$uid] = $u['userFirstName'].' '.$u['userLastName'];

    //         }
    //     }
    // }
}


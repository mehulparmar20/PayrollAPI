<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterAdminRequest;
use App\Models\MasterAdmin;
use Illuminate\Http\Request;

class MasterAdminController extends Controller
{
   public function masteradmin(Request $request)
    {
        return view('masteradmin');
    }
    public function store(MasterAdminRequest $request)
    {
        // dd($request);
        $input= $request->all();
        // dd($input);
        $input['name']=($input['name']);
        $input['email']=($input['email']);
        $input['password']=($input['password']);
        
          MasterAdmin::create($input);
    // dd($request);
       return redirect()->back()->with('success','Master Admin Created Successfully');
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


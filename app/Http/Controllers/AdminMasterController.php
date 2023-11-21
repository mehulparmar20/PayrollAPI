<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
class AdminMasterController extends Controller
{
    public function getTable(Request $request){
     
        $subscription = array();
        $admin_id = (int)Auth::user()->admin_id;
        $users = \App\Models\MasterAdmin::raw()->aggregate([
            ['$project' => ['userFirstName' => 1, 'userLastName' => 1, '_id' => 1]]]);
        foreach($users as $u){

            for($i = 0; $i < sizeof($u); $i++) {

                $uid= (string)$u['_id'];
                $userlist[$uid] = $u['userFirstName'].' '.$u['userLastName'];

            }
        }
    }
}

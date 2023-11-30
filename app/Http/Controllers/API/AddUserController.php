<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\API\Company_admin;
use App\Models\API\Company_Admins;
use App\Models\API\Company_user;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AddUserController extends Controller
{
        public function add_user(Request $request)
        {
            $token = $request->bearerToken();
            //$token= $token_data->token;
            $secretKey ='345fgvvc4';
            $decryptedInput = decrypt($token, $secretKey);
            $token_data=list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
            
            $company_id=$token_data['0'];
            $latest_employee_id = Company_Admins::latest('_id')->value('_id');
            // dd($latest_employee_id);
            


            $company_id=intval($id);
        //    dd($company_id);
            $company_admins=Company_Admins::where('_id',$company_id)->value('total_employee');
            //  dd($company_admins);//changes

            if($company_id==$latest_employee_id)
            {
                $latest_total_employee = Company_Admins::latest('_id')->value('total_employee');
                // dd($latest_total_employee);
            }
            else{
                $latest_total_employee = 0;
            }
            $validatedData = $request->validate([
                    'user_email' => 'required',
                    'user_name'=>'required',
                    'user_password'=>'required',
                    'user_type'=>'required',
                    'user_add_date'=>'required',
                
            ]);
            // $password = Hash::make($validatedData['user_password']);
            $password = hash('sha1',$request->password);
            $new_id = Company_user::max('_id') + 1;
            $data = [
                '_id' => $new_id,
                'company_id'=>$company_id,
                'counter'=>$latest_total_employee,
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
                'delete_status'=>1,
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
public function update_user(Request $request ,$id)
{
    // dd($request);
    $new_id=intval($id);
    $data = Company_user::where('_id',$new_id)->first();
    $data->user_email = $request->user_email;
    $data->user_name = $request->user_name;
    $data->user_password= $request->user_password;
    $data->user_type = $request->user_type;
    $data->user_add_date = $request->user_add_date;
    // dd($data);
    $data->save();
    
    $response = [
        "success" => true,
        "data" => $data,
        "message" => " data update Successfully !"
    ];
        return response()->json($response, 201);
   
}
public function delete_user($id)
{
   
    $new_id=intval($id);
    $data = Company_user::where('_id',$new_id)->first();
    $data->delete_status ='0';
    $data->save();
    return response()->json(['status' => 'Deleted Successfully']);
}

public function index_user(Request $request)
{

    // dd($request);
        //   $token = $request->bearerToken();
        //   dd($token);
        $records = User::all();
        //dd($records);
        return response()->json(['success' => true, 'data' => $records], 200);
}

}

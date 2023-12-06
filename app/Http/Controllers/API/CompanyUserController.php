<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\API\Company_admin;
use App\Models\API\Company_Admins;
use App\Models\API\Company_user;
use App\Helpers\AppHelper;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CompanyUserController extends Controller
{
        public function add_user(Request $request) //done
        {
        $token = $request->bearerToken();
        $secretKey ='345fgvvc4';
        $decryptedInput = decrypt($token, $secretKey);
        $token_data=list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
        $latest_employee_id = Company_Admins::latest('_id')->value('_id');
        $company_id=intval($id);//fetch company_id
        $company_admins=Company_Admins::where('_id',$company_id)->value('total_employee'); //fetch total employee from company_admin
        $total=Company_user::where('company_id',$company_id)->count();//user count that particular id
        $company_admins = Company_Admins::where('_id', $company_id)->first(); //get latest record from company_admin
        if ($company_admins) {
        $allowed_total_employee = $company_admins->total_employee;
        
        $latest_total_employee = Company_Admins::latest('_id')->value('total_employee');
        // Check if the current number of employees is less than the allowed total employees
        
        if ($total < $allowed_total_employee) {
        // Continue with user creation
        
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
            // 'counter'=>$latest_total_employee,
            'user_email' => $request->user_email,
            'user_name' => $request->user_name,
            'user_password' =>$password,
            'user_type' => $request->user_type,
            'user_add_date' => $request->user_add_date,
            'role' => $request->role,
            'employee' => $request->employee,
            'payroll' => $request->payroll,
            'attendance' => $request->attendance,
            'break' => $request->break,
            'leave' => $request->leave,
            'letters' => $request->letters,
            'administration' => $request->administration,
            'insertedTime' => time(),
            // 'insertedUserId' => Auth::user()->userFirstName.' '.Auth::user()->userLastName,
            'delete_status' => "NO",
            'deleteUser' => "",
            'deleteTime' => "",
        ];
        
            $result = Company_user::insert($data);
            
            if ($result) {
            return response()->json(['message' => 'User added successfully'], 201);
            } else {
            return response()->json(['message' => 'Failed to Add User'], 500);
            }
            } else {
            return response()->json(['message' => 'Maximum number of employees reached for this company'], 400);
            }
            } else {
            return response()->json(['message' => 'Company not found'], 404);
            }
        }

    public function edit_user(Request $request)
    {
        $token = $request->bearerToken();
        $secretKey ='345fgvvc4';
        $decryptedInput = decrypt($token, $secretKey);
        list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
        $companyID=intval($id);
        $id=intval($request->id);
        $existingUserData =Company_user::where('_id',$id)->where('delete_status','NO')->get();
        if($existingUserData != ''){
            return response()->json([
                'success' => $existingUserData,
            ]);
        }
        else{
            return response()->json([
                'success' => 'No record'
            ]);
        }
    }
       
        public function update_user(Request $request) //done
        {
            $token = $request->bearerToken();
            $secretKey ='345fgvvc4';
            $decryptedInput = decrypt($token, $secretKey);
            $token_data=list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
            $company_id=$token_data['0'];
            $new_id=intval($id);
            $reqid=intval($request->id);
            $existingUserData =Company_user::where('_id',$reqid)->first();
            if (!$existingUserData) {
                return response()->json(['message' => 'User not found'], 404);
            }
            $validatedData = $request->validate([
                'user_email' => 'required',
                'user_name' => 'required',
                // 'user_password' => 'required',
                'user_type' => 'required',
                'user_add_date' => 'required',
            ]);

            $password = hash('sha1', $request->user_password);
            $data = [
                'user_email' => $request->user_email,
                'user_name' => $request->user_name,
                'user_password' =>$password,
                'user_type' => $request->user_type,
                'user_add_date' => $request->user_add_date,
                'role' => $request->role,
                'employee' => $request->employee,
                'payroll' => $request->payroll,
                'attendance' => $request->attendance,
                'break' => $request->break,
                'leave' => $request->leave,
                'letters' => $request->letters,
                'administration' => $request->administration,
                'insertedTime' => time(),
                // 'insertedUserId' => Auth::user()->userFirstName.' '.Auth::user()->userLastName,
                'delete_status' => "NO",
                'deleteUser' => "",
                'deleteTime' => "",
            ];
            $result = $existingUserData->update($data);
                if ($result) {
                return response()->json(['message' => 'User updated successfully'], 200);
            } else {
                return response()->json(['message' => 'Failed to update user'], 500);
            }
        
        }
        public function delete_user(Request $request) //done
        {
            $token = $request->bearerToken();
            $secretKey ='345fgvvc4';
            $decryptedInput = decrypt($token, $secretKey);
            $token_data=list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
            
            $company_id=$token_data['0'];
            $new_id=intval($id);
            $data = Company_user::where('_id',$new_id)->first();
            $data->delete_status ='YES';
            $data->save();
            return response()->json(['status' => 'Deleted Successfully']);
        }
        public function view_user(Request $request)
        {
            $token = $request->bearerToken();
            //$token= $token_data->token;
            $secretKey ='345fgvvc4';
            $decryptedInput = decrypt($token, $secretKey);
            $token_data=list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
            $company_id=$token_data['0'];
            $company_id=intval($id);
            $records=Company_user::where('delete_status', 'NO')->get();
            return response()->json(['success' => true,'data' => $records], 200);
        }
        public function paginate_user(Request $request)
        {
            $token = $request->bearerToken();
            //$token= $token_data->token;
            $secretKey ='345fgvvc4';
            $decryptedInput = decrypt($token, $secretKey);
            $token_data=list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
            $company_id=$token_data['0'];
            $company_id=intval($id);
            $records=Company_user::where('delete_status', 'NO')->paginate(10);
            return response()->json(['success' => true,'data' => $records], 200);
        }
        public function search_user(Request $request) //search
        {
            $name=$request->name;
            $results=Company_user::where('user_name','like','%'.$name.'%')->get();
            // dd($results);
            if($results->isEmpty()) {
                return response()->json(['message' => 'No results found'], 404);
            } else {
                
                return response()->json(['results' => $results], 200);
            }
        }


}

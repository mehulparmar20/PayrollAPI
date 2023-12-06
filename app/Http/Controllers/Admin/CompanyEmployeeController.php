<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\API\Company_Admins;
use App\Models\API\Company_Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CompanyEmployeeController extends Controller
{
 
    public function add_employee(Request $request)
    {
      
        $token = $request->bearerToken();
        // dd($token);
        //$token= $token_data->token;
        // $secretKey ='345fgvvc4';
        // $decryptedInput = decrypt($token, $secretKey);
        // $token_data=list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
        // $company_id = intval($id); //fetch company_id
        
        // dd($request->employee_email);
                $password = Hash::make($request->user_password);
                // $password = hash('sha1',$request->password);
                $new_id = Company_Employee::max('_id') + 1;
                $data = [
                    '_id' => $new_id,
                    'company_id' => 2,
                    'counter' => 0,
                    'employee_email' => $request->employee_email,
                    'employee_password' => $password,
                    'delete_status' => 1,
                    'created_at' => '',
                    'updated_at' => '',
                ];
       

                $result =Company_Employee::insert($data);

                if ($result) {
                    return response()->json(['message' => 'Employee added successfully'], 201);
                } else {
                    return response()->json(['message' => 'Failed to Add Employee'], 500);
                }
            
        
    }


    }




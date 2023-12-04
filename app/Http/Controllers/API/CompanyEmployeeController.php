<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\API\Company_Admins;
use App\Models\API\Company_Employee;
use Illuminate\Http\Request;
use App\Helpers\AppHelper;
use Illuminate\Support\Facades\Hash;

class CompanyEmployeeController extends Controller
{
 
    // public function add_employee(Request $request)
    // {
    // //   dd('dd');
    //     $token = $request->bearerToken();
    //     // dd($token);
    //     // $token= $token_data->token;
    //     // $secretKey ="345fgvvc4";
    //     // $decryptedInput = decrypt($token, $secretKey);
    //     // dd($decryptedInput);
    //     // $token_data=list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
    //     // $company_id = intval($id); //fetch company_id
        
    //     // dd($request->employee_email);
    //             $password = Hash::make($request->user_password);
    //             $new_id = Company_Employee::max('_id') + 1;
    //             $data = [
    //                 '_id' => $new_id,
    //                 'company_id' => 2,
    //                 'counter' => 0,
    //                 'employee_email' => $request->employee_email,
    //                 'employee_password' => $password,
    //                 'delete_status' => 1,
    //                 'created_at' => '',
    //                 'updated_at' => '',
    //             ];
       

    //             $result =Company_Employee::insert($data);

    //             if ($result) {
    //                 return response()->json(['message' => 'Employee added successfully'], 201);
    //             } else {
    //                 return response()->json(['message' => 'Failed to Add Employee'], 500);
    //             }
            
        
    // }
    public function add_employee(Request $request)
    {
    
        $maxLength = 7000;
        $token = $request->bearerToken();
        //$token= $token_data->token;
        $secretKey = '345fgvvc4';
        $decryptedInput = decrypt($token, $secretKey);
         list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
         $companyId=intval($id);
         $docAvailable = AppHelper::instance()->checkDoc(Company_Employee::raw(),$companyId,$maxLength);
         $password = hash('sha1',$request->password);
         $cons = array(
            '_id' => 1,
            'company_id' => $companyId,
            'counter' => 0,
                    'employee_email' => $request->employee_email,
                    'employee_password' => $password,
                    'delete_status' => "NO",
                    'created_at' => '',
                    'updated_at' => '',
         );
       

         if($docAvailable != "No")
         {
             $info = (explode("^",$docAvailable));
             $docId = $info[1];
             $counter = $info[0];
        //    dd('fault');
             $cons['_id'] = AppHelper::instance()->getAdminDocumentSequence($companyId, Company_Employee::raw(),'company_employee',$docId);
             Company_Employee::raw()->updateOne(['company_id' => $companyId,'_id'=>(int)$docId], ['$push' => ['company_employee' => $cons]]);
             $cons['masterID'] = $docId;
             echo json_encode($cons);
 
             return response()->json(['message' => 'Employee Added successfully'], 201);
         }
         else
         {
             $parentId =AppHelper::instance()->getNextSequenceForNewDoc(\App\Models\API\Company_Employee::raw());
             $cons['_id'] =AppHelper::instance()->getNextSequenceForNewId(\App\Models\API\Company_Employee::raw(),'company_employee','$company_employee._id',$companyId);
             $arra = array(
                 "_id" => $parentId,
                 "counter" => (int)1,
                 "company_id" => (int)$companyId,
                 "company_employee" => array($cons),
             );
             \App\Models\API\Company_Employee::raw()->insertOne($arra);
             return response()->json(['message' => 'Employee Added successfully'], 201);
         }
            

    }

}


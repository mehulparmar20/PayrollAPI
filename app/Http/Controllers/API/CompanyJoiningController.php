<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\API\Company_Department;
use App\Models\API\Company_Employee;
use App\Models\API\Company_Joining;
use Illuminate\Http\Request;

class CompanyJoiningController extends Controller
{
    public function view_joinemployee(Request $request)
    {
        $token = $request->bearerToken();
        $secretKey = '345fgvvc4';
        $decryptedInput = decrypt($token, $secretKey);
        $token_data = list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
        $company_id = intval($id);
        $ids=(int)$request->id;
        $records =Company_Employee::where('_id', $ids)
            ->where('delete_status', 'NO')
            ->get();
            // dd($records);
            if ($records->isEmpty()) {
                return response()->json(['message' => 'No results found'], 404);
                } else {
                    return response()->json(['success' => true, 'data' => $records], 200);
                }
       
    }
    
    // public function view_joindepartment(Request $request)
    // {
    //     $token = $request->bearerToken();
    //     $secretKey = '345fgvvc4';
    //     $decryptedInput = decrypt($token, $secretKey);
    //     $token_data = list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
    //     $company_id = intval($id);
    //     $ids=(int)$request->id;
    //     $records =Company_Department::where('company_department._id', $ids)
    //         // ->where('company_department.delete_status', 'NO')
    //         ->where('company_id', $company_id)
    //         ->get();
        
    //         // dd($records);
    //         if ($records->isEmpty()) {
    //             return response()->json(['message' => 'No results found'], 404);
    //             } else {
    //                 return response()->json(['success' => true, 'data' => $records], 200);
    //             }
       
    // }
}

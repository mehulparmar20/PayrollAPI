<?php


namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\API\Company_Admins;
use App\Models\API\Company_CreditLeave;
use App\Helpers\AppHelper;
use App\Models\API\Company_Employee;
use Illuminate\Http\Request;


class CompanyCreditLeaveController extends Controller
{
    public function view_creditleave(Request $request)
    {
        $token = $request->bearerToken();
        $secretKey = '345fgvvc4';
        $decryptedInput = decrypt($token, $secretKey);
        $token_data = list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
        $company_id = intval($id);
        $records = $employee = Company_Employee::find($id)
        ->where('delete_status', 'NO')
            ->where('company_id', $company_id)
            ->get();
       dd($records);
            // $data = json_decode($records, true);

        if ($records) {
        //     $filteredData = array_map(function ($item) {
        //         $filteredDepartments = array_filter($item['company_time'], function ($time) {
        //             return $time['delete_status'] === 'NO';
        //         });
        //         $filteredDepartments = array_intersect_key($item['company_time'], $filteredDepartments);
        //         $item['company_time'] = $filteredDepartments;

        //         return $item;
        //     }, $data);
            return response()->json(['success' => true,'data' => $records], 200);
        }

       
        else {
            // Handle the case where no records are found
            return response()->json(['success' => false, 'message' => 'No records found'], 404);
        }
    }
}

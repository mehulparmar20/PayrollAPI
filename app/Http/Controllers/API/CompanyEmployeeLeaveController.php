<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\API\Company_Admins;
use App\Models\API\Employee_leave;
use App\Helpers\AppHelper;
use App\Models\API\Company_leave;
use Illuminate\Http\Request;

class CompanyEmployeeLeaveController extends Controller
{
    
    public function add_employee_leave(Request $request)
    {
        $maxLength = 7000;
        $token = $request->bearerToken();
        $secretKey = '345fgvvc4';
        $decryptedInput = decrypt($token, $secretKey);
        list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
        $companyId = intval($id);
        $docAvailable = AppHelper::instance()->checkDoc(Employee_leave::raw(), $companyId, $maxLength);
        $cons = array(
            '_id' => 1,
            'company_id' => $companyId,
            'counter' => 0,
            'employee_id'=>$request->employee_id,
            'leave_type' => $request->leave_type,
            'from_date' => $request->from_date,
            'to_date' => $request->to_date,
            'total_days' => $request->total_days,
            'remaining_leaves' => $request->remaining_leaves,
            'leave_reason' => $request->leave_reason,
            'status' =>'1',
            'delete_status' => "NO",
            'created_at' => '',
            'updated_at' => '',
        );
        if ($docAvailable != "No") {
            $info = (explode("^", $docAvailable));
            $docId = $info[1];
            // dd($docId);
            $counter = $info[0];
            $cons['_id'] = AppHelper::instance()->getAdminDocumentSequence($companyId, Employee_leave::raw(), 'employee_leave', $docId);
            Employee_leave::raw()->updateOne(['company_id' => $companyId, '_id' => (int)$docId], ['$push' => ['employee_leave' => $cons]]);
            $cons['masterID'] = $docId;
            echo json_encode($cons);

            return response()->json(['message' => 'Leave Added successfully'], 201);
        } else {
            $parentId = AppHelper::instance()->getNextSequenceForNewDoc(\App\Models\API\Employee_leave::raw());
            $cons['_id'] = AppHelper::instance()->getNextSequenceForNewId(\App\Models\API\Employee_leave::raw(), 'employee_leave', '$employee_leave._id', $companyId);
            $arra = array(
                "_id" => $parentId,
                "counter" => (int)1,
                "company_id" => (int)$companyId,
                "employee_leave" => array($cons),
            );
            \App\Models\API\Employee_leave::raw()->insertOne($arra);
            return response()->json(['message' => 'Leave Added successfully'], 201);
        }
    }

    public function delete_employee_leave(Request $request) 
    {
        $token = $request->bearerToken();
        $secretKey ='345fgvvc4';
        $decryptedInput = decrypt($token, $secretKey);
        list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
        $companyID=intval($id);
        $ids=(int)$request->id;
        $masterId=(int)$request->masterId;
        $designData=Employee_leave::raw()->updateOne(['company_id' => $companyID,'_id' => $masterId,'employee_leave._id' => $ids],
        ['$set' => ['employee_leave.$.delete_status' =>'YES','employee_leave.$.deleteUser' =>$companyID,'employee_leave.$.deleteTime' => time()]]
        );
       if ($designData==true)
       {
           $arr = array('status' => 'success', 'message' => 'Leave deleted successfully.','statusCode' => 200);
            return json_encode($arr);
       }
    }
    public function view_employee_leave(Request $request)
    {
        $token = $request->bearerToken();
        $secretKey = '345fgvvc4';
        $decryptedInput = decrypt($token, $secretKey);
        $token_data = list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
        $company_id = intval($id);
        $records = Employee_leave::where('employee_leave.delete_status', 'NO')
            ->where('company_id',$company_id)
            ->get();
            $data = json_decode($records, true);

        if ($data) {
            $filteredData = array_map(function ($item) {
                $filteredDepartments = array_filter($item['employee_leave'], function ($time) {
                    return $time['delete_status'] === 'NO';
                });
                $filteredDepartments = array_intersect_key($item['employee_leave'], $filteredDepartments);
                $item['employee_leave'] = $filteredDepartments;

                return $item;
            }, $data);
            return response()->json(['success' => true,'data' => $filteredData], 200);
        }

       
        else {
            // Handle the case where no records are found
            return response()->json(['status' => false, 'message' => 'No records found'], 200);
        }
    }
  
}

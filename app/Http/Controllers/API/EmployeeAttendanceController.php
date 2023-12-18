<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\API\Company_Admins;
use App\Models\API\Employee_Attendance;
use App\Helpers\AppHelper;
use Illuminate\Http\Request;

class EmployeeAttendanceController extends Controller
{
    public function add_employee_attendance(Request $request)
    {
        $maxLength = 7000;
        $token = $request->bearerToken();
        $secretKey = '345fgvvc4';
        $decryptedInput = decrypt($token, $secretKey);
        list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
        $companyId = intval($id);
        $docAvailable = AppHelper::instance()->checkDoc(Employee_Attendance::raw(), $companyId, $maxLength);
        $cons = array(
            '_id' => 1,
            'company_id' => $companyId,
            'counter' => 0,
            'employee_id'=>$request->employee_id,
            'attendance_time' =>time(),
            'status' => 1 ,
            'delete_status' => "NO",
            'created_at' => '',
            'updated_at' => '',
        );
        if ($docAvailable != "No") {
            $info = (explode("^", $docAvailable));
            $docId = $info[1];
            // dd($docId);
            $counter = $info[0];
            $cons['_id'] = AppHelper::instance()->getAdminDocumentSequence($companyId, Employee_Attendance::raw(), 'employee_attendance', $docId);
            Employee_Attendance::raw()->updateOne(['company_id' => $companyId, '_id' => (int)$docId], ['$push' => ['employee_attendance' => $cons]]);
            $cons['masterID'] = $docId;
            echo json_encode($cons);

            return response()->json(['message' => 'Leave Added successfully'], 201);
        } else {
            $parentId = AppHelper::instance()->getNextSequenceForNewDoc(\App\Models\API\Employee_Attendance::raw());
            $cons['_id'] = AppHelper::instance()->getNextSequenceForNewId(\App\Models\API\Employee_Attendance::raw(), 'employee_attendance', '$employee_attendance._id', $companyId);
            $arra = array(
                "_id" => $parentId,
                "counter" => (int)1,
                "company_id" => (int)$companyId,
                "employee_leave" => array($cons),
            );
            \App\Models\API\Employee_Attendance::raw()->insertOne($arra);
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
}
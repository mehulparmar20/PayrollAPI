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
        // $epoch = 1483228800;
        // $dt = new DateTime("@$epoch");  // convert UNIX timestamp to PHP DateTime
        // echo $dt->format('Y-m-d H:i:s');
        if($request->attendance_status == 'IN'){
            $cons = array(
                '_id' => 1,
                'company_id' => $companyId,
                'counter' => 0,
                'employee_id'=>$request->employee_id,
                'attendance_time' =>time(),
                'attendance_status' =>'IN',
                'status' => 1 ,
                'delete_status' => "NO",
                'created_at' => '',
                'updated_at' => '',
            );
        }
        else
        {
           $cons = array(
                '_id' => 1,
                'company_id' => $companyId,
                'counter' => 0,
                'employee_id'=>$request->employee_id,
                'attendance_time' =>time(),
                'attendance_status' =>'OUT',
                'status' => 1 ,
                'delete_status' => "NO",
                'created_at' => '',
                'updated_at' => '',
            );
        }
        
        if ($docAvailable != "No") {
            $info = (explode("^", $docAvailable));
            $docId = $info[1];
            $counter = $info[0];
            $cons['_id'] = AppHelper::instance()->getAdminDocumentSequence($companyId, Employee_Attendance::raw(), 'employee_attendance', $docId);
            Employee_Attendance::raw()->updateOne(['company_id' => $companyId, '_id' => (int)$docId], ['$push' => ['employee_attendance' => $cons]]);
            $cons['masterID'] = $docId;
            echo json_encode($cons);

            return response()->json(['message' => 'Attendance Added successfully'], 201);
        } else {
            $parentId = AppHelper::instance()->getNextSequenceForNewDoc(\App\Models\API\Employee_Attendance::raw());
            $cons['_id'] = AppHelper::instance()->getNextSequenceForNewId(\App\Models\API\Employee_Attendance::raw(), 'employee_attendance', '$employee_attendance._id', $companyId);
            $arra = array(
                "_id" => $parentId,
                "counter" => (int)1,
                "company_id" => (int)$companyId,
                "employee_attendance" => array($cons),
            );
            \App\Models\API\Employee_Attendance::raw()->insertOne($arra);
            return response()->json(['message' => 'Attendance Added successfully'], 201);
        }
    }

    public function view_employee_attendance(Request $request)// done
    {
        $token = $request->bearerToken();
        $secretKey ='345fgvvc4';
        $decryptedInput = decrypt($token, $secretKey);
        $token_data=list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
        $company_id=intval($id);
       $records=Employee_Attendance::where('employee_attendance.delete_status','NO')
       ->where('company_id',$company_id)->get();
      //relation
      // $records = employee_attendance::with('department')->get();
      // dd($records);
       $data = json_decode($records, true);
       if ($data) {
        $filteredData = array_map(function ($item)
        {
            $filteredDepartments = array_filter($item['employee_attendance'], function ($design) {
                return $design['delete_status'] === 'NO';
            });
            $filteredDepartments = array_intersect_key($item['employee_attendance'], $filteredDepartments);
            $item['employee_attendance'] = $filteredDepartments;
    
            return $item;
        }, $data);
    }
      return response()->json(['success' => true,'data' => $filteredData], 200);
    }
}
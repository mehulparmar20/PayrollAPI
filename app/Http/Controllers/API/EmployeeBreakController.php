<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\API\Company_Admins;
use App\Models\API\Company_Employee;
use App\Models\API\Employee_Break;
use App\Helpers\AppHelper;
use Illuminate\Http\Request;
use Carbon\Carbon;

class EmployeeBreakController extends Controller
{
    public function add_employee_break(Request $request)
    {
        $maxLength = 7000;
        $token = $request->bearerToken();
        $secretKey = '345fgvvc4';
        $decryptedInput = decrypt($token, $secretKey);
        list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
        $companyId = intval($id);
        $docAvailable = AppHelper::instance()->checkDoc(Employee_Break::raw(), $companyId, $maxLength);
        // $epoch = 1483228800;
        // $dt = new DateTime("@$epoch");  // convert UNIX timestamp to PHP DateTime
        // echo $dt->format('Y-m-d H:i:s');
        if($request->break_status == 'IN'){
            $cons = array(
                '_id' => 1,
                'company_id' => $companyId,
                'counter' => 0,
                'employee_id'=>$request->employee_id,
                'break_time' =>time(),
                'break_status' =>'IN',
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
                'break_time' =>time(),
                'break_status' =>'OUT',
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
            $cons['_id'] = AppHelper::instance()->getAdminDocumentSequence($companyId, Employee_Break::raw(), 'employee_break', $docId);
            Employee_Break::raw()->updateOne(['company_id' => $companyId, '_id' => (int)$docId], ['$push' => ['employee_break' => $cons]]);
            $cons['masterID'] = $docId;
            echo json_encode($cons);

            return response()->json(['message' => 'Attendance Added successfully'], 201);
        } else {
            $parentId = AppHelper::instance()->getNextSequenceForNewDoc(\App\Models\API\Employee_Break::raw());
            $cons['_id'] = AppHelper::instance()->getNextSequenceForNewId(\App\Models\API\Employee_Break::raw(), 'employee_break', '$employee_break._id', $companyId);
            $arra = array(
                "_id" => $parentId,
                "counter" => (int)1,
                "company_id" => (int)$companyId,
                "employee_break" => array($cons),
            );
            \App\Models\API\Employee_Break::raw()->insertOne($arra);
            return response()->json(['message' => 'Break Added successfully'], 201);
        }
    }

    //view employee attendance in current year and current month wise
    public function view_employee_break(Request $request)// done
    {
        $token = $request->bearerToken();
        $secretKey ='345fgvvc4';
        $decryptedInput = decrypt($token, $secretKey);
        $token_data=list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
        $companyID=intval($id);

        //company emplyee data dispalay
        $company_data = Company_Employee::where('company_id', $companyID)->get();
        $attendance_data = [];

        $currentDate = Carbon::now();
        $currentYear = $currentDate->year;
        $currentMonth = $currentDate->month;

        foreach ($company_data as $companyArr) {
            $company_employee_id = $companyArr['_id'];
        
            $employee_data = Employee_Break::raw()->find([
                'company_id' => $companyID,
                'employee_break.employee_id' => $company_employee_id
            ]);
           
            foreach ($employee_data as $cust) {
                $attendance = $cust['employee_break'];
       
                if (isset($attendance)) {
                $employee_name = $companyArr['first_name'] . ' ' . $companyArr['last_name'];

                    foreach ($attendance as $ct) {
                        $timestamp = $ct['attendance_time'];
                        $carbonDate = Carbon::createFromTimestamp($timestamp);
                        $year = $carbonDate->year;
                        $month = $carbonDate->month;
                        $day = $carbonDate->day;
        
                        // Check if the date is within the current month and year
                        if ($year === $currentYear && $month === $currentMonth) {
                            $employeeId = $ct['employee_id'];
                           
                            // Store attendance information by employee ID
                            if (!isset($attendance_data[$employeeId])) {
                                $attendance_data[$employeeId] = [
                                    'id' => $employeeId,
                                    'name' => $employee_name,
                                    'attendance' => []
                                ];
                            }
        
                            // Check if the date doesn't exist for the employee
                            $existingDate = $carbonDate->format('Y-m-d');
                            if (!in_array($existingDate, array_column($attendance_data[$employeeId]['attendance'], 'date'))) {
                                $attendance_data[$employeeId]['attendance'][] = [
                                    'date' => $existingDate,
                                    'time' => $carbonDate->format('H:i:s')
                                ];
                            }
                        }
                    }
                }
            }
        }

        $array = [];
        $array[] = [
            "attendance_list" => array_values($attendance_data), 
        ];
        return response()->json(['success' => true,'data' => $array], 200);
        }

        //search employee attendance in year and month wise
        public function search_employee_break(Request $request)// done
        {
            $token = $request->bearerToken();
            $secretKey ='345fgvvc4';
            $decryptedInput = decrypt($token, $secretKey);
            $token_data=list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
            $companyID=intval($id);
    
            //company emplyee data dispalay
            $company_data = Company_Employee::where('company_id', $companyID)->get();
            $attendance_data = [];
    
            $currentDate = Carbon::now();
            $currentYear =(int)$request->year;
            $currentMonth =(int)$request->month;
            foreach ($company_data as $companyArr) {
                $company_employee_id = $companyArr['_id'];
            
                $employee_data = Employee_Break::raw()->find([
                    'company_id' => $companyID,
                    'employee_break.employee_id' => $company_employee_id
                ]);
               
                foreach ($employee_data as $cust) {
                    $attendance = $cust['employee_break'];
           
                    if (isset($attendance)) {
                    $employee_name = $companyArr['first_name'] . ' ' . $companyArr['last_name'];
    
                        foreach ($attendance as $ct) {
                            $timestamp = $ct['attendance_time'];
                            $carbonDate = Carbon::createFromTimestamp($timestamp);
                            $year = $carbonDate->year;
                            $month = $carbonDate->month;
                            $day = $carbonDate->day;
            
                            // Check if the date is within the current month and year
                            if ($year === $currentYear && $month === $currentMonth) {
                                $employeeId = $ct['employee_id'];
                               
                                // Store attendance information by employee ID
                                if (!isset($attendance_data[$employeeId])) {
                                    $attendance_data[$employeeId] = [
                                        'id' => $employeeId,
                                        'name' => $employee_name,
                                        'attendance' => []
                                    ];
                                }
            
                                // Check if the date doesn't exist for the employee
                                $existingDate = $carbonDate->format('Y-m-d');
                                if (!in_array($existingDate, array_column($attendance_data[$employeeId]['attendance'], 'date'))) {
                                    $attendance_data[$employeeId]['attendance'][] = [
                                        'date' => $existingDate,
                                        'time' => $carbonDate->format('H:i:s')
                                    ];
                                }
                            }
                        }
                    }
                }
            }
    
            $array = [];
            $array[] = [
                "attendance_list" => array_values($attendance_data), // Resetting keys to start from 0
            ];
            return response()->json(['success' => true,'data' => $array], 200);
            }
}
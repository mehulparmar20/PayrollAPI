<?php


namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\API\Employee_leave;
use App\Helpers\AppHelper;
use Illuminate\Http\Request;

class CreditLeaveController extends Controller
{
    public function credit_leave(Request $request)
    {
        $token = $request->bearerToken();
        $secretKey ='345fgvvc4';
        $decryptedInput = decrypt($token, $secretKey);
        $token_data=list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
        $companyID=intval($id);

        //company emplyee data dispalay
        $company_data = Employee_leave::where('company_id', $companyID)->get();
        $attendance_data = [];

        // $currentDate = Carbon::now();
        // $currentYear = $currentDate->year;
        // $currentMonth = $currentDate->month;
  
        foreach ($company_data as $companyArr) {
            $company_employee_id = $companyArr['_id'];
        
            $employee_data = Employee_leave::raw()->find([
                'company_id' => $companyID
            ]);
            foreach ($employee_data as $cust) {
                $attendance = $cust['employee_leave'];
                foreach ($attendance as $attendance_data) {
                    $employeeId = $attendance_data['employee_id'];
                    if (!isset($employeeCount[$employeeId])) {
                        $employeeCount[$employeeId] = 1;
                    } else {
                        $employeeCount[$employeeId]++;
                    }
                }
            }
            
            // Display the count of occurrences for each employee_id
            foreach ($employeeCount as $employeeId => $count) {
                echo "Employee ID: $employeeId, Count: $count<br>";
            }
            // exit;
            foreach ($employee_data as $cust) {
                $attendance = $cust['employee_leave'];
                // dd($attendance);
                $attendanceCount = count($attendance);
                dd($attendanceCount);
                // foreach ($attendance as $attendance_data) {
                //     $companyId = $attendance_data['employee_id'];
                //     dd($companyId);
                // }
                // $employeeId = $cust['employee_id'];
            // dd($employeeId);
                if (isset($attendance)) {
                    foreach ($attendance as $ct) {
                        // dd($ct['employee_id']);
                        $employeeId = $ct['employee_id'];
                        $data_day = $ct['break_status'];
                        $timestamp = $ct['break_time'];
                        $carbonDate = Carbon::createFromTimestamp($timestamp);
                        $year = $carbonDate->year;
                        $month = $carbonDate->month;
                        $day = $carbonDate->day;
            
                        // Check if the date is within the current month and year
                        if ($year === $currentYear && $month === $currentMonth) {
                            // Fetch employee name based on the employee ID from $company_data
                            // $employee_name = $companyArr['first_name'] . ' ' . $companyArr['last_name'];
            // dd($company_data);
                            $employee = $company_data->firstWhere('_id', (int)$employeeId);
                            if ($employee) {
                                $employee_name = $employee['first_name'] . ' ' . $employee['last_name'];
                            } 
                            else {
                                $employee_name = '-'; // Set a default name or handle the case where the employee is not found
                            }
                            $existingDate = $carbonDate->format('Y-m-d');
            
                            // Check 'IN' and 'OUT' statuses for breaks
                            if ($data_day === 'IN' || $data_day === 'OUT') {
                                // Store the 'IN' and 'OUT' times for breaks
                                $break_type = ($data_day === 'IN') ? 'IN' : 'OUT';
                                $break_time = $carbonDate->format('H:i:s');
            
                                if (!isset($attendance_data[$employeeId]['attendance'][$existingDate])) {
                                    $attendance_data[$employeeId]['attendance'][$existingDate] = [
                                        'date' => $existingDate,
                                        'name' => $employee_name,
                                        'breaks' => []
                                    ];
                                }
            
                                $breaks_array = &$attendance_data[$employeeId]['attendance'][$existingDate]['breaks'];
            
                                if (count($breaks_array) < 2) {
                                    $breaks_array[] = [
                                        'type' => $break_type,
                                        'time' => $break_time
                                    ];
                                }
            
                                if (count($breaks_array) === 2) {
                                    $break_in_time = Carbon::createFromFormat('H:i:s', $breaks_array[0]['time']);
                                    $break_out_time = Carbon::createFromFormat('H:i:s', $breaks_array[1]['time']);
            
                                    $break_duration_minutes = $break_out_time->diffInMinutes($break_in_time);
            
                                    // Store break duration in minutes within 'breaks' array
                                    $breaks_array[1]['duration_minutes'] = $break_duration_minutes;
                                }
                            }
                        }
                    }
                }
            }
        }

        $array = [];
        $array[] = [
            "break_list" => array_values($attendance_data), 
        ];
        return response()->json(['success' => true,'data' => $array], 200);
    }   
}
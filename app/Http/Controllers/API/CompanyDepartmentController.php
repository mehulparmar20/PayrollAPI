<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\API\Company_Admins;
use App\Models\API\Company_Department;
use Illuminate\Http\Request;

class CompanyDepartmentController extends Controller
{
    public function add_department(Request $request) //done
    {
        $token = $request->bearerToken();
        //$token= $token_data->token;
        $secretKey = '345fgvvc4';
        $decryptedInput = decrypt($token, $secretKey);
        $token_data = list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
        $company_id = $token_data['0'];


            $latest_total_employee = Company_Admins::latest('_id')->value('total_employee');
            // Check if the current number of employees is less than the allowed total employees

          


                $validatedData = $request->validate([
                    'department_name' => 'required',
                ]);

                $new_id = Company_Department::max('_id') + 1;
                $data = [
                    '_id' => $new_id,
                    'company_id' => $company_id,
                    'counter' => $latest_total_employee,
                    'department_name' => $validatedData['department_name'],
                    'delete_status' => 1,
                    'created_at' => '',
                    'updated_at' => '',
                ];


                $result = Company_Department::insert($data);

                if ($result) {
                    return response()->json(['message' => 'Department added successfully'], 201);
                } else {
                    return response()->json(['message' => 'Failed to Add Department'], 500);
                }
            
    }


    public function update_department(Request $request) //done
    {

        $token = $request->bearerToken();
        //$token= $token_data->token;
        $secretKey = '345fgvvc4';
        $decryptedInput = decrypt($token, $secretKey);
        $token_data = list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
        $company_id = $token_data['0'];
        $new_id = intval($id);

        $reqid = intval($request->_id);
        // dd($reqid);
        $existingUserData = Company_Department::where('_id', $reqid)->first();

        if (!$existingUserData) {
            return response()->json(['message' => 'Department not found'], 404);
        }
        $validatedData = $request->validate([
            'department_name' => 'required',

        ]);

        $data = [
            'department_name' => $request['department_name'],
            'delete_status' => 1,
            'created_at' => '',
            'updated_at' => '',
        ];
        $result = $existingUserData->update($data);
        if ($result) {
            return response()->json(['message' => 'Department updated successfully'], 200);
        } else {
            return response()->json(['message' => 'Failed to Update Department'], 500);
        }
    }
    public function delete_department(Request $request, $id) //done
    {
        $token = $request->bearerToken();
        //$token= $token_data->token;
        $secretKey = '345fgvvc4';
        $decryptedInput = decrypt($token, $secretKey);
        $token_data = list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);

        $company_id = $token_data['0'];
        $new_id = intval($request->id);
        // dd($new_id);
        $data = Company_Department::where('_id', $new_id)->first();
        $data->delete_status = '0';
        $data->save();
        return response()->json(['status' => 'Deleted Successfully']);
    }

    public function index_department(Request $request)
    {
        $token = $request->bearerToken();
        //$token= $token_data->token;
        $secretKey = '345fgvvc4';
        $decryptedInput = decrypt($token, $secretKey);
        $token_data = list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
        $company_id = $token_data['0'];
        $company_id = intval($id);
        // $records = Company_Department::all();
        // dd($records);
        $records = Company_Department::where('delete_status', 1)->paginate(1);
        // return $records;
        return response()->json(['success' => true, 'data' => $records], 200);
    }

    public function searchdepartment($name) //search
    {
        $results =Company_Department::where('department_name', 'like', '%' . $name . '%')->get();
        // dd($results);
        if ($results->isEmpty()) {
            return response()->json(['message' => 'No results found'], 404);
        } else {

            return response()->json(['results' => $results], 200);
        }
    }
}



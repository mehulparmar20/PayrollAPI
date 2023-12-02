<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\API\Company_Admins;
use App\Models\API\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DepartmentController extends Controller
{
    public function add_department(Request $request) //done
    {
        $token = $request->bearerToken();
        //$token= $token_data->token;
        $secretKey = '345fgvvc4';
        $decryptedInput = decrypt($token, $secretKey);
        $token_data = list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
        $company_id = $token_data['0'];

        $latest_employee_id = Company_Admins::latest('_id')->value('_id');
        $company_id=intval($id);//fetch company_id
        $company_admins=Company_Admins::where('_id',$company_id)->value('total_employee'); //fetch total employee from company_admin
        $total=Department::where('company_id',$company_id)->count();//user count that particular id
        $company_admins = Company_Admins::where('_id', $company_id)->first();  //get latest record from company_admin
       if ($company_admins) {
            $allowed_total_employee = $company_admins->total_employee;
    
          $latest_total_employee = Company_Admins::latest('_id')->value('total_employee');
            // Check if the current number of employees is less than the allowed total employees
          
            if ($total < $allowed_total_employee) {


        $validatedData = $request->validate([
            'department_name' => 'required',
           ]);

        $new_id = Department::max('_id') + 1;
        $data = [
            '_id' => $new_id,
            'company_id' => $company_id,
            'counter' =>$latest_total_employee,
            'department_name' => $validatedData['department_name'],
            'delete_status' => 1,
            'created_at' =>'',
            'updated_at' =>'',
        ];


        $result = Department::insert($data);

        if ($result) {
            return response()->json(['message' => 'Department added successfully'], 201);
        } else {
            return response()->json(['message' => 'Failed to Add Department'], 500);
        }
    } else {
        return response()->json(['message' => 'Maximum number of employees reached for this company'], 400);
    }
} else {
    return response()->json(['message' => 'Company not found'], 404);
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
        $existingUserData = Department::where('_id', $reqid)->first();

        if (!$existingUserData) {
            return response()->json(['message' => 'Department not found'], 404);
        }
        $validatedData = $request->validate([
            'department_name' => 'required',
           
        ]);

        $data = [
            'department_name' => $request['department_name'],
            'delete_status' => 1,
            'created_at' =>'',
            'updated_at' =>'',
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
        $data = Department::where('_id', $new_id)->first();
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
        $records = Department::where('delete_status', 1)->get();
        // $records=Department::where("delete_status","1")->paginate(2);
        // dd($records);
        return $records;
        // return response()->json(['success' => true, 'data' => $records], 200);
    }

    public function searchdepartment($name) //search
    {
        $results = Department::where('department_name', 'like', '%' . $name . '%')->get();
        dd($results);
        if ($results->isEmpty()) {
            return response()->json(['message' => 'No results found'], 404);
        } else {

            return response()->json(['results' => $results], 200);
        }
    }
}

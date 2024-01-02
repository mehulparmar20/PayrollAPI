<?php

namespace App\Http\Controllers\API;
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\API\Company_Admins;
use App\Helpers\AppHelper;
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
        $ids1 = (int)$request->employee_id;
        $records = Company_Employee::where('_id', $ids1)
            ->where('delete_status', 'NO')
            ->where('company_id', $company_id)
            ->join('company_department', 'company_employee.department', '=', 'company_department._id')
            ->select('department', 'first_name', 'joining_date','company_department.department_name as department_name')
            ->get();
            // dd($records);
        if ($records->isEmpty()) {
            return response()->json(['status'=>false ,'message' => 'No results found'], 200);
        } else {
            return response()->json([
                'success' => true,
                'employee_data' => $records,
            ], 200);
        }
    }
    public function add_joining(Request $request)
    {
        $maxLength = 7000;
        $token = $request->bearerToken();
        $secretKey = '345fgvvc4';
        $decryptedInput = decrypt($token, $secretKey);
        list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
        $companyId = intval($id);
        $docAvailable = AppHelper::instance()->checkDoc(Company_Joining::raw(), $companyId, $maxLength);
        $password = hash('sha1', $request->password);
        $cons = array(
            '_id' => 1,
            'company_id' => $companyId,
            'counter' => 0,
            'manager_name' => $request->manager_name,
            'manager_designation' => $request->manager_designation,
            'employee' => $request->employee,
            'employee_id' => $request->employee_id,
            'department' => $request->department,
            'joining_date' => $request->joining_date,
            'delete_status' => "NO",
            'created_at' => '',
            'updated_at' => '',
        );
        if ($docAvailable != "No") {
            $info = (explode("^", $docAvailable));
            $docId = $info[1];
            $counter = $info[0];
            $cons['_id'] = AppHelper::instance()->getAdminDocumentSequence($companyId, Company_Joining::raw(), 'company_joining', $docId);
            Company_Joining::raw()->updateOne(['company_id' => $companyId, '_id' => (int)$docId], ['$push' => ['company_joining' => $cons]]);
            $cons['masterID'] = $docId;
            echo json_encode($cons);

            return response()->json(['message' => 'Joining Letter Added successfully'], 201);
        } else {
            $parentId = AppHelper::instance()->getNextSequenceForNewDoc(\App\Models\API\Company_Joining::raw());
            $cons['_id'] = AppHelper::instance()->getNextSequenceForNewId(\App\Models\API\Company_Joining::raw(), 'company_joining', '$company_joining._id', $companyId);
            $arra = array(
                "_id" => $parentId,
                "counter" => (int)1,
                "company_id" => (int)$companyId,
                "company_joining" => array($cons),
            );
            \App\Models\API\Company_Joining::raw()->insertOne($arra);
            return response()->json(['message' => 'Joining Letter Added successfully'], 201);
        }
    }
    public function edit_joining(Request $request)
    {

        $token = $request->bearerToken();
        $secretKey = '345fgvvc4';
        $decryptedInput = decrypt($token, $secretKey);
        list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
        $companyID = intval($id);
        $sid = intval($request->id);
        $masterId = (int)$request->masterId;
        $cursor = Company_Joining::raw()
        ->findOne(['company_id' => $companyID,'_id'=>$masterId,'company_joining._id' => $sid]);
        if ($cursor !== null && property_exists($cursor, 'company_joining')) {
        $consigneeArray=$cursor->company_joining;
        $consigneeLength=count($consigneeArray);
        $i=0;
        $v=0;
        for($i=0; $i<$consigneeLength; $i++)
        {
            $ids=$cursor->company_joining[$i]['_id'];
            $ids=(array)$ids;
            foreach($ids as $value)
            {
                if($value==$sid)
                {
                    $v=$i;
                }
            }
        }
        $companyID=array(
            "companyID"=>$masterId
        );
        $consignee=(array)$cursor->company_joining[$v];
            return response()->json([
                'success' => $consignee,
            ]);
        } else {
            return response()->json([
                'success' => 'No record'
            ]);
        }
    }
    public function update_joining(Request $request)
    {
        $collection = \App\Models\API\Company_Joining::raw();
        $token = $request->bearerToken();
        $secretKey = '345fgvvc4';
        $decryptedInput = decrypt($token, $secretKey);
        $token_data = list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
        $companyId = intval($id); //21
        $id = $request->id; //1
        $masterId = (int)$request->masterId;
        // dd($masterId);
        $maxLength = 6500;
        $docAvailable = AppHelper::instance()->checkDoc(\App\Models\API\Company_Joining::raw(),
         $companyId, $maxLength);
        $info = (explode("^", $docAvailable));
        $docId = $info[1];
        $userData = $collection->updateOne(
            ['company_id' => (int)$companyId, '_id' => (int)$masterId, 'company_joining._id' =>
             (int)$id],
            ['$set' => [
                'company_joining.$.manager_name' => $request->manager_name,
                'company_joining.$.manager_designation' => $request->manager_designation,
                'company_joining.$.employee' => $request->employee,
                'company_joining.$.employee_id' => $request->employee_id,
                'company_joining.$.department' => $request->department,
                'company_joining.$.joining_date' => $request->joining_date,
                'company_joining.$.edit_time' => time()
            ]]
        );
        if ($userData == true) {
            $arr = array('status' => 'success', 'message' => 'Joining Updated successfully.', 'statusCode' => 200);
            return json_encode($arr);
        } else {
            $arr = array('status' => 'success', 'message' => 'NO Joining Updated.', 'statusCode' => 500);
            return json_encode($arr);
        }
    }
    public function delete_joining(Request $request)
    {
        $token = $request->bearerToken();
        $secretKey = '345fgvvc4';
        $decryptedInput = decrypt($token, $secretKey);
        list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
        $ids = (int)$request->id;
        $masterId = (int)$request->masterId;
        // $masterId=(int)$request->parentId;
        $companyID = intval($id);
        $departData = Company_Joining::raw()->updateOne(
            ['company_id' => $companyID, '_id' => $masterId, 'company_joining._id' => $ids],
            ['$set' => ['company_joining.$.delete_status' => 'YES', 'company_joining.$.deleteUser'
             => $companyID, 'company_joining.$.deleteTime' => time()]]
        );
        if ($departData == true) {
            $arr = array('status' => 'success', 'message' => 'Joining deleted successfully.',
             'statusCode' => 200);
            return json_encode($arr);
        }
    }
     public function view_joining(Request $request)
    {
        $token = $request->bearerToken();
        $secretKey = '345fgvvc4';
        $decryptedInput = decrypt($token, $secretKey);
        $token_data = list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
        $company_id = intval($id);
        $records = Company_Joining::where('company_joining.delete_status', 'NO')
            ->where('company_id', $company_id)
            ->get();
       
            $data = json_decode($records, true);

        if ($data) {
            $filteredData = array_map(function ($item) {
                $filteredDepartments = array_filter($item['company_joining'], function ($time) {
                    return $time['delete_status'] === 'NO';
                });
                $filteredDepartments = array_intersect_key($item['company_joining'], $filteredDepartments);
                $item['company_joining'] = $filteredDepartments;

                return $item;
            }, $data);
            return response()->json(['success' => true,'data' => $filteredData], 200);
        }

       
        else {
            // Handle the case where no records are found
            return response()->json(['status' => false, 'message' => 'No records found'], 200);
        }
    }
    public function paginate_joining(Request $request)
    {
        $token = $request->bearerToken();
        $secretKey = '345fgvvc4';
        $decryptedInput = decrypt($token, $secretKey);
        $token_data = list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
        $company_id = intval($id);
        $record = Company_Joining::where('company_joining.delete_status', 'NO')
            ->where('company_id', $company_id)
            ->paginate(10);
            $data = json_decode($record, true);

        return response()->json(['success' => true, 'data' => $record], 200);
    }
    public function search_joining(Request $request)
    {
        $name = $request->manager_name;
        $results = Company_Joining::where('company_joining.manager_name', 'like', '%' . $name . '%')->get();
        if ($results->isEmpty()) {
            return response()->json(['status'=> false , 'message' => 'No results found'], 200);
        } else {
            return response()->json(['results' => $results], 200);
        }
    }

    
}

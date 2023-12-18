<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\API\Company_Admins;
use App\Models\API\Company_Department;
use App\Helpers\AppHelper;
use Illuminate\Http\Request;

class CompanyDepartmentController extends Controller
{
    public function add_department(Request $request)
    {
        $maxLength = 7000;
        $token = $request->bearerToken();
        $secretKey = '345fgvvc4';
        $decryptedInput = decrypt($token, $secretKey);
        list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
        $companyId = intval($id);
        $docAvailable = AppHelper::instance()->checkDoc(Company_Department::raw(), $companyId, $maxLength);
        $password = hash('sha1', $request->password);
        $cons = array(
            '_id' => 1,
            'company_id' => $companyId,
            'counter' => 0,
            'department_name' => $request->department_name,
            'delete_status' => "NO",
            'created_at' => '',
            'updated_at' => '',
        );
        if ($docAvailable != "No") {
            $info = (explode("^", $docAvailable));
            $docId = $info[1];
            $counter = $info[0];
            $cons['_id'] = AppHelper::instance()->getAdminDocumentSequence($companyId, Company_Department::raw(), 'company_department', $docId);
            Company_Department::raw()->updateOne(['company_id' => $companyId, '_id' => (int)$docId], ['$push' => ['company_department' => $cons]]);
            $cons['masterID'] = $docId;
            echo json_encode($cons);

            return response()->json(['message' => 'Department Added successfully'], 201);
        } else {
            $parentId = AppHelper::instance()->getNextSequenceForNewDoc(\App\Models\API\Company_Department::raw());
            $cons['_id'] = AppHelper::instance()->getNextSequenceForNewId(\App\Models\API\Company_Department::raw(), 'company_department', '$company_department._id', $companyId);
            $arra = array(
                "_id" => $parentId,
                "counter" => (int)1,
                "company_id" => (int)$companyId,
                "company_department" => array($cons),
            );
            \App\Models\API\Company_Department::raw()->insertOne($arra);
            return response()->json(['message' => 'Department Added successfully'], 201);
        }
    }

    
    public function edit_department(Request $request)
    {

        $token = $request->bearerToken();
        $secretKey = '345fgvvc4';
        $decryptedInput = decrypt($token, $secretKey);
        list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
        $companyID = intval($id);
        $sid = intval($request->id);
        $masterId = (int)$request->masterId;
        $cursor = Company_Department::raw()
        ->findOne(['company_id' => $companyID,'_id'=>$masterId,'company_department._id' => $sid]);
        if ($cursor !== null && property_exists($cursor, 'company_department')) {
        $consigneeArray=$cursor->company_department;
        $consigneeLength=count($consigneeArray);
        $i=0;
        $v=0;
        for($i=0; $i<$consigneeLength; $i++)
        {
            $ids=$cursor->company_department[$i]['_id'];
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
        $consignee=(array)$cursor->company_department[$v];
            return response()->json([
                'success' => $consignee,
            ]);
        } else {
            return response()->json([
                'success' => 'No record'
            ]);
        }
    }
    public function update_department(Request $request)
    {
        $collection = \App\Models\API\Company_Department::raw();
        $token = $request->bearerToken();
        $secretKey = '345fgvvc4';
        $decryptedInput = decrypt($token, $secretKey);
        $token_data = list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
        $companyId = intval($id); //21
        $id = $request->id; //1
        $masterId = (int)$request->masterId;
        // dd($masterId);
        $maxLength = 6500;
        $docAvailable = AppHelper::instance()->checkDoc(\App\Models\API\Company_Department::raw(),
         $companyId, $maxLength);
        $info = (explode("^", $docAvailable));
        $docId = $info[1];
        $userData = $collection->updateOne(
            ['company_id' => (int)$companyId, '_id' => (int)$masterId, 'company_department._id'
             =>
             (int)$id],
            ['$set' => [
                'company_department.$.department_name' => $request->department_name,
                'company_department.$.edit_time' => time()
            ]]
        );
        if ($userData == true) {
            $arr = array('status' => 'success', 'message' => 'Department Updated successfully.', 'statusCode' => 200);
            return json_encode($arr);
        } else {
            $arr = array('status' => 'success', 'message' => 'NO Department Updated.', 'statusCode' => 500);
            return json_encode($arr);
        }
    }
    public function delete_department(Request $request)
    {
        $token = $request->bearerToken();
        $secretKey = '345fgvvc4';
        $decryptedInput = decrypt($token, $secretKey);
        list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
        $ids = (int)$request->id;
        $masterId = (int)$request->masterId;
        // $masterId=(int)$request->parentId;
        $companyID = intval($id);
        $departData = Company_Department::raw()->updateOne(
            ['company_id' => $companyID, '_id' => $masterId, 'company_department._id' => $ids],
            ['$set' => ['company_department.$.delete_status' => 'YES', 'company_department.$.deleteUser'
             => $companyID, 'company_department.$.deleteTime' => time()]]
        );
        if ($departData == true) {
            $arr = array('status' => 'success', 'message' => 'Department deleted successfully.',
             'statusCode' => 200);
            return json_encode($arr);
        }
    }

    public function view_department(Request $request)
    {
        $token = $request->bearerToken();
        $secretKey = '345fgvvc4';
        $decryptedInput = decrypt($token, $secretKey);
        $token_data = list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
        $company_id = intval($id);
        $records = Company_Department::where('company_department.delete_status', 'NO')
            ->where('company_id', $company_id)
            ->get();
        // $data = json_decode($records, true);

        // if ($data) {
        //     $filteredData = array_map(function ($item) {
        //         $filteredDepartments = array_filter($item['company_department'], function ($department) {
        //             return $department['delete_status'] === 'NO';
        //         });
        //         $filteredDepartments = array_intersect_key($item['company_department'], $filteredDepartments);
        //         $item['company_department'] = $filteredDepartments;

        //         return $item;
        //     }, $data);
        // }

        // return response()->json(['success' => true, 'data' => $filteredData], 200);
        // return response()->json(['success' => true, 'data' => $records], 200);
        if ($records->isEmpty()) {
            return response()->json(['message' => 'No results found'], 404);
        } else {
            return response()->json(['success' => true, 'data' => $records], 200);
        }
    }
    public function paginate_department(Request $request)
    {
        $token = $request->bearerToken();
        $secretKey = '345fgvvc4';
        $decryptedInput = decrypt($token, $secretKey);
        $token_data = list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
        $company_id = intval($id);
        $record = Company_Department::where('company_department.delete_status', 'NO')
            ->where('company_id', $company_id)
            ->paginate(10);
        return response()->json(['success' => true, 'data' => $record], 200);
    }
    public function search_department(Request $request)
    {
        $name = $request->department_name;
        $results = Company_Department::where('company_department.department_name', 'like', '%' . $name . '%')->get();
        if ($results->isEmpty()) {
            return response()->json(['message' => 'No results found'], 404);
        } else {
            return response()->json(['results' => $results], 200);
        }
    }
}

<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\API\Company_Admins;
use App\Models\API\Company_leave;
use App\Helpers\AppHelper;
use Illuminate\Http\Request;

class CompanyLeaveTypeController extends Controller
{
    public function add_leave(Request $request)
    {
        $maxLength = 7000;
        $token = $request->bearerToken();
        $secretKey = '345fgvvc4';
        $decryptedInput = decrypt($token, $secretKey);
        list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
        $companyId = intval($id);
        $docAvailable = AppHelper::instance()->checkDoc(Company_leave::raw(), $companyId, $maxLength);
        $password = hash('sha1', $request->password);
        $cons = array(
            '_id' => 1,
            'company_id' => $companyId,
            'counter' => 0,
            'leave_type' => $request->leave_type,
            'delete_status' => "NO",
            'created_at' => '',
            'updated_at' => '',
        );
        if ($docAvailable != "No") {
            $info = (explode("^", $docAvailable));
            $docId = $info[1];
            $counter = $info[0];
            $cons['_id'] = AppHelper::instance()->getAdminDocumentSequence($companyId, Company_leave::raw(), 'company_leave', $docId);
            Company_leave::raw()->updateOne(['company_id' => $companyId, '_id' => (int)$docId], ['$push' => ['company_leave' => $cons]]);
            $cons['masterID'] = $docId;
            echo json_encode($cons);

            return response()->json(['message' => 'Company Leave Added successfully'], 201);
        } else {
            $parentId = AppHelper::instance()->getNextSequenceForNewDoc(\App\Models\API\Company_leave::raw());
            $cons['_id'] = AppHelper::instance()->getNextSequenceForNewId(\App\Models\API\Company_leave::raw(), 'company_leave', '$company_leave._id', $companyId);
            $arra = array(
                "_id" => $parentId,
                "counter" => (int)1,
                "company_id" => (int)$companyId,
                "company_leave" => array($cons),
            );
            \App\Models\API\Company_leave::raw()->insertOne($arra);
            return response()->json(['message' => 'Company Leave Added successfully'], 201);
        }
    }
    public function edit_leave(Request $request)
    {

        $token = $request->bearerToken();
        $secretKey = '345fgvvc4';
        $decryptedInput = decrypt($token, $secretKey);
        list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
        $companyID = intval($id);
        $sid = intval($request->id);
        $masterId = (int)$request->masterId;
        $cursor = Company_leave::raw()
        ->findOne(['company_id' => $companyID,'_id'=>$masterId,'company_leave._id' => $sid]);
        if ($cursor !== null && property_exists($cursor, 'company_leave')) {
        $consigneeArray=$cursor->company_leave;
        $consigneeLength=count($consigneeArray);
        $i=0;
        $v=0;
        for($i=0; $i<$consigneeLength; $i++)
        {
            $ids=$cursor->company_leave[$i]['_id'];
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
        $consignee=(array)$cursor->company_leave[$v];
            return response()->json([
                'success' => $consignee,
            ]);
        } else {
            return response()->json([
                'success' => 'No record'
            ]);
        }
    }
    public function update_leave(Request $request)
    {
        $collection = \App\Models\API\Company_leave::raw();
        $token = $request->bearerToken();
        $secretKey = '345fgvvc4';
        $decryptedInput = decrypt($token, $secretKey);
        $token_data = list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
        $companyId = intval($id); //21
        $id = $request->id; //1
        $masterId = (int)$request->masterId;
        // dd($masterId);
        $maxLength = 6500;
        $docAvailable = AppHelper::instance()->checkDoc(\App\Models\API\Company_leave::raw(),
         $companyId, $maxLength);
        $info = (explode("^", $docAvailable));
        $docId = $info[1];
        $userData = $collection->updateOne(
            ['company_id' => (int)$companyId, '_id' => (int)$masterId, 'company_leave._id' =>
             (int)$id],
            ['$set' => [
                'company_leave.$.leave_type' => $request->leave_type,
                'company_leave.$.edit_time' => time()
            ]]
        );
        if ($userData == true) {
            $arr = array('status' => 'success', 'message' => 'Company Leave Updated successfully.', 'statusCode' => 200);
            return json_encode($arr);
        } else {
            $arr = array('status' => 'success', 'message' => 'NO Company Leave Updated.', 'statusCode' => 500);
            return json_encode($arr);
        }
    }
    public function delete_leave(Request $request)
    {
        $token = $request->bearerToken();
        $secretKey = '345fgvvc4';
        $decryptedInput = decrypt($token, $secretKey);
        list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
        $ids = (int)$request->id;
        $masterId = (int)$request->masterId;
        // $masterId=(int)$request->parentId;
        $companyID = intval($id);
        $departData = Company_leave::raw()->updateOne(
            ['company_id' => $companyID, '_id' => $masterId, 'company_leave._id' => $ids],
            ['$set' => ['company_leave.$.delete_status' => 'YES', 'company_leave.$.deleteUser'
             => $companyID, 'company_leave.$.deleteTime' => time()]]
        );
        if ($departData == true) {
            $arr = array('status' => 'success', 'message' => 'Company Leave deleted successfully.',
             'statusCode' => 200);
            return json_encode($arr);
        }
    }
     public function view_leave(Request $request)
    {
        $token = $request->bearerToken();
        $secretKey = '345fgvvc4';
        $decryptedInput = decrypt($token, $secretKey);
        $token_data = list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
        $company_id = intval($id);
        $records = Company_leave::where('company_leave.delete_status', 'NO')
            ->where('company_id', $company_id)
            ->get();
       
            $data = json_decode($records, true);

        if ($data) {
            $filteredData = array_map(function ($item) {
                $filteredDepartments = array_filter($item['company_leave'], function ($time) {
                    return $time['delete_status'] === 'NO';
                });
                $filteredDepartments = array_intersect_key($item['company_leave'], $filteredDepartments);
                $item['company_leave'] = $filteredDepartments;

                return $item;
            }, $data);
        }

        return response()->json(['success' => true,'data' => $filteredData], 200);
    }
    public function paginate_leave(Request $request)
    {
        $token = $request->bearerToken();
        $secretKey = '345fgvvc4';
        $decryptedInput = decrypt($token, $secretKey);
        $token_data = list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
        $company_id = intval($id);
        $record = Company_leave::where('company_leave.delete_status', 'NO')
            ->where('company_id', $company_id)
            ->paginate(10);
            $data = json_decode($record, true);

        return response()->json(['success' => true, 'data' => $record], 200);
    }
    public function search_leave(Request $request)
    {
        $name = $request->leave_type;
        $results = Company_leave::where('company_leave.leave_type', 'like', '%' . $name . '%')->get();
        if ($results->isEmpty()) {
            return response()->json(['message' => 'No results found'], 404);
        } else {
            return response()->json(['results' => $results], 200);
        }
    }

}

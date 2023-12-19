<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\API\Company_Admins;
use App\Models\API\Company_Resignation;
use App\Helpers\AppHelper;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class CompanyResignationController extends Controller
{
    public function add_resignation(Request $request)
    {
        $maxLength = 7000;
        $token = $request->bearerToken();
        $secretKey = '345fgvvc4';
        $decryptedInput = decrypt($token, $secretKey);
        list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
        $companyId = intval($id);
        $docAvailable = AppHelper::instance()->checkDoc(Company_Resignation::raw(), $companyId, $maxLength);
        $password = hash('sha1', $request->password);
        $cons = array(
            '_id' => 1,
            'company_id' => $companyId,
            'counter' => 0,
            'reason' => $request->reason,
            'notice_date' => $request->notice_date,
            'resignation_date' => $request->resignation_date,
            'employee_id' => $request->employee_id,
            'status' => "NO",
            'created_at' => '',
            'updated_at' => '',
        );
        if ($docAvailable != "No") {
            $info = (explode("^", $docAvailable));
            $docId = $info[1];
            $counter = $info[0];
            $cons['_id'] = AppHelper::instance()->getAdminDocumentSequence($companyId, Company_Resignation::raw(), 'company_resignation', $docId);
            Company_Resignation::raw()->updateOne(['company_id' => $companyId, '_id' => (int)$docId], ['$push' => ['company_resignation' => $cons]]);
            $cons['masterID'] = $docId;
            echo json_encode($cons);

            return response()->json(['message' => 'Resignation Added successfully'], 201);
        } else {
            $parentId = AppHelper::instance()->getNextSequenceForNewDoc(\App\Models\API\Company_Resignation::raw());
            $cons['_id'] = AppHelper::instance()->getNextSequenceForNewId(\App\Models\API\Company_Resignation::raw(), 'company_resignation', '$company_resignation._id', $companyId);
            $arra = array(
                "_id" => $parentId,
                "counter" => (int)1,
                "company_id" => (int)$companyId,
                "company_resignation" => array($cons),
            );
            \App\Models\API\Company_Resignation::raw()->insertOne($arra);
            return response()->json(['message' => 'Resignation Added Successfully'], 201);
        }
    }
    public function edit_resignation(Request $request)
    {

        $token = $request->bearerToken();
        $secretKey = '345fgvvc4';
        $decryptedInput = decrypt($token, $secretKey);
        list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
        $companyID = intval($id);
        $sid = intval($request->id);
        $masterId = (int)$request->masterId;
        $cursor = Company_Resignation::raw()
        ->findOne(['company_id' => $companyID,'_id'=>$masterId,'company_resignation._id' => $sid]);
        if ($cursor !== null && property_exists($cursor, 'company_resignation')) {
        $consigneeArray=$cursor->company_resignation;
        $consigneeLength=count($consigneeArray);
        $i=0;
        $v=0;
        for($i=0; $i<$consigneeLength; $i++)
        {
            $ids=$cursor->company_resignation[$i]['_id'];
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
        $consignee=(array)$cursor->company_resignation[$v];
            return response()->json([
                'success' => $consignee,
            ]);
        } else {
            return response()->json([
                'success' => 'No record'
            ]);
        }
    }
    public function update_resignation(Request $request)
    {
        $collection = \App\Models\API\Company_Resignation::raw();
        $token = $request->bearerToken();
        $secretKey = '345fgvvc4';
        $decryptedInput = decrypt($token, $secretKey);
        $token_data = list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
        $companyId = intval($id); //21
        $id = $request->id; //1
        $masterId = (int)$request->masterId;
        $maxLength = 6500;
        $docAvailable = AppHelper::instance()->checkDoc(\App\Models\API\Company_Resignation::raw(),
         $companyId, $maxLength);
        $info = (explode("^", $docAvailable));
        $docId = $info[1];
        $userData = $collection->updateOne(
            ['company_id' => (int)$companyId, '_id' => (int)$masterId, 'company_resignation._id' =>
             (int)$id],
            ['$set' => [
                'company_resignation.$.reason' => $request->reason,
                'company_resignation.$.notice_date' => $request->notice_date,
                'company_resignation.$.resignation_date' => $request->resignation_date,
                'company_resignation.$.employee_id' => $request->employee_id,
                'company_resignation.$.edit_time' => time()
            ]]
        );
        if ($userData == true) {
            $arr = array('status' => 'success', 'message' => 'Resignation Updated Successfully.', 'statusCode' => 200);
            return json_encode($arr);
        } else {
            $arr = array('status' => 'success', 'message' => 'NO Resignation Updated.', 'statusCode' => 500);
            return json_encode($arr);
        }
    }
    public function delete_resignation(Request $request)
    {
        $token = $request->bearerToken();
        $secretKey = '345fgvvc4';
        $decryptedInput = decrypt($token, $secretKey);
        list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
        $ids = (int)$request->id;
        $masterId = (int)$request->masterId;
        // $masterId=(int)$request->parentId;
        $companyID = intval($id);
        $departData = Company_Resignation::raw()->updateOne(
            ['company_id' => $companyID, '_id' => $masterId, 'company_resignation._id' => $ids],
            ['$set' => ['company_resignation.$.status' => 'YES', 'company_resignation.$.deleteUser'
             => $companyID, 'company_resignation.$.deleteTime' => time()]]
        );
        if ($departData == true) {
            $arr = array('status' => 'success', 'message' => 'Resignation deleted successfully.',
             'statusCode' => 200);
            return json_encode($arr);
        }
    }
     public function view_resignation(Request $request)
    {
        $token = $request->bearerToken();
        $secretKey = '345fgvvc4';
        $decryptedInput = decrypt($token, $secretKey);
        $token_data = list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
        $company_id = intval($id);
        $records = Company_Resignation::where('company_resignation.status', 'NO')
            ->where('company_id', $company_id)
            ->get();
       
            $data = json_decode($records, true);
        if ($data) {
            $filteredData = array_map(function ($item) {
                $filteredDepartments = array_filter($item['company_resignation'], function ($time) {
                    return $time['status'] === 'NO';
                });
                $filteredDepartments = array_intersect_key($item['company_resignation'], $filteredDepartments);
                $item['company_resignation'] = $filteredDepartments;

                return $item;
            }, $data);
            
        return response()->json(['success' => true,'data' => $filteredData], 200);
        }

        else {
            // Handle the case where no records are found
            return response()->json(['success' => false, 'message' => 'No records found'], 404);
        }
    }
     public function paginate_resignation(Request $request)
    {
        $token = $request->bearerToken();
        $secretKey = '345fgvvc4';
        $decryptedInput = decrypt($token, $secretKey);
        $token_data = list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
        $company_id = intval($id);
        $record = Company_Resignation::where('company_resignation.status', 'NO')
            ->where('company_id', $company_id)
            ->paginate(10);
            // dd($record);
            // $data = json_decode($record, true);
        //     $data = $record->items();
        //     if ($data) {
        //         $filteredData = array_map(function ($item) {
        //             $filteredDepartments = array_filter($item['company_resignation'], function ($time) {
        //                 return $time['status'] === 'NO';
        //             });
        //             $filteredDepartments = array_intersect_key($item['company_resignation'], $filteredDepartments);
        //             $item['company_resignation'] = $filteredDepartments;
    
        //             return $item;
        //         }, $data);
        // return response()->json(['success' => true, 'data' => $filteredData], 200);
        //     }
        return response()->json(['success' => true, 'data' => $record], 200);

    }
    public function search_resignation(Request $request)
    {
        $name = $request->reason;
        $results = Company_Resignation::where('company_resignation.reason', 'like', '%' . $name . '%')->get();
        if ($results->isEmpty()) {
            return response()->json(['message' => 'No results found'], 404);
        } else {
            return response()->json(['results' => $results], 200);
        }
    }
}

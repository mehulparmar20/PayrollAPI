<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\API\Company_Admins;
use App\Models\API\Company_Workingday;
use App\Helpers\AppHelper;

class CompanyWorkingdayController extends Controller
{
      public function add_workingdays(Request $request)
    {
        $maxLength = 7000;
        $token = $request->bearerToken();
        $secretKey = '345fgvvc4';
        $decryptedInput = decrypt($token, $secretKey);
        list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
        $companyId = intval($id);
        $docAvailable = AppHelper::instance()->checkDoc(Company_Workingday::raw(), $companyId, $maxLength);
        $password = hash('sha1', $request->password);
        $cons = array(
            '_id' => 1,
            'company_id' => $companyId,
            'counter' => 0,
            'sunday' => $request->sunday,
            'monday' => $request->monday,
            'tuesday' => $request->tuesday,
            'wednesday' => $request->wednesday,
            'thursday' => $request->thursday,
            'friday' => $request->friday,
            'saturday' => $request->saturday,
            'monthly_allow_leave' => $request->monthly_allow_leave,
            'delete_status' => "NO",
            'created_at' => '',
            'updated_at' => '',
        );
        if ($docAvailable != "No") {
            $info = (explode("^", $docAvailable));
            $docId = $info[1];
            $counter = $info[0];
            $cons['_id'] = AppHelper::instance()->getAdminDocumentSequence($companyId, Company_Workingday::raw(), 'company_workingday', $docId);
            Company_Workingday::raw()->updateOne(['company_id' => $companyId, '_id' => (int)$docId], ['$push' => ['company_workingday' => $cons]]);
            $cons['masterID'] = $docId;
            echo json_encode($cons);

            return response()->json(['message' => 'Working Day Added successfully'], 201);
        } else {
            $parentId = AppHelper::instance()->getNextSequenceForNewDoc(\App\Models\API\Company_Workingday::raw());
            $cons['_id'] = AppHelper::instance()->getNextSequenceForNewId(\App\Models\API\Company_Workingday::raw(), 'company_workingday', '$company_workingday._id', $companyId);
            $arra = array(
                "_id" => $parentId,
                "counter" => (int)1,
                "company_id" => (int)$companyId,
                "company_workingday" => array($cons),
            );
            \App\Models\API\Company_Workingday::raw()->insertOne($arra);
            return response()->json(['message' => 'Working Day Added Successfully'], 201);
        }
    }
    public function edit_workingdays(Request $request)
    {

        $token = $request->bearerToken();
        $secretKey = '345fgvvc4';
        $decryptedInput = decrypt($token, $secretKey);
        list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
        $companyID = intval($id);
        $sid = intval($request->id);
        $masterId = (int)$request->masterId;
        $cursor = Company_Workingday::raw()
        ->findOne(['company_id' => $companyID,'_id'=>$masterId,'company_workingday._id' => $sid]);
        if ($cursor !== null && property_exists($cursor, 'company_workingday')) {
        $consigneeArray=$cursor->company_workingday;
        $consigneeLength=count($consigneeArray);
        $i=0;
        $v=0;
        for($i=0; $i<$consigneeLength; $i++)
        {
            $ids=$cursor->company_workingday[$i]['_id'];
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
        $consignee=(array)$cursor->company_workingday[$v];
            return response()->json([
                'success' => $consignee,
            ]);
        } else {
            return response()->json([
                'success' => 'No record'
            ]);
        }
    }
    public function update_workingdays(Request $request)
    {
        $collection = \App\Models\API\Company_Workingday::raw();
        $token = $request->bearerToken();
        $secretKey = '345fgvvc4';
        $decryptedInput = decrypt($token, $secretKey);
        $token_data = list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
        $companyId = intval($id); //21
        $id = $request->id; //1
        $masterId = (int)$request->masterId;
        // dd($masterId);
        $maxLength = 6500;
        $docAvailable = AppHelper::instance()->checkDoc(\App\Models\API\Company_Workingday::raw(),
         $companyId, $maxLength);
        $info = (explode("^", $docAvailable));
        $docId = $info[1];
        $userData = $collection->updateOne(
            ['company_id' => (int)$companyId, '_id' => (int)$masterId, 'company_workingday._id' =>
             (int)$id],
            ['$set' => [
                'company_workingday.$.sunday' => $request->sunday,
                'company_workingday.$.monday' => $request->monday,
                'company_workingday.$.tuesday' => $request->tuesday,
                'company_workingday.$.wednesday' => $request->wednesday,
                'company_workingday.$.thursday' => $request->thursday,
                'company_workingday.$.friday' => $request->friday,
                'company_workingday.$.saturday' => $request->saturday,
                'company_workingday.$.monthly_allow_leave' => $request->monthly_allow_leave,
                'company_workingday.$.edit_time' => time()
            ]]
        );
        if ($userData == true) {
            $arr = array('status' => 'success', 'message' => 'Working Days Updated successfully.', 'statusCode' => 200);
            return json_encode($arr);
        } else {
            $arr = array('status' => 'success', 'message' => 'NO Working Days Updated.', 'statusCode' => 500);
            return json_encode($arr);
        }
    }
    public function delete_workingdays(Request $request)
    {
        $token = $request->bearerToken();
        $secretKey = '345fgvvc4';
        $decryptedInput = decrypt($token, $secretKey);
        list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
        $ids = (int)$request->id;
        $masterId = (int)$request->masterId;
        // $masterId=(int)$request->parentId;
        $companyID = intval($id);
        $departData = Company_Workingday::raw()->updateOne(
            ['company_id' => $companyID, '_id' => $masterId, 'company_workingday._id' => $ids],
            ['$set' => ['company_workingday.$.delete_status' => 'YES', 'company_workingday.$.deleteUser'
             => $companyID, 'company_workingday.$.deleteTime' => time()]]
        );
        if ($departData == true) {
            $arr = array('status' => 'success', 'message' => 'Woking Days Deleted Successfully.',
             'statusCode' => 200);
            return json_encode($arr);
        }
    }
     public function view_workingdays(Request $request)
    {
        $token = $request->bearerToken();
        $secretKey = '345fgvvc4';
        $decryptedInput = decrypt($token, $secretKey);
        $token_data = list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
        $company_id = intval($id);
        $records = Company_Workingday::where('company_workingday.delete_status', 'NO')
            ->where('company_id', $company_id)
            ->get();
       
            $data = json_decode($records, true);

        if ($data) {
            $filteredData = array_map(function ($item) {
                $filteredDepartments = array_filter($item['company_workingday'], function ($time) {
                    return $time['delete_status'] === 'NO';
                });
                $filteredDepartments = array_intersect_key($item['company_workingday'], $filteredDepartments);
                $item['company_workingday'] = $filteredDepartments;

                return $item;
            }, $data);
            return response()->json(['success' => true,'data' => $filteredData], 200);
        }

       
        else {
            // Handle the case where no records are found
            return response()->json(['status' => false, 'message' => 'No records found'], 200);
        }
    }
   

}

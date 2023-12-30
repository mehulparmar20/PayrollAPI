<?php


namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\API\Company_Admins;
use App\Models\API\Company_Branch;
use App\Helpers\AppHelper;
use Illuminate\Http\Request;

class CompanyBranchController extends Controller
{
    public function add_branch(Request $request)
    {
        $maxLength = 7000;
        $token = $request->bearerToken();
        $secretKey = '345fgvvc4';
        $decryptedInput = decrypt($token, $secretKey);
        list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
        $companyId = intval($id);
        $docAvailable = AppHelper::instance()->checkDoc(Company_Branch::raw(), $companyId, $maxLength);
        $password = hash('sha1', $request->password);
        $cons = array(
            '_id' => 1,
            'company_id' => $companyId,
            'counter' => 0,
            'branch_name' => $request->branch_name,
            'address' => $request->address,
            'date' => $request->date,
            'shift_time' => $request->shift_time,
            'status' => "NO",
            'created_at' => '',
            'updated_at' => '',
        );
        if ($docAvailable != "No") {
            $info = (explode("^", $docAvailable));
            $docId = $info[1];
            $counter = $info[0];
            $cons['_id'] = AppHelper::instance()->getAdminDocumentSequence($companyId, Company_Branch::raw(), 'company_branch', $docId);
            Company_Branch::raw()->updateOne(['company_id' => $companyId, '_id' => (int)$docId], ['$push' => ['company_branch' => $cons]]);
            $cons['masterID'] = $docId;
            echo json_encode($cons);

            return response()->json(['message' => 'Branch Added successfully'], 201);
        } else {
            $parentId = AppHelper::instance()->getNextSequenceForNewDoc(\App\Models\API\Company_Branch::raw());
            $cons['_id'] = AppHelper::instance()->getNextSequenceForNewId(\App\Models\API\Company_Branch::raw(), 'company_branch', '$company_branch._id', $companyId);
            $arra = array(
                "_id" => $parentId,
                "counter" => (int)1,
                "company_id" => (int)$companyId,
                "company_branch" => array($cons),
            );
            \App\Models\API\Company_Branch::raw()->insertOne($arra);
            return response()->json(['message' => 'Branch Added successfully'], 201);
        }
    }
    public function edit_branch(Request $request)
    {

        $token = $request->bearerToken();
        $secretKey = '345fgvvc4';
        $decryptedInput = decrypt($token, $secretKey);
        list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
        $companyID = intval($id);
        $sid = intval($request->id);
        $masterId = (int)$request->masterId;
        $cursor = Company_Branch::raw()
        ->findOne(['company_id' => $companyID,'_id'=>$masterId,'company_branch._id' => $sid]);
        if ($cursor !== null && property_exists($cursor, 'company_branch')) {
        $consigneeArray=$cursor->company_branch;
        $consigneeLength=count($consigneeArray);
        $i=0;
        $v=0;
        for($i=0; $i<$consigneeLength; $i++)
        {
            $ids=$cursor->company_branch[$i]['_id'];
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
        $consignee=(array)$cursor->company_branch[$v];
            return response()->json([
                'success' => $consignee,
            ]);
        } else {
            return response()->json([
                'success' => 'No record'
            ]);
        }
    }
    public function update_branch(Request $request)
    {
        $collection = \App\Models\API\Company_Branch::raw();
        $token = $request->bearerToken();
        $secretKey = '345fgvvc4';
        $decryptedInput = decrypt($token, $secretKey);
        $token_data = list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
        $companyId = intval($id); //21
        $id = $request->id; //1
        $masterId = (int)$request->masterId;
        $maxLength = 6500;
        $docAvailable = AppHelper::instance()->checkDoc(\App\Models\API\Company_Branch::raw(),
         $companyId, $maxLength);
        $info = (explode("^", $docAvailable));
        $docId = $info[1];
        $userData = $collection->updateOne(
            ['company_id' => (int)$companyId, '_id' => (int)$masterId, 'company_branch._id' =>
             (int)$id],
            ['$set' => [
                'company_branch.$.branch_name' => $request->branch_name,
                'company_branch.$.address' => $request->address,
                'company_branch.$.date' => $request->date,
                'company_branch.$.shift_time' => $request->shift_time,
                'company_branch.$.edit_time' => time()
            ]]
        );
        if ($userData == true) {
            $arr = array('status' => 'success', 'message' => 'Branch Updated successfully.', 'statusCode' => 200);
            return json_encode($arr);
        } else {
            $arr = array('status' => 'success', 'message' => 'NO Branch Updated.', 'statusCode' => 500);
            return json_encode($arr);
        }
    }
    public function delete_branch(Request $request)
    {
        $token = $request->bearerToken();
        $secretKey = '345fgvvc4';
        $decryptedInput = decrypt($token, $secretKey);
        list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
        $ids = (int)$request->id;
        $masterId = (int)$request->masterId;
        // $masterId=(int)$request->parentId;
        $companyID = intval($id);
        $departData = Company_Branch::raw()->updateOne(
            ['company_id' => $companyID, '_id' => $masterId, 'company_branch._id' => $ids],
            ['$set' => ['company_branch.$.status' => 'YES', 'company_branch.$.deleteUser'
             => $companyID, 'company_branch.$.deleteTime' => time()]]
        );
        if ($departData == true) {
            $arr = array('status' => 'success', 'message' => 'Branch deleted successfully.',
             'statusCode' => 200);
            return json_encode($arr);
        }
    }
     public function view_branch(Request $request)
    {
        $token = $request->bearerToken();
        $secretKey = '345fgvvc4';
        $decryptedInput = decrypt($token, $secretKey);
        $token_data = list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
        $company_id = intval($id);
        $records = Company_Branch::where('company_branch.status', 'NO')
            ->where('company_id', $company_id)
            ->get();
       
            $data = json_decode($records, true);

        if ($data) {
            $filteredData = array_map(function ($item) {
                $filteredDepartments = array_filter($item['company_branch'], function ($time) {
                    return $time['status'] === 'NO';
                });
                $filteredDepartments = array_intersect_key($item['company_branch'], $filteredDepartments);
                $item['company_branch'] = $filteredDepartments;

                return $item;
            }, $data);
            
        return response()->json(['success' => true,'data' => $filteredData], 200);
        }

        else {
            // Handle the case where no records are found
            return response()->json(['success' => false, 'message' => 'No records found'], 404);
        }
    }
    public function paginate_branch(Request $request)
    {
        $token = $request->bearerToken();
        $secretKey = '345fgvvc4';
        $decryptedInput = decrypt($token, $secretKey);
        $token_data = list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
        $company_id = intval($id);
        $record = Company_Branch::where('company_branch.status', 'NO')
            ->where('company_id', $company_id)
            ->paginate(10);
            $data = json_decode($record, true);

        return response()->json(['success' => true, 'data' => $record], 200);
    }
    public function search_branch(Request $request)
    {
        $name = $request->branch_name;
        $results = Company_Branch::where('company_branch.branch_name', 'like', '%' . $name . '%')->get();
        if ($results->isEmpty()) {
            return response()->json(['message' => 'No results found'], 404);
        } else {
            return response()->json(['results' => $results], 200);
        }
    }
}

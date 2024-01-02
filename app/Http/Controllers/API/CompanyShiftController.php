<?php


namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\API\Company_Admins;
use App\Models\API\Company_Shift;
use App\Helpers\AppHelper;
use Illuminate\Http\Request;

class CompanyShiftController extends Controller
{
    public function add_company_shift(Request $request)
    {
        $maxLength = 7000;
        $token = $request->bearerToken();
        $secretKey = '345fgvvc4';
        $decryptedInput = decrypt($token, $secretKey);
        list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
        $companyId = intval($id);
        $docAvailable = AppHelper::instance()->checkDoc(Company_Shift::raw(), $companyId, $maxLength);
        $password = hash('sha1', $request->password);
        $cons = array(
            '_id' => 1,
            'company_id' => $companyId,
            'counter' => 0,
            'shift' => $request->shift,
            'shift_time' => $request->shift_time,
            'delete_status' => "NO",
            'created_at' => '',
            'updated_at' => '',
        );
        if ($docAvailable != "No") {
            $info = (explode("^", $docAvailable));
            $docId = $info[1];
            $counter = $info[0];
            $cons['_id'] = AppHelper::instance()->getAdminDocumentSequence($companyId, Company_Shift::raw(), 'company_shift', $docId);
            Company_Shift::raw()->updateOne(['company_id' => $companyId, '_id' => (int)$docId], ['$push' => ['company_shift' => $cons]]);
            $cons['masterID'] = $docId;
            echo json_encode($cons);

            return response()->json(['message' => 'Time Added successfully'], 201);
        } else {
            $parentId = AppHelper::instance()->getNextSequenceForNewDoc(\App\Models\API\Company_Shift::raw());
            $cons['_id'] = AppHelper::instance()->getNextSequenceForNewId(\App\Models\API\Company_Shift::raw(), 'company_shift', '$company_shift._id', $companyId);
            $arra = array(
                "_id" => $parentId,
                "counter" => (int)1,
                "company_id" => (int)$companyId,
                "company_shift" => array($cons),
            );
            \App\Models\API\Company_Shift::raw()->insertOne($arra);
            return response()->json(['message' => 'Comapny Shift Added successfully'], 201);
        }
    }
   
    public function delete_time(Request $request)
    {
        $token = $request->bearerToken();
        $secretKey = '345fgvvc4';
        $decryptedInput = decrypt($token, $secretKey);
        list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
        $ids = (int)$request->id;
        $masterId = (int)$request->masterId;
        // $masterId=(int)$request->parentId;
        $companyID = intval($id);
        $departData = Company_Shift::raw()->updateOne(
            ['company_id' => $companyID, '_id' => $masterId, 'company_shift._id' => $ids],
            ['$set' => ['company_shift.$.delete_status' => 'YES', 'company_shift.$.deleteUser'
             => $companyID, 'company_shift.$.deleteTime' => time()]]
        );
        if ($departData == true) {
            $arr = array('status' => 'success', 'message' => 'Time deleted successfully.',
             'statusCode' => 200);
            return json_encode($arr);
        }
    }
     public function view_company_shift(Request $request)
    {
        $token = $request->bearerToken();
        $secretKey = '345fgvvc4';
        $decryptedInput = decrypt($token, $secretKey);
        $token_data = list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
        $company_id = intval($id);
        $records = Company_Shift::where('company_shift.delete_status', 'NO')
            ->where('company_id', $company_id)
            ->get();
       
            $data = json_decode($records, true);

        if ($data) {
            $filteredData = array_map(function ($item) {
                $filteredDepartments = array_filter($item['company_shift'], function ($time) {
                    return $time['delete_status'] === 'NO';
                });
                $filteredDepartments = array_intersect_key($item['company_shift'], $filteredDepartments);
                $item['company_shift'] = $filteredDepartments;

                return $item;
            }, $data);
        }
        return response()->json(['success' => true,'data' => $filteredData], 200);
    }
    public function paginate_time(Request $request)
    {
        $token = $request->bearerToken();
        $secretKey = '345fgvvc4';
        $decryptedInput = decrypt($token, $secretKey);
        $token_data = list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
        $company_id = intval($id);
        $record = company_shift::where('company_shift.delete_status', 'NO')
            ->where('company_id', $company_id)
            ->paginate(10);
            $data = json_decode($record, true);

        return response()->json(['success' => true, 'data' => $record], 200);
    }
    public function search_time(Request $request)
    {
        $name = $request->shift_no;
        $results = company_shift::where('company_shift.shift_no', 'like', '%' . $name . '%')->get();
        if ($results->isEmpty()) {
            return response()->json(['status'=>false ,'message' => 'No results found'], 200);
        } else {
            return response()->json(['results' => $results], 200);
        }
    }

}

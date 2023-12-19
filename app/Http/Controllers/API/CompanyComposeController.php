<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\API\Company_Admins;
use App\Models\API\Company_Compose;
use App\Helpers\AppHelper;
use Illuminate\Http\Request;

class CompanyComposeController extends Controller
{
    public function add_compose(Request $request)
    {
        $maxLength = 7000;
        $token = $request->bearerToken();
        $secretKey = '345fgvvc4';
        $decryptedInput = decrypt($token, $secretKey);
        list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
        $companyId = intval($id);
        $docAvailable = AppHelper::instance()->checkDoc(Company_Compose::raw(), $companyId, $maxLength);
        $password = hash('sha1', $request->password);
        $cons = array(
            '_id' => 1,
            'company_id' => $companyId,
            'counter' => 0,
            'to' => $request->to,
            'subject' => $request->subject,
            'message' => $request->message,
            'delete_status' => "NO",
            'created_at' => '',
            'updated_at' => '',
        );
        if ($docAvailable != "No") {
            $info = (explode("^", $docAvailable));
            $docId = $info[1];
            $counter = $info[0];
            $cons['_id'] = AppHelper::instance()->getAdminDocumentSequence($companyId, Company_Compose::raw(), 'company_compose', $docId);
            Company_Compose::raw()->updateOne(['company_id' => $companyId, '_id' => (int)$docId], ['$push' => ['company_compose' => $cons]]);
            $cons['masterID'] = $docId;
            echo json_encode($cons);

            return response()->json(['message' => 'Company Compose Added successfully'], 201);
        } else {
            $parentId = AppHelper::instance()->getNextSequenceForNewDoc(\App\Models\API\Company_Compose::raw());
            $cons['_id'] = AppHelper::instance()->getNextSequenceForNewId(\App\Models\API\Company_Compose::raw(), 'company_compose', '$company_compose._id', $companyId);
            $arra = array(
                "_id" => $parentId,
                "counter" => (int)1,
                "company_id" => (int)$companyId,
                "company_compose" => array($cons),
            );
            \App\Models\API\Company_Compose::raw()->insertOne($arra);
            return response()->json(['message' => 'Company Compose Added successfully'], 201);
        }
    }
    public function view_compose(Request $request)
    {
        $token = $request->bearerToken();
        $secretKey = '345fgvvc4';
        $decryptedInput = decrypt($token, $secretKey);
        $token_data = list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
        $company_id = intval($id);
        $records = Company_Compose::where('company_compose.delete_status', 'NO')
            ->where('company_id', $company_id)
            ->get();
       
            $data = json_decode($records, true);

        if ($data) {
            $filteredData = array_map(function ($item) {
                $filteredDepartments = array_filter($item['company_compose'], function ($time) {
                    return $time['delete_status'] === 'NO';
                });
                $filteredDepartments = array_intersect_key($item['company_compose'], $filteredDepartments);
                $item['company_compose'] = $filteredDepartments;

                return $item;
            }, $data);
            return response()->json(['success' => true,'data' => $filteredData], 200);
        }

       
        else {
            // Handle the case where no records are found
            return response()->json(['success' => false, 'message' => 'No records found'], 404);
        }
    }
}

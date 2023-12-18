<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\API\Company_Admins;
use App\Helpers\AppHelper;
use App\Models\API\Company_EmployeeHistory;
use Illuminate\Http\Request;

class CompanyEmployeeHistoryController extends Controller
{
    public function add_employeehistory(Request $request)
    {
        $maxLength = 7000;
        $token = $request->bearerToken();
        $secretKey = '345fgvvc4';
        $decryptedInput = decrypt($token, $secretKey);
        list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
        $companyId = intval($id);
        $docAvailable = AppHelper::instance()->checkDoc(Company_EmployeeHistory::raw(), $companyId, $maxLength);
        $password = hash('sha1', $request->password);
        $cons = array(
            '_id' => 1,
            'company_id' => $companyId,
            'counter' => 0,
            'employee_name' => $request->employee_name,
            'joining_date' => $request->joining_date,
            'status' => "DEACTIVE",
            'created_at' => '',
            'updated_at' => '',
        );
        if ($docAvailable != "No") {
            $info = (explode("^", $docAvailable));
            $docId = $info[1];
            $counter = $info[0];
            $cons['_id'] = AppHelper::instance()->getAdminDocumentSequence($companyId, Company_EmployeeHistory::raw(), 'company_employeehistory', $docId);
            Company_EmployeeHistory::raw()->updateOne(['company_id' => $companyId, '_id' => (int)$docId], ['$push' => ['company_employeehistory' => $cons]]);
            $cons['masterID'] = $docId;
            echo json_encode($cons);

            return response()->json(['message' => 'Employee History Added successfully'], 201);
        } else {
            $parentId = AppHelper::instance()->getNextSequenceForNewDoc(\App\Models\API\Company_EmployeeHistory::raw());
            $cons['_id'] = AppHelper::instance()->getNextSequenceForNewId(\App\Models\API\Company_EmployeeHistory::raw(), 'company_employeehistory', '$company_employeehistory._id', $companyId);
            $arra = array(
                "_id" => $parentId,
                "counter" => (int)1,
                "company_id" => (int)$companyId,
                "company_employeehistory" => array($cons),
            );
            \App\Models\API\Company_EmployeeHistory::raw()->insertOne($arra);
            return response()->json(['message' => 'Employee History Added successfully'], 201);
        }
    }
}

<?php


namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\API\Company_Admins;
use App\Models\API\Company_Fileupload;
use App\Helpers\AppHelper;
use Illuminate\Http\Request;
class CompanyFileuploadController extends Controller
{
    public function add_fileupload(Request $request)
    {
        $maxLength = 7000;
        $token = $request->bearerToken();
        $secretKey = '345fgvvc4';
        $decryptedInput = decrypt($token, $secretKey);
        list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
        $companyId = intval($id);
        $docAvailable = AppHelper::instance()->checkDoc(Company_Fileupload::raw(), $companyId, $maxLength);
        $file = $request->file('fileupload');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('uploads', $filename, 'public');
        $cons = array(
            '_id' => 1,
            'company_id' => $companyId,
            'counter' => 0,
            'employee_id' => $request->employee_id,
            'fileupload' => $filename,
            'delete_status' => "NO",
            'created_at' => '',
            'updated_at' => '',
        );
        if ($docAvailable != "No") {
            $info = (explode("^", $docAvailable));
            $docId = $info[1];
            $counter = $info[0];
            $cons['_id'] = AppHelper::instance()->getAdminDocumentSequence($companyId, Company_Fileupload::raw(), 'company_employeefileupload', $docId);
            Company_Fileupload::raw()->updateOne(['company_id' => $companyId, '_id' => (int)$docId], ['$push' => ['company_employeefileupload' => $cons]]);
            $cons['masterID'] = $docId;
            echo json_encode($cons);

            return response()->json(['message' => 'File Uploaded successfully'], 201);
        } else {
            $parentId = AppHelper::instance()->getNextSequenceForNewDoc(\App\Models\API\Company_Fileupload::raw());
            $cons['_id'] = AppHelper::instance()->getNextSequenceForNewId(\App\Models\API\Company_Fileupload::raw(), 'company_employeefileupload', '$company_employeefileupload._id', $companyId);
            $arra = array(
                "_id" => $parentId,
                "counter" => (int)1,
                "company_id" => (int)$companyId,
                "company_employeefileupload" => array($cons),
            );
            \App\Models\API\Company_Fileupload::raw()->insertOne($arra);
            return response()->json(['message' => 'File Uploaded successfully'], 201);
        }
    }
    public function view_fileupload(Request $request)
    {
        $token = $request->bearerToken();
        $secretKey = '345fgvvc4';
        $decryptedInput = decrypt($token, $secretKey);
        $token_data = list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
        $company_id = intval($id);
        $records = Company_Fileupload::where('company_employeefileupload.delete_status', 'NO')
            ->where('company_id', $company_id)
            ->get();
       
            $data = json_decode($records, true);

        if ($data) {
            $filteredData = array_map(function ($item) {
                $filteredDepartments = array_filter($item['company_employeefileupload'], function ($time) {
                    return $time['delete_status'] === 'NO';
                });
                $filteredDepartments = array_intersect_key($item['company_employeefileupload'], $filteredDepartments);
                $item['company_employeefileupload'] = $filteredDepartments;

                return $item;
            }, $data);
            return response()->json(['success' => true,'data' => $filteredData], 200);
        }

       
        else {
            // Handle the case where no records are found
            return response()->json(['status' => false, 'message' => 'No records found'], 200);
        }
    }
    public function delete_fileupload(Request $request)
    {
        $token = $request->bearerToken();
        $secretKey = '345fgvvc4';
        $decryptedInput = decrypt($token, $secretKey);
        list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
        $ids = (int)$request->id;
        $masterId = (int)$request->masterId;
        // $masterId=(int)$request->parentId;
        $companyID = intval($id);
        $departData = Company_Fileupload::raw()->updateOne(
            ['company_id' => $companyID, '_id' => $masterId, 'company_employeefileupload._id' => $ids],
            ['$set' => ['company_employeefileupload.$.delete_status' => 'YES', 'company_employeefileupload.$.deleteUser'
             => $companyID, 'company_employeefileupload.$.deleteTime' => time()]]
        );
        if ($departData == true) {
            $arr = array('status' => 'success', 'message' => 'File deleted successfully.',
             'statusCode' => 200);
            return json_encode($arr);
        }
    }
    
}

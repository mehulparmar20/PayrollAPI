<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\API\Company_Admins;
use App\Helpers\AppHelper;
use App\Models\API\Company_Document;
use Illuminate\Http\Request;

class CompanyDocumentController extends Controller
{
    public function add_document(Request $request)
    {
       
        $maxLength = 7000;
        $token = $request->bearerToken();
        $secretKey = '345fgvvc4';
        $decryptedInput = decrypt($token, $secretKey);
        list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
        $companyId = intval($id);
        $docAvailable = AppHelper::instance()->checkDoc(Company_Document::raw(), $companyId, $maxLength);
        $file = $request->file('file');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('uploads', $filename, 'public');
        $cons = array(
            '_id' => 1,
            'company_id' => $companyId,
            'counter' => 0,
            'admin_id' => $request->admin_id,
            'file' => $filename,
            'delete_status' => "NO",
            'created_at' => '',
            'updated_at' => '',
        );
        if ($docAvailable != "No") {
            $info = (explode("^", $docAvailable));
            $docId = $info[1];
            $counter = $info[0];
            $cons['_id'] = AppHelper::instance()->getAdminDocumentSequence($companyId, Company_Document::raw(), 'company_document', $docId);
            Company_Document::raw()->updateOne(['company_id' => $companyId, '_id' => (int)$docId], ['$push' => ['company_document' => $cons]]);
            $cons['masterID'] = $docId;
            echo json_encode($cons);

            return response()->json(['message' => 'File Uploaded successfully'], 201);
        } else {
            $parentId = AppHelper::instance()->getNextSequenceForNewDoc(\App\Models\API\Company_Document::raw());
            $cons['_id'] = AppHelper::instance()->getNextSequenceForNewId(\App\Models\API\Company_Document::raw(), 'company_document', '$company_document._id', $companyId);
            $arra = array(
                "_id" => $parentId,
                "counter" => (int)1,
                "company_id" => (int)$companyId,
                "company_document" => array($cons),
            );
            \App\Models\API\Company_Document::raw()->insertOne($arra);
            return response()->json(['message' => 'File Uploaded successfully'], 201);
        }
    }
    public function view_document(Request $request)
    {
        $token = $request->bearerToken();
        $secretKey = '345fgvvc4';
        $decryptedInput = decrypt($token, $secretKey);
        $token_data = list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
        $company_id = intval($id);
        $records = Company_Document::where('company_document.delete_status', 'NO')
            ->where('company_id', $company_id)
            ->get();
       
            $data = json_decode($records, true);

        if ($data) {
            $filteredData = array_map(function ($item) {
                $filteredDepartments = array_filter($item['company_document'], function ($time) {
                    return $time['delete_status'] === 'NO';
                });
                $filteredDepartments = array_intersect_key($item['company_document'], $filteredDepartments);
                $item['company_document'] = $filteredDepartments;

                return $item;
            }, $data);
            return response()->json(['success' => true,'data' => $filteredData], 200);
        }

       
        else {
            // Handle the case where no records are found
            return response()->json(['status' => false, 'message' => 'No records found'], 200);
        }
    }
    public function delete_document(Request $request)
    {
        $token = $request->bearerToken();
        $secretKey = '345fgvvc4';
        $decryptedInput = decrypt($token, $secretKey);
        list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
        $ids = (int)$request->id;
        $masterId = (int)$request->masterId;
        // $masterId=(int)$request->parentId;
        $companyID = intval($id);
        $departData = Company_Document::raw()->updateOne(
            ['company_id' => $companyID, '_id' => $masterId, 'company_document._id' => $ids],
            ['$set' => ['company_document.$.delete_status' => 'YES', 'company_document.$.deleteUser'
             => $companyID, 'company_document.$.deleteTime' => time()]]
        );
        if ($departData == true) {
            $arr = array('status' => 'success', 'message' => 'File deleted successfully.',
             'statusCode' => 200);
            return json_encode($arr);
        }
}
}

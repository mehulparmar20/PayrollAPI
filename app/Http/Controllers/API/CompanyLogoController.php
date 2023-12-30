<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\API\Company_Admins;
use App\Helpers\AppHelper;
use App\Models\API\Company_Logo;
use Illuminate\Http\Request;

class CompanyLogoController extends Controller
{
    public function add_logo(Request $request)
    {
       
        $maxLength = 7000;
        $token = $request->bearerToken();
        $secretKey = '345fgvvc4';
        $decryptedInput = decrypt($token, $secretKey);
        list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
        $companyId = intval($id);
        $docAvailable = AppHelper::instance()->checkDoc(Company_Logo::raw(), $companyId, $maxLength);
        $file = $request->file('logo');
        $maxWidth = 40;
        $maxHeight = 40;
        list($width, $height) = getimagesize($file);
        if ($width > $maxWidth || $height > $maxHeight) {
            return response()->json(['error' => 'Image size should be 40px x 40px.'], 422);
        }
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('uploads', $filename, 'public');
        $cons = array(
            '_id' => 1,
            'company_id' => $companyId,
            'counter' => 0,
            'admin_id' => $request->admin_id,
            'logo' => $filename,
            'delete_status' => "NO",
            'created_at' => '',
            'updated_at' => '',
        );
        if ($docAvailable != "No") {
            $info = (explode("^", $docAvailable));
            $docId = $info[1];
            $counter = $info[0];
            $cons['_id'] = AppHelper::instance()->getAdminDocumentSequence($companyId, Company_Logo::raw(), 'company_logo', $docId);
            Company_Logo::raw()->updateOne(['company_id' => $companyId, '_id' => (int)$docId], ['$push' => ['company_logo' => $cons]]);
            $cons['masterID'] = $docId;
            echo json_encode($cons);

            return response()->json(['message' => 'Logo Uploaded successfully'], 201);
        } else {
            $parentId = AppHelper::instance()->getNextSequenceForNewDoc(\App\Models\API\Company_Logo::raw());
            $cons['_id'] = AppHelper::instance()->getNextSequenceForNewId(\App\Models\API\Company_Logo::raw(), 'company_logo', '$company_logo._id', $companyId);
            $arra = array(
                "_id" => $parentId,
                "counter" => (int)1,
                "company_id" => (int)$companyId,
                "company_logo" => array($cons),
            );
            \App\Models\API\Company_Logo::raw()->insertOne($arra);
            return response()->json(['message' => 'Logo Uploaded successfully'], 201);
        }
    }
    public function view_logo(Request $request)
    {
        $token = $request->bearerToken();
        $secretKey = '345fgvvc4';
        $decryptedInput = decrypt($token, $secretKey);
        $token_data = list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
        $company_id = intval($id);
        $records = Company_Logo::where('company_logo.delete_status', 'NO')
            ->where('company_id', $company_id)
            ->get();
       
            $data = json_decode($records, true);

        if ($data) {
            $filteredData = array_map(function ($item) {
                $filteredDepartments = array_filter($item['company_logo'], function ($time) {
                    return $time['delete_status'] === 'NO';
                });
                $filteredDepartments = array_intersect_key($item['company_logo'], $filteredDepartments);
                $item['company_logo'] = $filteredDepartments;

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

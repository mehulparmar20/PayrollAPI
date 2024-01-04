<?php


namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\API\Salary_Master;
use App\Helpers\AppHelper;
use Illuminate\Http\Request;

class CompanySalaryMasterController extends Controller
{
    public function set_salary_setup(Request $request)
    {
        $maxLength = 7000;
        $token = $request->bearerToken();
        $secretKey = '345fgvvc4';
        $decryptedInput = decrypt($token, $secretKey);
        list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
        $companyId = intval($id);
        $departmentId = $request->department_id;
        $employee_id = $request->employee_id;

    }
    public function add_salary_setup(Request $request)
    {
        // dd($request);
        $maxLength = 7000;
        $token = $request->bearerToken();
        $secretKey = '345fgvvc4';
        $decryptedInput = decrypt($token, $secretKey);
        list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
        $companyId = intval($id);
        $docAvailable = AppHelper::instance()->checkDoc(Salary_Master::raw(), $companyId, $maxLength);
        // Assuming you have the following variables from your form submission
        $departmentId = $request->department_id;
        $ctc = $request->ctc;
        $typeId2 =$request->type_id_2;
        $data2 = $request->data_2;
        $typeId3 =$request->type_id_3;
        $data3 = $request->data_3;
        $typeId4 = $request->type_id_4;
        $data4 = $request->data_4;

        // Function to parse the data string into an array of associative arrays
     function parseDataString($dataString) {
        $dataArray = [];
    
        $cleanedString = str_replace(["name:", "deduct_type:"], ['"name":', '"deduct_type":'], $dataString);
        $cleanedString = str_replace([' ', ' ,'], ['', ','], $cleanedString);
    
        // Add square brackets to make it a JSON array
        $jsonString = '[' . $cleanedString . ']';
        $decodedData = json_decode($jsonString, true);
    
        if ($decodedData !== null) {
            // If decoding was successful, use the decoded data
            foreach ($decodedData as $data) {
                foreach($data as $d){
                $dataArray[] = [
                    'name' => $d['name'],
                    'deduct_type' => $d['deduct_type']
                ];
            }
            }
        } 
    
        return $dataArray;
    }

        // Create an array structure based on the provided data
        $resultArray = [
            'type_data' => [
                [
                    'type_id' => $typeId2,
                    'data' => parseDataString($data2)
                ],
                [
                    'type_id' => $typeId3,
                    'data' => parseDataString($data3)
                ],
                [
                    'type_id' => $typeId4,
                    'data' => parseDataString($data4)
                ]
            ]
        ];
        $cons = array(
            '_id' => 1,
            'company_id' => $companyId,
            'counter' => 0,
            'department_id' => $request->department_id,
            'type_id'=>$resultArray,
            'delete_status' => "NO",
            'created_at' => '',
            'updated_at' => '',
        );
        if ($docAvailable != "No") {
            $info = (explode("^", $docAvailable));
            $docId = $info[1];
            $counter = $info[0];
            $cons['_id'] = AppHelper::instance()->getAdminDocumentSequence($companyId, Salary_Master::raw(), 'salary_master', $docId);
            Salary_Master::raw()->updateOne(['company_id' => $companyId, '_id' => (int)$docId], ['$push' => ['salary_master' => $cons]]);
            $cons['masterID'] = $docId;
            echo json_encode($cons);

            return response()->json(['message' => 'Time Added successfully'], 201);
        } else {
            $parentId = AppHelper::instance()->getNextSequenceForNewDoc(\App\Models\API\Salary_Master::raw());
            $cons['_id'] = AppHelper::instance()->getNextSequenceForNewId(\App\Models\API\Salary_Master::raw(), 'salary_master', '$salary_master._id', $companyId);
            $arra = array(
                "_id" => $parentId,
                "counter" => (int)1,
                "company_id" => (int)$companyId,
                "salary_master" => array($cons),
            );
            \App\Models\API\Salary_Master::raw()->insertOne($arra);
            return response()->json(['message' => 'Comapny salary Added successfully'], 201);
        }
    }
    public function edit_salary_setup(Request $request)
    {

        $token = $request->bearerToken();
        $secretKey = '345fgvvc4';
        $decryptedInput = decrypt($token, $secretKey);
        list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
        $companyID = intval($id);
        $sid = intval($request->id);
        $masterId = (int)$request->masterId;
        $cursor = Salary_Master::raw()
        ->findOne(['company_id' => $companyID,'_id'=>$masterId,'salary_master._id' => $sid]);
        if ($cursor !== null && property_exists($cursor, 'salary_master')) {
        $salary_masterArray=$cursor->salary_master;
       // dd($salary_masterArray);
        $salaryLength=count($salary_masterArray);
        $i=0;
        $v=0;
        for($i=0; $i<$salaryLength; $i++)
        {
            $ids=$cursor->salary_master[$i]['_id'];
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
        // dd($cursor);
        $consignee=(array)$cursor->salary_master[$v];
            return response()->json([
                'success' => $consignee,
            ]);
        } else {
            return response()->json([
                'success' => 'No record'
            ]);
        }
    }
    
    public function update_salary_setup(Request $request)
    {
        $collection = \App\Models\API\Salary_Master::raw();
        $maxLength = 7000;
        $token = $request->bearerToken();
        $secretKey = '345fgvvc4';
        $decryptedInput = decrypt($token, $secretKey);
        list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
        $companyId = intval($id);
        $id = $request->id;
        $masterId = (int)$request->masterId;
        $docAvailable = AppHelper::instance()->checkDoc(\App\Models\API\Salary_Master::raw(),
        $companyId, $maxLength);
        $info = (explode("^", $docAvailable));
        $docId = $info[1];
        $docAvailable = AppHelper::instance()->checkDoc(Salary_Master::raw(), $companyId, $maxLength);
        // Assuming you have the following variables from your form submission
        $departmentId = $request->department_id;
        $ctc = $request->ctc;
        $typeId2 =$request->type_id_2;
        $data2 = $request->data_2;
        $typeId3 =$request->type_id_3;
        $data3 = $request->data_3;
        $typeId4 = $request->type_id_4;
        $data4 = $request->data_4;

        // Function to parse the data string into an array of associative arrays
     function parseDataString($dataString) {
        $dataArray = [];
    
        $cleanedString = str_replace(["name:", "deduct_type:"], ['"name":', '"deduct_type":'], $dataString);
        $cleanedString = str_replace([' ', ' ,'], ['', ','], $cleanedString);
    
        // Add square brackets to make it a JSON array
        $jsonString = '[' . $cleanedString . ']';
        $decodedData = json_decode($jsonString, true);
    
        if ($decodedData !== null) {
            // If decoding was successful, use the decoded data
            foreach ($decodedData as $data) {
                foreach($data as $d){
                $dataArray[] = [
                    'name' => $d['name'],
                    'deduct_type' => $d['deduct_type']
                ];
            }
            }
        } 
    
        return $dataArray;
    }

        // Create an array structure based on the provided data
        $resultArray = [
            'type_data' => [
                [
                    'type_id' => $typeId2,
                    'data' => parseDataString($data2)
                ],
                [
                    'type_id' => $typeId3,
                    'data' => parseDataString($data3)
                ],
                [
                    'type_id' => $typeId4,
                    'data' => parseDataString($data4)
                ]
            ]
        ];
        $userData = $collection->updateOne(
            ['company_id' => (int)$companyId, '_id' => (int)$masterId, 'salary_master._id' =>
             (int)$id],
            ['$set' => [
                'salary_master.$.department_id' => $request->department_id,
                'salary_master.$.ctc' => $request->ctc,
                'salary_master.$.type_id' => $resultArray,
                'salary_master.$.edit_time' => time()
            ]]
        );

        if ($userData == true) {
            $arr = array('status' => 'success', 'message' => 'Company Salary Master Updated Successfully.', 'statusCode' => 200);
            return json_encode($arr);
        } else {
            $arr = array('status' => 'success', 'message' => 'NO Company Salary Master Updated.', 'statusCode' => 500);
            return json_encode($arr);
        }
    }
    public function view_salary_setup(Request $request)
    {
        $token = $request->bearerToken();
        $secretKey = '345fgvvc4';
        $decryptedInput = decrypt($token, $secretKey);
        $token_data = list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
        $company_id = intval($id);
        $records = Salary_Master::where('salary_master.delete_status', 'NO')
            ->where('company_id', $company_id)
            ->get();
    //    dd($records);
            $data = json_decode($records, true);
        if ($data) {
            $filteredData = array_map(function ($item) {
                $filteredDepartments = array_filter($item['salary_master'], function ($time) {
                    return $time['delete_status'] === 'NO';
                });
                $filteredDepartments = array_intersect_key($item['salary_master'], $filteredDepartments);
                $item['salary_master'] = $filteredDepartments;

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

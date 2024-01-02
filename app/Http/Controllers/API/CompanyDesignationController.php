<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\API\Company_Admins;
use App\Models\API\Company_Designation;
use App\Helpers\AppHelper;
use App\Models\API\Company_Department;
use Illuminate\Http\Request;

class CompanyDesignationController extends Controller
{
    public function add_designation(Request $request) 
    {
        $maxLength = 7000;
        $token = $request->bearerToken();
        $secretKey = '345fgvvc4';
        $decryptedInput = decrypt($token, $secretKey);
        list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
        $companyId=intval($id);
        $docAvailable = AppHelper::instance()->checkDoc(Company_Designation::raw(),$companyId,$maxLength);
        $password = hash('sha1',$request->password);
        $cons = array(
            '_id' => 1,
            'company_id' => $companyId,
            'counter' => 0,
            'designation_name' => $request->designation_name,
            'department_id'=>$request->department_id,
            'delete_status' => "NO",
            'deleteUser' => "",
            'deleteTime' => "",
            'created_at' => "",
            'updated_at' => "",
         );
        if($docAvailable != "No")
         {
             $info = (explode("^",$docAvailable));
             $docId = $info[1];
             $counter = $info[0];
             $cons['_id'] = AppHelper::instance()->getAdminDocumentSequence($companyId, Company_Designation::raw(),'company_designation',$docId);
             Company_Designation::raw()->updateOne(['company_id' => $companyId,'_id'=>(int)$docId], ['$push' => ['company_designation' => $cons]]);
             $cons['masterID'] = $docId;
             echo json_encode($cons);
 
             return response()->json(['message' => 'Designation Added successfully'], 200);
         }
         else
         {
             $parentId =AppHelper::instance()->getNextSequenceForNewDoc(\App\Models\API\Company_Designation::raw());
             $cons['_id'] =AppHelper::instance()->getNextSequenceForNewId(\App\Models\API\Company_Designation::raw(),'company_designation','$company_designation._id',$companyId);
             $arra = array(
                 "_id" => $parentId,
                 "counter" => (int)1,
                 "company_id" => (int)$companyId,
                 "company_designation" => array($cons),
             );
             \App\Models\API\Company_Designation::raw()->insertOne($arra);
             return response()->json(['message' => 'Designation Added successfully'], 200);
         }
            
    }
    public function edit_designation(Request $request)
    {
        $token = $request->bearerToken();
        $secretKey = '345fgvvc4';
        $decryptedInput = decrypt($token, $secretKey);
        list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
        $companyID = intval($id);
        $sid = intval($request->id);
        $masterId = (int)$request->masterId;
        $cursor = Company_Designation::raw()
        ->findOne(['company_id' => $companyID,'_id'=>$masterId,'company_designation._id' => $sid]);
        if ($cursor !== null && property_exists($cursor, 'company_designation')) {
        $consigneeArray=$cursor->company_designation;
        $consigneeLength=count($consigneeArray);
        $i=0;
        $v=0;
        for($i=0; $i<$consigneeLength; $i++)
        {
            $ids=$cursor->company_designation[$i]['_id'];
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
        $consignee=(array)$cursor->company_designation[$v];
            return response()->json([
                'success' => $consignee,
            ]);
        } else {
            return response()->json([
                'success' => 'No record'
            ]);
        }
    }
    public function update_designation(Request $request) 
    {
        $collection=\App\Models\API\Company_Designation::raw();
        $token = $request->bearerToken();
        $secretKey ='345fgvvc4';
        $decryptedInput = decrypt($token, $secretKey);
        $token_data=list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
        $companyId=intval($id);
        $id=$request->id;
        $masterId=(int)$request->masterId;
        $maxLength=6500;
        $docAvailable = AppHelper::instance()->checkDoc(\App\Models\API\Company_Designation::raw(),$companyId,$maxLength);
        $info = (explode("^",$docAvailable));
        $docId = $info[1];
        $desgData=$collection->updateOne(['company_id' => (int)$companyId,'_id' => (int)$masterId,'company_designation._id' => (int)$id],
       ['$set' => [
            'company_designation.$.designation_name' => $request->designation_name,
            'company_designation.$.department_id' => $request->department_id,
            'company_designation.$.edit_time' => time()
            ]]
        );
        // dd($desgData);
    //    if ($desgData==true)
    //     {
    //         $arr = array('status' => 'success', 'message' => 'Designation Updated successfully.','statusCode' => 200);
    //         return json_encode($arr);
    //     }
        if($desgData==true) {
            return response()->json(['message' => 'Designation Updated successfully'], 200);
        } else {
            return response()->json(['status' => false,'message' => 'Designation Not Update'], 200);
        }
    }
     public function delete_designation(Request $request) 
    {
        $token = $request->bearerToken();
        $secretKey ='345fgvvc4';
        $decryptedInput = decrypt($token, $secretKey);
        list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
        $companyID=intval($id);
        $ids=(int)$request->id;
        $masterId=(int)$request->masterId;
        $designData=Company_Designation::raw()->updateOne(['company_id' => $companyID,'_id' => $masterId,'company_designation._id' => $ids],
        ['$set' => ['company_designation.$.delete_status' =>'YES','company_designation.$.deleteUser' =>$companyID,'company_designation.$.deleteTime' => time()]]
        );
    //    if ($designData==true)
    //    {
    //        $arr = array('status' => 'success', 'message' => 'Designation deleted successfully.','statusCode' => 200);
    //         return json_encode($arr);
    //    }
        if($designData==true) {
            return response()->json(['message' => 'Designation deleted successfully'], 200);
        } else {
            return response()->json(['status' => false,'message' => 'Designation Not Deleted'], 200);
        }
    }
    public function view_designation(Request $request)// done
    {
        $token = $request->bearerToken();
        $secretKey ='345fgvvc4';
        $decryptedInput = decrypt($token, $secretKey);
        $token_data=list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
        $company_id=intval($id);
       $records=Company_Designation::where('company_designation.delete_status','NO')
       ->where('company_id',$company_id)->get();
//relation
      // $records = Company_Designation::with('department')->get();
      // dd($records);
       $data = json_decode($records, true);
       if ($data) {
        $filteredData = array_map(function ($item)
        {
            $filteredDepartments = array_filter($item['company_designation'], function ($design) {
                return $design['delete_status'] === 'NO';
            });
            $filteredDepartments = array_intersect_key($item['company_designation'], $filteredDepartments);
            $item['company_designation'] = $filteredDepartments;
    
            return $item;
        }, $data);
        return response()->json(['success' => true,'data' => $filteredData], 200);
    }
     
      else {
        // Handle the case where no records are found
        return response()->json(['success' => false, 'message' => 'No records found'], 200);
    }
    }
    public function paginate_designation(Request $request)
    {
        $token = $request->bearerToken();
        $secretKey ='345fgvvc4';
        $decryptedInput = decrypt($token, $secretKey);
        $token_data=list($id, $user, $admin_name, $companyname) =
         explode('|', $decryptedInput);
        $company_id=intval($id);
        $records=Company_Designation::where('company_designation.delete_status','NO')
        ->where('company_id',$company_id)->paginate(10);
        if($records->isEmpty()) {
            return response()->json(['message' => 'No results found'], 200);
        } else {
            return response()->json(['success' => true,'data' => $records], 200);
        }
       
    }
    public function search_designation(Request $request) //search
    {
        $name=$request->designation_name;
        $results=Company_Designation::where('company_designation.designation_name','like','%'.$name.'%')->get();
        if($results->isEmpty()) {
            return response()->json(['message' => 'No results found'], 200);
        } else {
            
            return response()->json(['results' => $results], 200);
        }
    }
}
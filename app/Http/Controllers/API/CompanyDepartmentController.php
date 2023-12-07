<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\API\Company_Admins;
use App\Models\API\Company_Department;
use App\Helpers\AppHelper;
use Illuminate\Http\Request;

class CompanyDepartmentController extends Controller
{
    public function add_department(Request $request) //done
    {
        $maxLength = 7000;
        $token = $request->bearerToken();
        $secretKey = '345fgvvc4';
        $decryptedInput = decrypt($token, $secretKey);
         list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
         $companyId=intval($id);
         $docAvailable = AppHelper::instance()->checkDoc(Company_Department::raw(),$companyId,$maxLength);
         $password = hash('sha1',$request->password);
         $cons = array(
                    '_id' => 1,
                    'company_id' => $companyId,
                    'counter' => 0,
                    'department_name' => $request->department_name,
                    'delete_status' => "NO",
                    'created_at' => '',
                    'updated_at' => '',
         );
        if($docAvailable != "No")
         {
             $info = (explode("^",$docAvailable));
             $docId = $info[1];
             $counter = $info[0];
             $cons['_id'] = AppHelper::instance()->getAdminDocumentSequence($companyId, Company_Department::raw(),'company_department',$docId);
             Company_Department::raw()->updateOne(['company_id' => $companyId,'_id'=>(int)$docId], ['$push' => ['company_department' => $cons]]);
             $cons['masterID'] = $docId;
             echo json_encode($cons);
 
             return response()->json(['message' => 'Department Added successfully'], 201);
         }
         else
         {
             $parentId =AppHelper::instance()->getNextSequenceForNewDoc(\App\Models\API\Company_Department::raw());
             $cons['_id'] =AppHelper::instance()->getNextSequenceForNewId(\App\Models\API\Company_Department::raw(),'company_department','$company_department._id',$companyId);
             $arra = array(
                 "_id" => $parentId,
                 "counter" => (int)1,
                 "company_id" => (int)$companyId,
                 "company_department" => array($cons),
             );
             \App\Models\API\Company_Department::raw()->insertOne($arra);
             return response()->json(['message' => 'Department Added successfully'], 201);
         }
            
    }

    public function edit_department(Request $request)//done
   {
     // $parent=$request->masterId;
     $token = $request->bearerToken();
     $secretKey ='345fgvvc4';
     $decryptedInput = decrypt($token, $secretKey);
     list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
     $companyID=intval($id);
     $id=$request->id;
     $collection=\App\Models\API\Company_Department::raw();

     $show1 = $collection->aggregate([
         ['$match' => ['_id' => (int)$id, 'company_id' =>$companyID]]
         // ['$unwind' => ['path' => '$company_user']]
     ]);
     foreach ($show1 as $row) {
         $company=array();
         $paymentTerms=array();
         $user=array();
         $factoringCompany=array();
         if(isset($row)){
             $companyNameID=$row;
             $companyName =\App\Models\API\Company_Department::raw()->aggregate([
                 ['$match' => ["company_id" => (int)$companyID]],
                 //['$unwind' => '$company'],
                 ['$match' => ["_id" => (int)$id]],
                 // ['$project' => ['company._id' => 1,'company.companyName' => 1]]
             ]);
             foreach($companyName as $name){
                 $l=0;
                 $company[$l] = $name;
                 $l++;
             }
         }
         $mainIdac = $row['_id'];
         $activeCustomer = array();
         $k = 0;
         $activeCustomer[$k] = $row;
         $k++;
     }
     
     $customerData[]=array("Customer" => $activeCustomer);
     if($activeCustomer != ''){
         return response()->json([
             'success' => $customerData,
         ]);
     }
     else{
         return response()->json([
             'success' => 'No record'
         ]);
     }

   }
    public function update_department(Request $request) //done
    {

        $collection=\App\Models\API\Company_Department::raw();
        $token = $request->bearerToken();
        $secretKey ='345fgvvc4';
        $decryptedInput = decrypt($token, $secretKey);
        $token_data=list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
        $companyId=intval($id);
        $id=$request->id;
        // $masterId=(int)$request->masterId;
        $maxLength=6500;
        $docAvailable = AppHelper::instance()->checkDoc(\App\Models\API\Company_Department::raw(),$companyId,$maxLength);
        $info = (explode("^",$docAvailable));
        $docId = $info[1];
        $userData=$collection->updateOne(['company_id' => (int)$companyId,'_id' => (int)$id,'company_department._id' => (int)$id],
        ['$set' => [
            'company_department.$.department_name' => $request->department_name,
            'company_department.$.edit_time' => time()
            ]]
        );
        if ($userData==true)
        {
            $arr = array('status' => 'success', 'message' => 'Department Updated successfully.','statusCode' => 200);
            return json_encode($arr);
        }
    }
    public function delete_department(Request $request) //done
    {
        $token = $request->bearerToken();
        $secretKey ='345fgvvc4';
        $decryptedInput = decrypt($token, $secretKey);
        list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
        $ids=(int)$request->id;
        $masterId=(int)$request->masterId;
        // $masterId=(int)$request->parentId;
        $companyID=intval($id);
        $departData=Company_Department::raw()->updateOne(['company_id' => $companyID,'_id' => $masterId,'company_department._id' => $ids],
        ['$set' => ['company_department.$.delete_status' => 'YES','company_department.$.deleteUser' =>$companyID,'company_department.$.deleteTime' => time()]]
        );
       if ($departData==true)
       {
           $arr = array('status' => 'success', 'message' => 'Department deleted successfully.','statusCode' => 200);
            return json_encode($arr);
       }
    }
    
    public function view_department(Request $request)// done
    {
        $token = $request->bearerToken();
        $secretKey ='345fgvvc4';
        $decryptedInput = decrypt($token, $secretKey);
        $token_data=list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
        $company_id=intval($id);
        $records=Company_Department::where('company_department.delete_status','NO')->where('company_id',$company_id)->get();
        // dd($records);
        return response()->json(['success' => true,'data' => $records], 200);
    }
    public function paginate_department(Request $request)
    {
        $token = $request->bearerToken();
        $secretKey ='345fgvvc4';
        $decryptedInput = decrypt($token, $secretKey);
        $token_data=list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
        $company_id=intval($id);
        $records=Company_Department::where('company_department.delete_status','NO')->where('company_id',$company_id)->paginate(10);
        return response()->json(['success' => true,'data' => $records], 200);
    }
    public function search_department(Request $request) //search
    {
        $name=$request->department_name;
        $results=Company_Department::where('company_department.department_name','like','%'.$name.'%')->get();
        if($results->isEmpty()) {
            return response()->json(['message' => 'No results found'], 404);
        } else {
            return response()->json(['results' => $results], 200);
        }
    }
}
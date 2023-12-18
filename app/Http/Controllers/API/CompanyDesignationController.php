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
 
             return response()->json(['message' => 'Designation Added successfully'], 201);
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
             return response()->json(['message' => 'Designation Added successfully'], 201);
         }
            
    }
    public function edit_designation(Request $request)
    {
      // $parent=$request->masterId;
      $token = $request->bearerToken();
      $secretKey ='345fgvvc4';
      $decryptedInput = decrypt($token, $secretKey);
      list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
      $companyID=intval($id);
      $id=$request->id;
      $collection=\App\Models\API\Company_Designation::raw();
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
              $companyName =\App\Models\API\Company_Designation::raw()->aggregate([
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
       if ($desgData==true)
        {
            $arr = array('status' => 'success', 'message' => 'Designation Updated successfully.','statusCode' => 200);
            return json_encode($arr);
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
       if ($designData==true)
       {
           $arr = array('status' => 'success', 'message' => 'Designation deleted successfully.','statusCode' => 200);
            return json_encode($arr);
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
    }
      return response()->json(['success' => true,'data' => $filteredData], 200);
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
        return response()->json(['success' => true,'data' => $records], 200);
    }
    public function search_designation(Request $request) //search
    {
        $name=$request->designation_name;
        $results=Company_Designation::where('company_designation.designation_name','like','%'.$name.'%')->get();
        if($results->isEmpty()) {
            return response()->json(['message' => 'No results found'], 404);
        } else {
            
            return response()->json(['results' => $results], 200);
        }
    }



}
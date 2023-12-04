<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\API\Company_admin;
use App\Models\API\Company_Admins;
use App\Models\API\Company_user;
use App\Helpers\AppHelper;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AddUserController extends Controller
{
        public function add_user(Request $request) //done
        {
        $maxLength = 7000;
        $token = $request->bearerToken();
        $secretKey ='345fgvvc4';
        $decryptedInput = decrypt($token, $secretKey);
        list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
        $companyId=intval($id);
        $docAvailable = AppHelper::instance()->checkDoc(Company_user::raw(),$companyId,$maxLength);
        $password = hash('sha1',$request->password);
        $cons = array(
            '_id' =>1,
            'company_id' => $companyId,
            'counter' => 0,
            'user_email' => $request->user_email,
            'user_name' => $request->user_name,
            'user_password' =>$password,
            'user_type' => $request->user_type,
            'user_add_date' => $request->user_add_date,
            'otpexperience' => '',
            'last_change_password' => '',
            'last_login' => '',
            'entry_time' => '',
            'user_status' => '',
            'shift_id' => '',
            'employee' => '',
            'payroll' => '',
            'attendance' => '',
            'break' => '',
            'leave' => '',
            'letter' => '',
            'administration' => '',
            'recruitment' => '',
            'ip' => '',
            'browser' => '',
            'city' => '',
            'state' => '',
            'os' => '',
            'insertedTime' => time(),
            // 'insertedUserId' => Auth::user()->userFirstName.' '.Auth::user()->userLastName,
            'delete_status' => "NO",
            'deleteUser' => "",
            'deleteTime' => "",
        );
        if($docAvailable != "No")
        {
            $info = (explode("^",$docAvailable));
            $docId = $info[1];
            $counter = $info[0];
            $cons['_id'] = AppHelper::instance()->getAdminDocumentSequence($companyId, Company_user::raw(),'company_user',$docId);
            Company_user::raw()->updateOne(['company_id' => $companyId,'_id'=>(int)$docId], ['$push' => ['company_user' => $cons]]);
            $cons['masterID'] = $docId;
            echo json_encode($cons);

            return response()->json(['message' => 'User Added successfully'], 201);
        }
        else
        {
            $parentId =AppHelper::instance()->getNextSequenceForNewDoc(\App\Models\API\Company_user::raw());
            $cons['_id'] =AppHelper::instance()->getNextSequenceForNewId(\App\Models\API\Company_user::raw(),'company_user','$company_user._id',$companyId);
            $arra = array(
                "_id" => $parentId,
                "counter" => (int)1,
                "company_id" => (int)$companyId,
                "company_user" => array($cons),
            );
            \App\Models\API\Company_user::raw()->insertOne($arra);
            return response()->json(['message' => 'User Added successfully'], 201);
        }
    }

    public function edit_companyuser(Request $request)
    {
        // dd($request);
        // $parent=$request->masterId;
        $token = $request->bearerToken();
        $secretKey ='345fgvvc4';
        $decryptedInput = decrypt($token, $secretKey);
        list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
        $companyID=intval($id);
        $id=$request->id;
        // dd($request->_id);
        $collection=\App\Models\API\Company_user::raw();

        $show1 = $collection->aggregate([
            ['$match' => ['_id' => (int)$id, 'company_id' =>$companyID]]
            // ['$unwind' => ['path' => '$company_user']]
        ]);
        // dd($show1);
        foreach ($show1 as $row) {
            $company=array();
            $paymentTerms=array();
            $user=array();
            $factoringCompany=array();
            if(isset($row)){
                $companyNameID=$row;
                $companyName =\App\Models\API\Company_user::raw()->aggregate([
                    ['$match' => ["company_id" => (int)$companyID]],
                    //['$unwind' => '$company'],
                    ['$match' => ["_id" => (int)$id]],
                    // ['$project' => ['company._id' => 1,'company.companyName' => 1]]
                ]);
                foreach($companyName as $name){
                    $l=0;
                    // dd($name);
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
        public function update_user(Request $request) //done
        {
            $collection=\App\Models\API\Company_user::raw();
            $token = $request->bearerToken();
            $secretKey ='345fgvvc4';
            $decryptedInput = decrypt($token, $secretKey);
            $token_data=list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
            $companyId=intval($id);
            $id=$request->id;
            // dd($id);

            // $masterId=(int)$request->masterId;
            $maxLength=6500;
    
            $docAvailable = AppHelper::instance()->checkDoc(\App\Models\API\Company_user::raw(),$companyId,$maxLength);
            $info = (explode("^",$docAvailable));
            $docId = $info[1];
    
            $userData=$collection->updateOne(['company_id' => (int)$companyId,'_id' => (int)$id,'company_user._id' => (int)$id],
            ['$set' => [
                'company_user.$.user_email' => $request->user_email,
                'company_user.$.user_name' => $request->user_name,
                'company_user.$.user_type' => $request->user_type,
                'company_user.$.user_add_date' => $request->user_add_date,
                'company_user.$.edit_time' => time()
                ]]
            );
    
    
            if ($userData==true)
            {
                $arr = array('status' => 'success', 'message' => 'User Updated successfully.','statusCode' => 200);
                return json_encode($arr);
            }

          
           
        }
        public function delete_user(Request $request) //done
        {
            $token = $request->bearerToken();
            $secretKey ='345fgvvc4';
            $decryptedInput = decrypt($token, $secretKey);
            list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
            $id=(int)$request->id;
            $masterId=(int)$request->masterId;
            $companyID=intval($id);
            $userData=Company_user::raw()->updateOne(['company_id' => $companyID,'_id' => $masterId,'company_user._id' => $id],
            ['$set' => ['company_user.$.delete_status' => 'YES','company_user.$.deleteUser' =>intval($id),'company_user.$.deleteTime' => time()]]
            );
           if ($userData==true)
           {
               $arr = array('status' => 'success', 'message' => 'User deleted successfully.','statusCode' => 200);
                return json_encode($arr);
           }
         }
            
    public function view_companyuser(Request $request)
    {
        $token = $request->bearerToken();
        $secretKey ='345fgvvc4';
        $decryptedInput = decrypt($token, $secretKey);
        $token_data=list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
        $companyID=intval($id);
        $total_records = 0;
        $cursor = Company_user::raw()->aggregate([
            ['$match' => ['company_id' => (int)$companyID]],
            ['$project' => ['size' => ['$size' => ['$company_user']],
            ]]
        ]);

        $totalarray = $cursor;

        $docarray = array();
        foreach ($cursor as $v)
        {

            $docarray[] = array("size" => $v['size'], "id" => $v['_id']);
            $total_records += (int)$v['size'];
        }

        $completedata = array();
        $partialdata = array();
        $paginate = AppHelper::instance()->paginate($docarray);
        if (!empty($paginate[0][0][0]))
        {
            for ($i = 0; $i < sizeof($paginate[0][0][0]); $i++)
            {
                $pagina_data= str_replace( array('"',":"," " ,"doc",'start',"end", ']','[','{','}' ), ' ', $request->arr);
                $pagina_data=explode(",",$pagina_data);
                if(!empty($request->arr))
                {
                    $docid=preg_replace('/\s+/',"", $pagina_data[0]);
                    $start=preg_replace('/\s+/',"",$pagina_data[1]);
                    $end=preg_replace('/\s+/',"",$pagina_data[2]);
                    $docid=intval($docid);
                    $start=intval($start);
                    $end=intval($end);
                }
                else
                {
                    $docid= $paginate[0][0][0][$i]['doc'];
                    $end=$paginate[0][0][0][$i]['end'];
                    $start=$paginate[0][0][0][$i]['start'];
                }
                $show1 = Company_user::raw()->aggregate([
                    ['$match' => ["company_id" => $companyID, "_id" => $docid]],
                    // ['$unwind' => ['path' => '$company_user']],
                    ['$project' => ["company_id" => $companyID, "company_user" => ['$slice' => ['$company_user', $end, $start - $end]]]],
                    // ['$match' => ['company_user.userId' => (int)Auth::user()->_id]],
                    ['$project' => ["company_user.userId" => 1,"company_user._id" => 1,"company_user.counter" => 1, "company_user.custName" => 1, "company_user.custLocation" => 1, "company_user.custLocationCity" => 1, "company_user.custLocationState" => 1, "company_user.custZip" => 1, "company_user.primaryContact" => 1,
                        "company_user.custTelephone" => 1, "company_user.custEmail" => 1,"company_user.factoringCompany" => 1,"company_user.currencySetting" => 1,"company_user.paymentTerms" => 1,"company_user.insertedTime" => 1,"company_user.insertedUserId" => 1,
                        "company_user.edit_by" => 1,"company_user.edit_time" => 1,"company_user.deleteStatus" => 1,"company_user.deleteUser" => 1,"company_user.deleteTime" => 1]]
                ]);
                
                
                $c = 0;
                $arrData1 = "";
                $userid=intval($id);
                foreach ($show1 as $arrData11)
                {  
                        $arrData1 = $arrData11;
                }
               $arrData2 = array(
                    'arrData1' => $arrData1,
                );
                $partialdata[]= $arrData2;
            }
        }
      
        $completedata[] = $partialdata;
        $completedata[] = $paginate;
        $completedata[] = $total_records;
        echo json_encode($completedata);
    }

        public function searchuser($name) //search
        {
            $results=Company_user::where('user_name','like','%'.$name.'%')->get();
            // dd($results);
             if($results->isEmpty()) {
                return response()->json(['message' => 'No results found'], 404);
            } else {
                
                return response()->json(['results' => $results], 200);
            }
        }
            
}
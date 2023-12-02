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
        // dd($docAvailable);
        if($docAvailable != "No")
        {

            $info = (explode("^",$docAvailable));
            $docId = $info[1];
            $counter = $info[0];

            $cons['_id'] = AppHelper::instance()->getAdminDocumentSequence($companyId, Company_user::raw(),'company_user',$docId);
            //dd($cons['_id']);

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
        // $parent=$request->masterId;
        $token = $request->bearerToken();
        $secretKey ='345fgvvc4';
        $decryptedInput = decrypt($token, $secretKey);
        list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
        $companyID=intval($id);
        $id=$request->id;
        $collection=\App\Models\API\Company_user::raw();

        $show1 = $collection->aggregate([
            ['$match' => ['_id' => (int)$id, 'company_id' =>$companyID]]
            // ['$unwind' => ['path' => '$customer']]
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
            $token_data=list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);

            $id=(int)$request->id;
            $masterId=(int)$request->masterId;
            $companyID=intval($id);
            $userData=Company_user::raw()->updateOne(['company_id' => $companyID,'_id' => $masterId,'company_user._id' => $id],
            ['$set' => ['company_user.$.delete_status' => 'YES','company_user.$.deleteUser' =>intval($id),'company_user.$.deleteTime' => time()]]
            );
            // dd($userData);
           if ($userData==true)
           {
               $arr = array('status' => 'success', 'message' => 'User deleted successfully.','statusCode' => 200);
                return json_encode($arr);
           }

            // $token = $request->bearerToken();
            // //$token= $token_data->token;
            // $secretKey ='345fgvvc4';
            // $decryptedInput = decrypt($token, $secretKey);
            // $token_data=list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
            
            // $company_id=$token_data['0'];
            // $new_id=intval($id);
            // $data = Company_user::where('_id',$new_id)->first();
            // $data->delete_status ='0';
            // $data->save();
            // return response()->json(['status' => 'Deleted Successfully']);
        }
        public function index_user(Request $request)
        {
            $token = $request->bearerToken();
            //$token= $token_data->token;
            $secretKey ='345fgvvc4';
            $decryptedInput = decrypt($token, $secretKey);
            $token_data=list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
            $company_id=$token_data['0'];
            $company_id=intval($id);
            // $records=Company_user::where('delete_status', 1)->get();
            $records=Company_user::where('delete_status',1)->paginate();
            //dd($rec);
            // $records = Company_user::where('company_id',$company_id)->where('delete_status', 1)->get();
            return response()->json(['success' => true,'data' => $records], 200);
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
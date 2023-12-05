<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\API\Company_Admins;
use App\Models\API\Company_Holiday;
use Illuminate\Support\Facades\Hash;
use App\Helpers\AppHelper;

class CompanyHolidayController extends Controller
{
    public function add_holiday(Request $request) //done
    { 
        $maxLength = 7000;
        $token = $request->bearerToken();
        //$token= $token_data->token;
        $secretKey = '345fgvvc4';
        $decryptedInput = decrypt($token, $secretKey);
         list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
         $companyId=intval($id);
         $docAvailable = AppHelper::instance()->checkDoc(Company_Holiday::raw(),$companyId,$maxLength);
         $password = hash('sha1',$request->password);
         $cons = array(
            '_id' => 1,
            'company_id' => $companyId,
            'counter' => 0,
            'holiday_name' => $request->holiday_name,
                    'holiday_date' => $request->holiday_date,
                    'holiday_description' => $request->holiday_description,
                    'delete_status' => "NO",
                    'created_at' => '',
                    'updated_at' => '',
         );
         if($docAvailable != "No")
         {
             $info = (explode("^",$docAvailable));
             $docId = $info[1];
             $counter = $info[0];
        //    dd('fault');
             $cons['_id'] = AppHelper::instance()->getAdminDocumentSequence($companyId, Company_Holiday::raw(),'company_holiday',$docId);
             Company_Holiday::raw()->updateOne(['company_id' => $companyId,'_id'=>(int)$docId], ['$push' => ['company_holiday' => $cons]]);
             $cons['masterID'] = $docId;
             echo json_encode($cons);
 
             return response()->json(['message' => 'Holiday Added successfully'], 201);
         }
         else
         {
             $parentId =AppHelper::instance()->getNextSequenceForNewDoc(\App\Models\API\Company_Holiday::raw());
             $cons['_id'] =AppHelper::instance()->getNextSequenceForNewId(\App\Models\API\Company_Holiday::raw(),'company_holiday','$company_holiday._id',$companyId);
             $arra = array(
                 "_id" => $parentId,
                 "counter" => (int)1,
                 "company_id" => (int)$companyId,
                 "company_holiday" => array($cons),
             );
             \App\Models\API\Company_Holiday::raw()->insertOne($arra);
             return response()->json(['message' => 'Holiday Added successfully'], 201);
         }
            
    }

    public function edit_holiday(Request $request)//done
    {
        $token = $request->bearerToken();
        $secretKey ='345fgvvc4';
        $decryptedInput = decrypt($token, $secretKey);
        list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
        $companyID=intval($id);
        $id=$request->id;
       //  dd($id);
        $collection=\App\Models\API\Company_Holiday::raw();
   
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
                $companyName =\App\Models\API\Company_Holiday::raw()->aggregate([
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
    public function update_holiday(Request $request) //done
    {

        $collection=\App\Models\API\Company_Holiday::raw();
        $token = $request->bearerToken();
        $secretKey ='345fgvvc4';
        $decryptedInput = decrypt($token, $secretKey);
        $token_data=list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
        $companyId=intval($id);
        $id=$request->id;
        // dd($id);

        // $masterId=(int)$request->masterId;
        $maxLength=6500;

        $docAvailable = AppHelper::instance()->checkDoc(\App\Models\API\Company_Holiday::raw(),$companyId,$maxLength);
        $info = (explode("^",$docAvailable));
        $docId = $info[1];

        $userData=$collection->updateOne(['company_id' => (int)$companyId,'_id' => (int)$id,'company_holiday._id' => (int)$id],
        ['$set' => [
            'company_holiday.$.holiday_name' => $request->holiday_name,
            'company_holiday.$.holiday_date' => $request->holiday_date,
            'company_holiday.$.holiday_description' => $request->holiday_description,
            'company_holiday.$.edit_time' => time()
            ]]
        );


        if ($userData==true)
        {
            $arr = array('status' => 'success', 'message' => 'Holiday Updated successfully.','statusCode' => 200);
            return json_encode($arr);
        }
    }
    public function delete_holiday(Request $request) //done
    {
        $token = $request->bearerToken();
        $secretKey ='345fgvvc4';
        $decryptedInput = decrypt($token, $secretKey);
        list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
        $id=(int)$request->id;
        $masterId=(int)$request->masterId;
        $companyID=intval($id);
        $departData=Company_Holiday::raw()->updateOne(['company_id' => $companyID,'_id' => $masterId,'company_holiday._id' => $id],
        ['$set' => ['company_holiday.$.delete_status' => 'YES','company_holiday.$.deleteUser' =>intval($id),'company_holiday.$.deleteTime' => time()]]
        );
       if ($departData==true)
       {
           $arr = array('status' => 'success', 'message' => 'Holiday deleted successfully.','statusCode' => 200);
            return json_encode($arr);
       }
    }

    public function index_holiday(Request $request)//not done
    {
        $token = $request->bearerToken();
        //$token= $token_data->token;
        $secretKey = '345fgvvc4';
        $decryptedInput = decrypt($token, $secretKey);
        $token_data = list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
        $company_id = $token_data['0'];
        $company_id = intval($id);
        $records = Company_Holiday::where('delete_status', 1)->get();
        // $records=Holiday::where("delete_status","1")->paginate(1);
        return response()->json(['success' => true, 'data' => $records], 200);
    }

    public function searchholiday(Request $request) //not done search
    {
        $query = $request->input('query');

        // Perform a basic search query on the MongoDB collection
        $results = Company_Holiday::where('field_to_search', 'like', "%$query%")->get();

        return response()->json($results);
        // $results = Company_Holiday::where('holiday_name', 'like', '%' . $name . '%')->get();
        // // dd($results);
        // if ($results->isEmpty()) {
        //     return response()->json(['message' => 'No results found'], 404);
        // } else {

        //     return response()->json(['results' => $results], 200);
        // }
    }

}



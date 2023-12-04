<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\API\Company_Previligies;
use App\Helpers\AppHelper;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use MongoDB\BSON\Regex;
use File;
use Image;
use MongoDB\BSON\ObjectId;

class CompanyPreviligiesController extends Controller
{
    public function add_previligies(Request $request) //done
        {
        $maxLength = 7000;
        $token = $request->bearerToken();
        $secretKey ='345fgvvc4';
        $decryptedInput = decrypt($token, $secretKey);
        list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
        $companyId=intval($id);
        $docAvailable = AppHelper::instance()->checkDoc(Company_Previligies::raw(),$companyId,$maxLength);
        $password = hash('sha1',$request->password);
        $cons = array(
            '_id' =>1,
            'company_id' => $companyId,
            'counter' => 0,
            'user' => 0,
            'previligies_name' => $request->previligies_name,
            'delete_status' => "NO",
            'deleteUser' => "",
            'deleteTime' => "",
            'created_at' => now(),
            'updated_at' => now(),

        );
        if($docAvailable != "No")
        {
            $info = (explode("^",$docAvailable));
            $docId = $info[1];
            $counter = $info[0];
            $cons['_id'] = AppHelper::instance()->getAdminDocumentSequence($companyId, Company_Previligies::raw(),'previligies',$docId);
            Company_Previligies::raw()->updateOne(['company_id' => $companyId,'_id'=>(int)$docId], ['$push' => ['previligies' => $cons]]);
            $cons['masterID'] = $docId;
            echo json_encode($cons);
            return response()->json(['message' => 'Preveligies Added successfully'], 201);
        }
        else
        {
            $parentId =AppHelper::instance()->getNextSequenceForNewDoc(\App\Models\API\Company_Previligies::raw());
            $cons['_id'] =AppHelper::instance()->getNextSequenceForNewId(\App\Models\API\Company_Previligies::raw(),'previligies','$previligies._id',$companyId);
            $arra = array(
                "_id" => $parentId,
                "counter" => (int)1,
                "company_id" => (int)$companyId,
                "previligies" => array($cons),
            );
            \App\Models\API\Company_Previligies::raw()->insertOne($arra);
            return response()->json(['message' => 'Preveligies Added successfully'], 201);
        }
    }

    public function edit_previligies(Request $request)
    {
        $maxLength = 7000;
        $token = $request->bearerToken();
        $secretKey ='345fgvvc4';
        $decryptedInput = decrypt($token, $secretKey);
        list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
        $companyID=intval($id);
        $parent=$request->masterId;
        $ids=$request->id;
        $collection=\App\Models\API\Company_Previligies::raw();

        $show1 = $collection->aggregate([
            ['$match' => ['_id' => (int)$parent, 'company_id' => (int)$companyID]],
            ['$match' => ['previligies._id' => (int)$ids,'previligies.delete_status' => 'NO']]
        ]);
       
        foreach ($show1 as $row) {
            $ann=array();

            if(isset($row)){
                $companyNameID=$row;
                $previligiesName =\App\Models\API\Company_Previligies::raw()->aggregate([
                    ['$match' => ['_id' => (int)$parent, 'company_id' => (int)$companyID]],
                    ['$match' => ['previligies._id' => (int)$ids,'previligies.delete_status' => 'NO']]
                ]);
                foreach($previligiesName as $name){
                    $l=0;
                    $ann[$l] = $name;
                    $l++;
                }
            }
            $mainIdac = $row['_id'];
            $activeCustomer = array();
            $k = 0;
            $activeCustomer[$k] = $row['previligies'];
            $k++;

        }

        $customerData[]=array("previligies" => $activeCustomer);
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

        public function update_previligies(Request $request)
        {
            $maxLength = 7000;
            $token = $request->bearerToken();
            $secretKey ='345fgvvc4';
            $decryptedInput = decrypt($token, $secretKey);
            list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
            $companyId=intval($id);
            $collection=\App\Models\API\Company_Previligies::raw();
            $id=$request->id;
            $masterId=(int)$request->masterId;
            $maxLength=6500;
            $docAvailable = AppHelper::instance()->checkDoc(\App\Models\API\Company_Previligies::raw(),$companyId,$maxLength);
            $info = (explode("^",$docAvailable));
            $docId = $info[1];
    
            $customerData=$collection->updateOne(['company_id' => (int)$companyId,'_id' => (int)$docId,'previligies._id' => (int)$id],
            ['$set' => [
                'previligies.$.previligies_name' => $request->previligies_name,
                // 'previligies.$.edit_by' => $companyId,
                'previligies.$.edit_time' => time()
                ]]
            );
    
            if ($customerData==true)
            {
                $arr = array('status' => 'success', 'message' => 'Previligies Updated successfully.','statusCode' => 200);
                return json_encode($arr);
            }
        }
       
        public function delete_previligies(Request $request)
        {
            $token = $request->bearerToken();
            $secretKey ='345fgvvc4';
            $decryptedInput = decrypt($token, $secretKey);
            list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
            $companyID=intval($id);
            $id=(int)$request->id;
            $masterId=(int)$request->masterId;
            $previligiesData=Company_Previligies::raw()->updateOne(['company_id' => $companyID,'_id' => $masterId,'previligies._id' => $id],
            ['$set' => ['previligies.$.delete_status' => 'YES','previligies.$.deleteUser' =>intval($id),'previligies.$.deleteTime' => time()]]
            );
           if ($previligiesData==true)
           {
               $arr = array('status' => 'success', 'message' => 'Previligies deleted successfully.','statusCode' => 200);
                return json_encode($arr);
           }
        }
        public function index_previligies(Request $request)
        {
            $token = $request->bearerToken();
            $secretKey ='345fgvvc4';
            $decryptedInput = decrypt($token, $secretKey);
            $token_data=list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
            $companyID=intval($id);
            $total_records = 0;
            $cursor = Company_Previligies::raw()->aggregate([
                ['$match' => ['company_id' => (int)$companyID]],
                ['$project' => ['size' => ['$size' => ['$previligies']],
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
                    $show1 = Company_Previligies::raw()->aggregate([
                        ['$match' => ["company_id" => $companyID, "_id" => $docid]],
                        // ['$unwind' => ['path' => '$previligies']],
                        ['$project' => ["company_id" => $companyID, "previligies" => ['$slice' => ['$previligies', $end, $start - $end]]]],
                        // ['$match' => ['company_user.userId' => (int)Auth::user()->_id]],
                        // ['$project' => ["company_user.userId" => 1,"company_user._id" => 1,"company_user.counter" => 1, "company_user.custName" => 1, "company_user.custLocation" => 1, "company_user.custLocationCity" => 1, "company_user.custLocationState" => 1, "company_user.custZip" => 1, "company_user.primaryContact" => 1,
                        //     "company_user.custTelephone" => 1, "company_user.custEmail" => 1,"company_user.factoringCompany" => 1,"company_user.currencySetting" => 1,"company_user.paymentTerms" => 1,"company_user.insertedTime" => 1,"company_user.insertedUserId" => 1,
                        //     "company_user.edit_by" => 1,"company_user.edit_time" => 1,"company_user.deleteStatus" => 1,"company_user.deleteUser" => 1,"company_user.deleteTime" => 1]]
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
        
        public function search_previligies(Request $request)
        {
            $token = $request->bearerToken();
            $secretKey ='345fgvvc4';
            $decryptedInput = decrypt($token, $secretKey);
            $token_data=list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
            $companyID = intval($id);
            $search_by = $request->customer_fields;
            $search_value = $request->getoption;
            $datasearch =new Regex($search_value, 'i');
            // dd($search_by);
            if ($search_by == 'previligies_body')
            {
                $search_data = ['$match' => ["previligies.previligies_body" => $datasearch]];
            }
            else if ($search_by == 'previligies_subject')
            {
                $search_data = ['$match' => ["previligies.previligies_subject" => $datasearch]];
    
            }
            // dd($search_value);
            if (empty($search_value))
            {
                $total_records = 0;
                $cursor =Company_Previligies::raw()->aggregate([
                    ['$match' => ['company_id' => $companyID]],
                    ['$project' => ['size' => ['$size' => ['$previligies']],
                    ]]
                ]);
                $totalarray = $cursor;
                $docarray = array();
                foreach ($cursor as $v) {
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
                        $show1 = Company_Previligies::raw()->aggregate([
                            ['$match' => ["company_id" => $companyID, "_id" => $docid]],
                            ['$project' => ["company_id" => $companyID, "previligies" => ['$slice' => ['$previligies', $end, $start - $end]]]],
                            ['$project' => ["previligies._id" => 1,"previligies.company_id" => 1,"previligies.user" => 1,"previligies.counter" => 1,"previligies.previligies_name" => 1,"previligies.deleteUser" => 1,
                            "previligies.deleteTime" => 1,"previligies.created_at" => 1,"previligies.updated_at" => 1]],
                        ]);
    
                        $c = 0;
                        $arrData1 = "";
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
                // $this->getTable($db,$data,$helper);
            }
            else
            {
                $show =Company_Previligies::raw()->aggregate([
                    ['$match' => ["company_id" => $companyID]],
                    // ['$match' => ["company_id" => $companyID]],
                    //['$match' => ["previligies.previligies_subject"=>$search_data]],
                    // ['$unwind' => '$previligies'],
                    // $search_data,
                    ['$project' => ["previligies._id" => 1,"previligies.company_id" => 1,"previligies.counter" => 1,"previligies.user" => 1,"previligies.previligies_body" => 1,"previligies.deleteUser" => 1,
                    "previligies.deleteTime" => 1,"previligies.created_at" => 1,"previligies.updated_at" => 1]],
                    ['$limit' => 100]
                ]);

                
                // dd($show);
                $completedata = array();
                $custdata = array();
                $arrData1 = array();
                foreach ($show as $rw) {
                      $main = $rw['_id'];
                      $arrData1[] = $rw['previligies'];
                    }
                if(!empty($main) && !empty($arrData1))
                {
                    $custdata = array('_id' => $main, 'previligies' => $arrData1);
                    $arrData1 = array('arrData1' => $custdata);
                }
                $completedata[][] = $arrData1;
                echo json_encode($completedata);
    
            }
        }
}
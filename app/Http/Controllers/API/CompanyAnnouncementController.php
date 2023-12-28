<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\API\Company_Announcement;
use App\Models\API\Company_Admins;
use App\Helpers\AppHelper;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use MongoDB\BSON\Regex;
use File;
use Image;
use MongoDB\BSON\ObjectId;

class CompanyAnnouncementController extends Controller
{
    public function view_announcement(Request $request)
    {
        $token = $request->bearerToken();
        $secretKey ='345fgvvc4';
        $decryptedInput = decrypt($token, $secretKey);
        $token_data=list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
        $company_id=intval($id);
        $records=Company_Announcement::where('announcement.delete_status',"NO")->where('company_id',$company_id)->get();
        $data = json_decode($records, true);

        if ($data) {
            $filteredData = array_map(function ($item)
            {
                $filteredDepartments = array_filter($item['announcement'], function ($holiday) {
                    return $holiday['delete_status'] === 'NO';
                });
                $filteredDepartments = array_intersect_key($item['announcement'], $filteredDepartments);
                $item['announcement'] = $filteredDepartments;
        
                return $item;
            }, $data);
            return response()->json(['success' => true,'data' => $filteredData], 200);
        }
       
        else {
            // Handle the case where no records are found
            return response()->json(['success' => false, 'message' => 'No records found'], 404);
        }
        // $maxLength = 7000;
        // $token = $request->bearerToken();
        // $secretKey ='345fgvvc4';
        // $decryptedInput = decrypt($token, $secretKey);
        // list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
        // $companyID=intval($id);
        // $parent=$request->masterId;
        // $ids=$request->id;
        // $collection=\App\Models\API\Company_Announcement::raw();

        // $show1 = $collection->aggregate([
        //     ['$match' => ['company_id' => (int)$companyID]],
        //     //['$match' => ['announcement._id' => (int)$ids,'announcement.delete_status' => 'NO']]
        // ]);
        
       
        // foreach ($show1 as $row) {
        //     $ann=array();

        //     if(isset($row)){
        //         $companyNameID=$row;
        //         $announcementName =\App\Models\API\Company_Announcement::raw()->aggregate([
        //             ['$match' => ['company_id' => (int)$companyID]],
        //             //['$match' => ['announcement._id' => (int)$ids,'announcement.delete_status' => 'NO']]
        //         ]);
        //         foreach($announcementName as $name){
        //             $l=0;
        //             $ann[$l] = $name;
        //             $l++;
        //         }
        //     }
            
        //     $mainIdac = $row['_id'];
        //     $activeCustomer = array();
        //     $k = 0;
        //     $activeCustomer[$k] = $row['announcement'];
        //     $k++;
        // }
       

        // $annData[]=array("announcement" => $activeCustomer);
        // if($activeCustomer != ''){
        //     return response()->json([
        //         'success' => $annData,
        //     ]);
        // }
        // else{
        //     return response()->json([
        //         'success' => 'No record'
        //     ]);
        // }
    }

    public function add_announcement(Request $request) //done
        {
        $maxLength = 7000;
        $token = $request->bearerToken();
        $secretKey ='345fgvvc4';
        $decryptedInput = decrypt($token, $secretKey);
        list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
        $companyId=intval($id);
        $docAvailable = AppHelper::instance()->checkDoc(Company_Announcement::raw(),$companyId,$maxLength);
        $password = hash('sha1',$request->password);
        $cons = array(
            '_id' =>1,
            'company_id' => $companyId,
            'counter' => 0,
            'announcement_subject' => $request->announcement_subject,
            'announcement_body' => $request->announcement_body,
            'announcement_status' => $request->announcement_status,
            // 'user_add_date' => $request->user_add_date,
            // 'insertedUserId' => Auth::user()->userFirstName.' '.Auth::user()->userLastName,
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
            $cons['_id'] = AppHelper::instance()->getAdminDocumentSequence($companyId, Company_Announcement::raw(),'announcement',$docId);
            Company_Announcement::raw()->updateOne(['company_id' => $companyId,'_id'=>(int)$docId], ['$push' => ['announcement' => $cons]]);
            $cons['masterID'] = $docId;
            echo json_encode($cons);

            return response()->json(['message' => 'Announcement Added successfully'], 201);
        }
        else
        {
            $parentId =AppHelper::instance()->getNextSequenceForNewDoc(\App\Models\API\Company_Announcement::raw());
            $cons['_id'] =AppHelper::instance()->getNextSequenceForNewId(\App\Models\API\Company_Announcement::raw(),'announcement','$announcement._id',$companyId);
            $arra = array(
                "_id" => $parentId,
                "counter" => (int)1,
                "company_id" => (int)$companyId,
                "announcement" => array($cons),
            );
            \App\Models\API\Company_Announcement::raw()->insertOne($arra);
            return response()->json(['message' => 'Announcement Added successfully'], 201);
        }
    }

    public function edit_announcement(Request $request)
    {
        $maxLength = 7000;
        $token = $request->bearerToken();
        $secretKey ='345fgvvc4';
        $decryptedInput = decrypt($token, $secretKey);
        list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
        $companyID=intval($id);
        $parent=$request->masterId;
        $ids=$request->id;
        $collection=\App\Models\API\Company_Announcement::raw();

        $show1 = $collection->aggregate([
            ['$match' => ['_id' => (int)$parent, 'company_id' => (int)$companyID]],
            ['$match' => ['announcement._id' => (int)$ids,'announcement.delete_status' => 'NO']]
        ]);
       
        foreach ($show1 as $row) {
            $ann=array();

            if(isset($row)){
                $companyNameID=$row;
                $announcementName =\App\Models\API\Company_Announcement::raw()->aggregate([
                    ['$match' => ['_id' => (int)$parent, 'company_id' => (int)$companyID]],
                    ['$match' => ['announcement._id' => (int)$ids,'announcement.delete_status' => 'NO']]
                ]);
                foreach($announcementName as $name){
                    $l=0;
                    $ann[$l] = $name;
                    $l++;
                }
            }
            // dd($row);
            $mainIdac = $row['_id'];
            $activeCustomer = array();
            $k = 0;
            $activeCustomer[$k] = $row['announcement'];
            $k++;

        }

        $customerData[]=array("announcement" => $activeCustomer);
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

        public function update_announcement(Request $request)
        {
            $maxLength = 7000;
            $token = $request->bearerToken();
            $secretKey ='345fgvvc4';
            $decryptedInput = decrypt($token, $secretKey);
            list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
            $companyId=intval($id);
            $collection=\App\Models\API\Company_Announcement::raw();
            $id=$request->id;
            
            $masterId=(int)$request->masterId;
            $maxLength=6500;
            $docAvailable = AppHelper::instance()->checkDoc(\App\Models\API\Company_Announcement::raw(),$companyId,$maxLength);
            $info = (explode("^",$docAvailable));
            $docId = $info[1];
    
            $customerData=$collection->updateOne(['company_id' => (int)$companyId,'_id' => (int)$docId,'announcement._id' => (int)$id],
            ['$set' => [
                'announcement.$.announcement_subject' => $request->announcement_subject,
                'announcement.$.announcement_body' => $request->announcement_body,
                'announcement.$.announcement_status' => $request->announcement_status,
                // 'announcement.$.edit_by' => $companyId,
                'announcement.$.edit_time' => time()
                ]]
            );
    
            if ($customerData==true)
            {
                $arr = array('status' => 'success', 'message' => 'Announcement Updated successfully.','statusCode' => 200);
                return json_encode($arr);
            }
        }
       
        public function delete_announcement(Request $request)
        {
            $token = $request->bearerToken();
            $secretKey ='345fgvvc4';
            $decryptedInput = decrypt($token, $secretKey);
            list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
            $companyID=intval($id);
            $id=(int)$request->id;
            $masterId=(int)$request->masterId;
            $announcementData=Company_Announcement::raw()->updateOne(['company_id' => $companyID,'_id' => $masterId,'announcement._id' => $id],
            ['$set' => ['announcement.$.delete_status' => 'YES','announcement.$.deleteUser' =>intval($id),'announcement.$.deleteTime' => time()]]
            );
           if ($announcementData==true)
           {
               $arr = array('status' => 'success', 'message' => 'Announcement deleted successfully.','statusCode' => 200);
                return json_encode($arr);
           }
        }
        public function index_announcement(Request $request)
        {
            $token = $request->bearerToken();
            $secretKey ='345fgvvc4';
            $decryptedInput = decrypt($token, $secretKey);
            $token_data=list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
            $companyID=intval($id);
            $total_records = 0;
            $cursor = Company_Announcement::raw()->aggregate([
                ['$match' => ['company_id' => (int)$companyID]],
                ['$project' => ['size' => ['$size' => ['$announcement']],
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
                    $show1 = Company_Announcement::raw()->aggregate([
                        ['$match' => ["company_id" => $companyID, "_id" => $docid]],
                        // ['$unwind' => ['path' => '$announcement']],
                        ['$project' => ["company_id" => $companyID, "announcement" => ['$slice' => ['$announcement', $end, $start - $end]]]],
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
        
        public function search_announcement(Request $request)
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
            if ($search_by == 'announcement_body')
            {
                $search_data = ['$match' => ["announcement.announcement_body" => $datasearch]];
            }
            else if ($search_by == 'announcement_subject')
            {
                $search_data = ['$match' => ["announcement.announcement_subject" => $datasearch]];
    
            }
            // dd($search_value);
            if (empty($search_value))
            {
                $total_records = 0;
                $cursor =Company_Announcement::raw()->aggregate([
                    ['$match' => ['company_id' => $companyID]],
                    ['$project' => ['size' => ['$size' => ['$announcement']],
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
                        $show1 = Company_Announcement::raw()->aggregate([
                            ['$match' => ["company_id" => $companyID, "_id" => $docid]],
                            ['$project' => ["company_id" => $companyID, "announcement" => ['$slice' => ['$announcement', $end, $start - $end]]]],
                            ['$project' => ["announcement._id" => 1,"announcement.company_id" => 1,"announcement.counter" => 1,"announcement.announcement_body" => 1, 
                            "announcement.announcement_status" => 1, "announcement.announcement_subject"=>1,"announcement.deleteUser" => 1,
                            "announcement.deleteTime" => 1,"announcement.created_at" => 1,"announcement.updated_at" => 1]],
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
                // dd($search_value);
                $show =Company_Announcement::raw()->aggregate([
                    ['$match' => ["company_id" => $companyID]],
                    // ['$match' => ["company_id" => $companyID]],
                    //['$match' => ["announcement.announcement_subject"=>$search_data]],
                    // ['$unwind' => '$announcement'],
                    // $search_data,
                    ['$project' => ["announcement._id" => 1,"announcement.company_id" => 1,"announcement.counter" => 1,"announcement.announcement_body" => 1, 
                    "announcement.announcement_status" => 1, "announcement.announcement_subject"=>1,"announcement.deleteUser" => 1,
                    "announcement.deleteTime" => 1,"announcement.created_at" => 1,"announcement.updated_at" => 1]],
                    ['$limit' => 100]
                ]);

                
                // dd($show);
                $completedata = array();
                $custdata = array();
                $arrData1 = array();
                foreach ($show as $rw) {
                      $main = $rw['_id'];
                      $arrData1[] = $rw['announcement'];
                    }
                if(!empty($main) && !empty($arrData1))
                {
                    $custdata = array('_id' => $main, 'announcement' => $arrData1);
                    $arrData1 = array('arrData1' => $custdata);
                }
                $completedata[][] = $arrData1;
                echo json_encode($completedata);
    
            }
        }
}
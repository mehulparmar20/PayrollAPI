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
            'user_email' => $request->announcement_subject,
            'user_name' => $request->announcement_body,
            'user_type' => $request->announcement_status,
            'user_add_date' => $request->user_add_date,
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

            return response()->json(['message' => 'User Added successfully'], 201);
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
            $announcement_id=(int)$request->id;
            $result = Company_Announcement::where('_id',$announcement_id )->first();
            $companyArray=$result->announcement;
            $arrayLength=count($companyArray);
            $i=0;
            $v=0;
           for ($i=0; $i<$arrayLength; $i++){
                $id=$result->announcement[$i];
                    foreach ($id as $value){
                        if($value){
                            // if($value==$email){
                            $v=$i;
                         }
                    }
            }
           $announcementEditData=$result->announcement[$v];
           return response()->json($announcementEditData);  
        }  

        public function update_announcement(Request $request){

            request()->validate([
                '_id'=> 'required',
                'announcement_subject' => 'required',
                'announcement_body'=>'required',
                'announcement_status'=>'required',
                // 'up_mailingAddress' => 'required|unique:company,company.mailingAddress'.$request->up_mailingAddress,
            ]);
    
            $resultUp = Company_Announcement::where('_id',(int)$request->_id)->first();
            $announceArrayUp=$resultUp->announcement;
            $arrayLengthUp=count($announceArrayUp);
            $i=0;
            $v=0;
            for ($i=0; $i<$arrayLengthUp; $i++){
                    $id=$resultUp->announcement[$i];
                        foreach ($id as $value){
                            if($value){
                                $v=$i;
                            }
                        }
            }
    
           $announceArrayUp[$v]['announcement_subject']=$request->announcement_subject;
           $announceArrayUp[$v]['announcement_body']=$request->announcement_body;
           $announceArrayUp[$v]['announcement_status']=$request->announcement_status;
    
           $resultUp->announcement = $announceArrayUp;
           if($resultUp->save()){
                $arr = array('status' => 'success', 'message' => 'Announcement edited successfully.','statusCode' => 200); 
                return json_encode($arr);
            }
        }

        public function delete_announcement(Request $request)
        {
            $token = $request->bearerToken();
            $secretKey ='345fgvvc4';
            $decryptedInput = decrypt($token, $secretKey);
            list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
            $id=(int)$request->id;
            $masterId=(int)$request->masterId;
            $companyID=intval($id);
            $userData=Company_Announcement::raw()->updateOne(['company_id' => $companyID,'_id' => $masterId,'announcement._id' => $id],
            ['$set' => ['announcement.$.delete_status' => 'YES','announcement.$.deleteUser' =>intval($id),'announcement.$.deleteTime' => time()]]
            );
           if ($userData==true)
           {
               $arr = array('status' => 'success', 'message' => 'User deleted successfully.','statusCode' => 200);
                return json_encode($arr);
           }
        }

        public function index_announcement(Request $request)
        {
            $token = $request->bearerToken();
            $secretKey ='345fgvvc4';
            $decryptedInput = decrypt($token, $secretKey);
            $token_data=list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
            $resultUp = Company_Announcement::where('company_id',intval($id))->get();
            // dd($resultUp);
            // $announceArrayUp=$resultUp->announcement;
            // dd($announceArrayUp);
            // $arrayLengthUp=count($resultUp);
            // dd($arrayLengthUp);
            // $i=0;
            // $v=0;
            // for ($i=0; $i<$arrayLengthUp; $i++){
            //         $id=$resultUp->announcement[$i];
            //             foreach ($id as $value){
            //                 if($value){
            //                     $v=$i;
            //                 }
            //             }
            // }
            // $rec=Company_Admins::all();
            // $records=Company_Announcement::where('delete_status', 1)->get();
            
            $records=Company_Announcement::where('delete_status', "1")->where('company_id',intval($id))->paginate(10);
            return response()->json(['success' => true,'data' => $records], 200);
        }

        public function search_announcement(Request $request)
        {
            $token = $request->bearerToken();
            $secretKey ='345fgvvc4';
            $decryptedInput = decrypt($token, $secretKey);
            $token_data=list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
            $companyID = intval($id);
            $search_by = $request->announcement_subject;
            $search_value = $request->announcement_body;
       
            $datasearch = new Regex('^' . $search_value, 'i');
            // dd($datasearch);
            if ($search_by) 
            {
                $search_data = ['$match' => ["company_announcement.announcement_subject" => $datasearch]];
            } 
            else
            {
                $search_data = ['$match' => ["company_announcement.announcement_body" => $datasearch]];
            } 
            if (empty($search_value)) 
            {
                $total_records = 0;
                $cursor = Company_Announcement::raw()->aggregate([
                    ['$match' => ['company_id' => $companyID]],
                    ['$project' => ['size' => ['$size' => ['$consignee']],
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
                        $show1 = Consignee::raw()->aggregate([
                            ['$match' => ["company_id" => $companyID, "_id" => $docid]],
                            ['$project' => ["company_id" => $companyID,"consignee" => ['$slice' => ['$consignee',$end,$start - $end]]]]
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
                        $partialdata[]=$arrData2;
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
                $show = Company_Announcement::raw()->aggregate([
                    ['$match' => ["company_id" => $companyID]],
                    // ['$unwind' => '$consignee'],
                    $search_data,
                    ['$limit' => 100]
                ]);
               
                $completedata = array();
                $contdata = array();
                $arrData1 = array();
                foreach ($show as $rw) 
                {
                    $main = $rw['_id'];
                    $arrData1[] = $rw['announcement'];
                }
                // dd($main);
                if(!empty($main) && !empty($arrData1))
                {
                    $contdata = array('_id' => $main, 'announcement' => $arrData1);
                    $arrData1 = array('arrData1' => $contdata);
                }
                // dd($arrData1);
                $completedata[][] = $arrData1;
                
                echo json_encode($completedata);
            }
        }

}
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
            $token = $request->bearerToken();
            $secretKey ='345fgvvc4';
            $decryptedInput = decrypt($token, $secretKey);
            $token_data=list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
            $company_id=intval($id);//fetch company_id
            // if ($company_admins) {
                    // Continue with user creation
                    $validatedData = $request->validate([
                        'announcement_subject' => 'required',
                        'announcement_body'=>'required',
                        'announcement_status'=>'required',
                ]);
                $new_id = Company_Announcement::max('_id') + 1;
                $maxLength = 2;
                $companyID=intval($id);
                $getCompany = Company_Announcement::where('company_id',1)->first();
                $docAvailable = AppHelper::instance()->checkDoc(Company_Announcement::raw(),$companyID,$maxLength);
            
                if($docAvailable != "No")
                {
                    $info = (explode("^",$docAvailable));
                    $docId = $info[1];
                    $counter = $info[0];

                    $announce_data[]=array(    
                        '_id' => $new_id,
                        'company_id'=>$company_id,
                        'counter' => 0,
                        'announcement_subject' => $validatedData['announcement_subject'],
                        'announcement_body' => $validatedData['announcement_body'],
                        'announcement_status' =>$validatedData['announcement_status'],
                        'delete_status'=>1,
                        'created_at' => now(),
                        'updated_at' => now(),
                    );
                   
                if($getCompany != null){
                    $companyArray=$getCompany->company;
                    Company_Announcement::where(['company_id' =>1 ])->update([
                        // 'company' =>array_merge($announce_data,$companyArray) 
                        'announcement' =>$announce_data
                    ]);
    
                    $data = [
                        'success' => true,
                        'message'=> 'Announcement added successfully'
                    ] ;
                    
                    return response()->json($data);
                }else{
                    $data_users = [
                     '_id' => $new_id,
                     'company_id'=>$company_id,
                     'counter' => 0,
                     'announcement' => $announce_data,
                     'deleteStatus' => 0,
                    ];
                    $data = Company_Announcement::insert($data_users);
                    {
                        $data = [
                            'success' => true,
                            'message'=> 'Announcement added successfully'
                            ] ;
                            return response()->json($data);
                    }
                }
            }
            else {
                return response()->json(['message' => 'Announcement not found'], 404);
            }
        }

        public function edit_announcement(Request $request)
        {
            $announcement_id=(int)$request->id;
            // $companySubId=$request->companySubId;
            // $email=$request->email;
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

        public function delete_announcement(Request $request){
            $id=(int)$request->id;
            $result = Company_Announcement::where('_id',$id )->first();
            $announcementArray=$result->announcement;
    
            $arrayLength=count($announcementArray);
            $i=0;
            $v=0;
            for ($i=0; $i<$arrayLength; $i++){
                    $id=$result->announcement[$i];
                
                        foreach ($id as $value){
                            if($value){
                                $v=$i;
                            }
                        }
            }
       
           $announcementArray[$v]['delete_status'] = "0"; 
           $result->announcement = $announcementArray;
           if ($result->save()) {
                $success = true;
                $message = "Announcement deleted successfully";
            } else {
                $success = false;
                $message = "Announcement not found";
            }
    
            //  Return response
            return response()->json([
                'success' => $success,
                'message' => $message,
            ]);
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
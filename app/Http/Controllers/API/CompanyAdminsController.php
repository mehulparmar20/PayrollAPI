<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Hash;
use App\Models\API\Company_Admins;
use App\Models\API\Company_user;
use App\Models\API\Company_Employee;
use App\Models\API\Login_History;
use App\Models\User;
use App\Models\API\TokenHandler;
use App\Helpers\AppHelper;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use Auth;
use Mail;
use Hash;
use Session;
use Validator;
use Intervention\Image\Facades\Image;
// use Image;
use File;

class CompanyAdminsController extends Controller
{
    public function store(Request $request)
    {
        $validator =  Validator::make($request->all(),[
        'company_name' => 'required',
        'company_address' => 'required',
        'company_email' => 'required',
        'password' => 'required',
        ]);
    
        if($validator->fails()){
            return response()->json([
                "error" => 'validation_error',
                "message" => $validator->errors(),
            ], 422);
        }
       
        if(Company_Admins::where('company_email', $request->company_email)->first() != null)
        {
            // dd('emmd');
            return response()->json(["result" => "Email already exits!"], 500);
        }
        $password = hash('sha1',$request->password);
       
        $getCompany = Company_Admins::max('_id');
        $new_id=$getCompany+1;

        $companyname= $request->company_name;
        $user= $request->admin_username;
        $admin_name= $request->admin_name;
        $id=$new_id;
      //logo
    //   $photo_name="";
    //   $original_name="";
    //   $size="";
    //   $photo_path="";
    //   $path = public_path().'/CompanyAdmins';
    //   if ($files = $request->file('file')) {
    //       $ImageUpload = Image::make($files);
    //       $originalPath = 'CompanyAdmins/';
    //       // $ImageUpload->save($originalPath.time().$files->getClientOriginalName());

    //       $ImageUpload =  $originalPath.time().$files->getClientOriginalName();
    //                   $filePath=$files->move($path, $ImageUpload);

    //       $photo_path = 'CompanyAdmins/'.time().$files->getClientOriginalName();
    //       $photo_name = time().$files->getClientOriginalName();
    //       $original_name = $files->getClientOriginalName();
    //       $size = $request->file("file")->getSize();
    //   }//end logo
        $token = encrypt($id . '|'. $user . '|' . $admin_name. '|' . $companyname, '345fgvvc4');
       
        $data=array(
             '_id' => $new_id,
            'company_name' => $request->input('company_name'),
            'company_address' => $request->input('company_address'),
            'admin_name' => $request->input('admin_name'),
            'password' => $password,
            'admin_contact' => $request->input('admin_contact'),
            'company_email' => $request->input('company_email'),
            'admin_username' => $request->input('admin_username'),
            'total_employee' => $request->input('total_employee'),
            'token'=> $token,
            'country' => $request->input('country'),
            'city' => $request->input('city'),
            'state' => $request->input('state'),
            'pincode' => $request->input('pincode'),
            'fax' => $request->input('fax'),
            // 'userId' => (int)Auth::user()->_id,
            // 'insertedUserId' => Auth::user()->userName,
            // 'deleteStatus' => '0',
            // 'mode' => 'day',
            'emailVerificationStatus' => 0,
            'subscription_id' => '',
            'subscription_status' => '',
            'otp' => '',
            'plan_name' => '',
            'plan_start' => '',
            'plan_end' => '',
            'api_status' => '',
            'company_upload_storage' => '',
            'register_ip' => '',
            'last_login_id' => '',
            'os' => '',
            'browser' => '',
            'login_time' => '',
            'password_change' => '',
            'forgototp' => '',
            'updated_at' => '',
            'created_at' => '',
            // 'deleted_at' => '',
            // 'deleteTime' => '',
            // 'deleteUser' => '',
        );
        $result=Company_Admins::raw()->insertOne($data);
        
        if($result){
            $result=$data;
            $success = true;
            $message = "Company added successfully and please check your email";
        } else {
            $success = false;
            $message = "Company not added. Please try again";
            $result=$data;
        }

        if($data['emailVerificationStatus'] == 0)
        {
            $array=array();
            $array['email'] = $request->input('company_email');
            Mail::send('emails.verify_email', $array,function($message) use ($array) {
                $message->to($array['email']);
                $message->subject('email verify');
            });
        }

        $token_handelrs = TokenHandler::max('_id');
        $new_id_token=$token_handelrs+1;
        // $token = Str::lower(Str::random(22));
            $data_token=array(    
            '_id' => $new_id_token,
            'company_id'=>$new_id,
            'token' => $token,
            'status'=>'delevered',
             'company_verify'=>array(  
                    'companyName' => $request->input('company_name'),
                    'company_email' =>$request->input('company_email'),
               )
        );
        TokenHandler::raw()->insertOne($data_token);
     
        return response()->json([
            'success' => $success,
            'message' => $message,
            'data'=>$result,
        ]);
    
        return response()->json(["result" => "ok"], 201);
    }
   
    public function sendVerificationEmail(Request $request)
    {
        //dd($request->email);
        // $email=$request->email;
        $email= Crypt::decrypt($request->email);
        
        $comapny_admin=Company_Admins::where('company_email',$email)->first();
        $comapny_admin->emailVerificationStatus="1";
        $comapny_admin->email_verified_at=now();
        $comapny_admin->save();

        $token=TokenHandler::where('company_id',$comapny_admin->_id)->first();
        $token->status="verified";
        $token->save();
        // return response()->json(["result" => "ok"], 201);
        // return view('view.email.mail_page');
        return view('emails.mail_page');
    }

    public function company_login(Request $request)
    {
        $validator =  Validator::make($request->all(),[
            'email' => 'required',
            'password' => 'required',
            'type' => 'required',
            ]);
        
            if($validator->fails()){
                return response()->json([
                    "error" => 'validation_error',
                    "message" => $validator->errors(),
                ], 422);
            }
          
            $email = $request->email;
            $password = $request->password;
            $types = $request->type;
            $maxLength = 7000;
            if($types == 'admin'){ // check the type is company admin or not in copnany_user table and compnay_user table
            $collection=Company_Admins::raw();
            $company_admin = $collection->aggregate([['$match' => ['company_email' => $email, 'password' => sha1($password)]]]);
            
            $collection=Company_user::raw();
            $company_user = $collection->aggregate([['$match' => ['user_email' => $email, 'user_password' => sha1($password)]]]);
            // dd(sha1($password));
            if ($company_admin) {
                foreach($company_admin as $u){
                    if($u != ''){
                    if($u->emailVerificationStatus == '1'){
                    $companyModel = new Company_Admins(); // Create a new instance of the User model
                    $companyModel->companyID = $u->_id;
                    $companyModel->userEmail = $u->company_email;
                    $companyModel->userPass = $u->password;
                    $token_data = TokenHandler::where(['company_id'=>$u->_id])->first();
                    $token= $token_data->token;
                    $secretKey ='345fgvvc4';
                    $decryptedInput = decrypt($token, $secretKey);
                    $token_data->token=list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
                    $companyModel->token = $token;
                    }
                    else{
                        $companyModel = "Email Not Verified";
                    }
                    // Login_history
                    $companyId=$u->_id;
                    $company_email=$u->company_email;
                    $docAvailable = AppHelper::instance()->checkDoc(Login_History::raw(),$companyId,$maxLength);
                    $cons = array(
                        '_id' =>1,
                        'company_id' => $companyId,
                        'counter' => 0,
                        'email'=>$company_email,
                        'insertedTime' => time(),
                    );
                    if($docAvailable != "No")
                    {
                        $info = (explode("^",$docAvailable));
                        $docId = $info[1];
                        $counter = $info[0];
                        $cons['_id'] = AppHelper::instance()->getAdminDocumentSequence($companyId, Login_History::raw(),'company_user',$docId);
                        Login_History::raw()->updateOne(['company_id' => $companyId,'_id'=>(int)$docId], ['$push' => ['company_user' => $cons]]);
                        $cons['masterID'] = $docId;}
                    else
                    {
                        $parentId =AppHelper::instance()->getNextSequenceForNewDoc(\App\Models\API\Login_History::raw());
                        $cons['_id'] =AppHelper::instance()->getNextSequenceForNewId(\App\Models\API\Login_History::raw(),'company_user','$company_user._id',$companyId);
                        $arra = array(
                            "_id" => $parentId,
                            "counter" => (int)1,
                            "company_id" => (int)$companyId,
                            "company_user" => array($cons),
                        );
                        \App\Models\API\Login_History::raw()->insertOne($arra);
                    }
                
                    return response()->json([
                        'success' => true,
                        'message' => "success",
                        'data'=>$companyModel,
                    ]);
                    }
                }
               
            }

            if ($company_user) {
                foreach($company_user as $u){
                    if($u != ''){
                    $userModel = new Company_user(); // Create a new instance of the User model
                    $userModel->companyID = $u->company_id;
                    $userModel->id = $u->_id;
                    $userModel->userEmail = $u->user_email;
                    $userModel->userPass = $u->user_password;
                    $token_data = TokenHandler::where(['company_id'=>$u->company_id])->first();
                    $token= $token_data->token;
                    $secretKey ='345fgvvc4';
                    $decryptedInput = decrypt($token, $secretKey);
                    $token_data->token=list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
                    $userModel->token = $token;  
                    // Login_history
                    $companyId=$u->company_id;
                    $company_email=$u->user_email;
                    $docAvailable = AppHelper::instance()->checkDoc(Login_History::raw(),$companyId,$maxLength);
                    $cons = array(
                        '_id' =>1,
                        'company_id' => $companyId,
                        'counter' => 0,
                        'email'=>$company_email,
                        'insertedTime' => time(),
                    );
                    if($docAvailable != "No")
                    {
                        $info = (explode("^",$docAvailable));
                        $docId = $info[1];
                        $counter = $info[0];
                        $cons['_id'] = AppHelper::instance()->getAdminDocumentSequence($companyId, Login_History::raw(),'company_user',$docId);
                        Login_History::raw()->updateOne(['company_id' => $companyId,'_id'=>(int)$docId], ['$push' => ['company_user' => $cons]]);
                        $cons['masterID'] = $docId;}
                    else
                    {
                        $parentId =AppHelper::instance()->getNextSequenceForNewDoc(\App\Models\API\Login_History::raw());
                        $cons['_id'] =AppHelper::instance()->getNextSequenceForNewId(\App\Models\API\Login_History::raw(),'company_user','$company_user._id',$companyId);
                        $arra = array(
                            "_id" => $parentId,
                            "counter" => (int)1,
                            "company_id" => (int)$companyId,
                            "company_user" => array($cons),
                        );
                        \App\Models\API\Login_History::raw()->insertOne($arra);
                    }
                    
                    return response()->json([
                        'success' => true,
                        'message' => "success",
                        'data'=>$userModel,
                    ]);
                }
                }
            }
            }
            else{
                $collection=Company_Employee::raw();
                $company_employee = $collection->aggregate([['$match' => ['email' => $email, 'password' => sha1($password)]]]);
                if ($company_employee) {
                    foreach($company_employee as $u){
                        if($u != ''){
                        $userModel = new Company_Employee(); // Create a new instance of the User model
                        $userModel->id = $u->_id;
                        $userModel->companyID = $u->company_id;
                        $userModel->userEmail = $u->email;
                        $userModel->branch = $u->branch;
                        $userModel->userPass = $u->password;
                        $token_data = TokenHandler::where(['company_id'=>$u->company_id])->first();
                        $token= $token_data->token;
                        $secretKey ='345fgvvc4';
                        $decryptedInput = decrypt($token, $secretKey);
                        $token_data->token=list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
                        $userModel->token = $token;
                         // Login_history
                         $companyId=$u->_id;
                         $company_email=$u->email;
                         $docAvailable = AppHelper::instance()->checkDoc(Login_History::raw(),$companyId,$maxLength);
                         $cons = array(
                             '_id' =>1,
                             'company_id' => $companyId,
                             'counter' => 0,
                             'email'=>$company_email,
                             'insertedTime' => time(),
                         );
                         if($docAvailable != "No")
                         {
                             $info = (explode("^",$docAvailable));
                             $docId = $info[1];
                             $counter = $info[0];
                             $cons['_id'] = AppHelper::instance()->getAdminDocumentSequence($companyId, Login_History::raw(),'company_user',$docId);
                             Login_History::raw()->updateOne(['company_id' => $companyId,'_id'=>(int)$docId], ['$push' => ['company_user' => $cons]]);
                             $cons['masterID'] = $docId;}
                         else
                         {
                             $parentId =AppHelper::instance()->getNextSequenceForNewDoc(\App\Models\API\Login_History::raw());
                             $cons['_id'] =AppHelper::instance()->getNextSequenceForNewId(\App\Models\API\Login_History::raw(),'company_user','$company_user._id',$companyId);
                             $arra = array(
                                 "_id" => $parentId,
                                 "counter" => (int)1,
                                 "company_id" => (int)$companyId,
                                 "company_user" => array($cons),
                             );
                             \App\Models\API\Login_History::raw()->insertOne($arra);
                         }  
                        return response()->json([
                            'success' => true,
                            'message' => "success",
                            'data'=>$userModel,
                        ]);
                    }
                    }
                }
               
            }
            return response()->json([
            'success' => False,
            'message' => "EmailNot Found",
            ]);
            
      
    }

    public function edit_companyadmin(Request $request)//done
    {
        $token = $request->bearerToken();
       $secretKey ='345fgvvc4';
       $decryptedInput = decrypt($token, $secretKey);
       list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
       $companyId=intval($id);
       $id=intval($request->id);
       $existingemployeeData =Company_Admins::where('_id',$id)->get();
       if($existingemployeeData != ''){
           return response()->json([
               'success' => $existingemployeeData,
           ]);
       }
       else{
           return response()->json([
               'success' => 'No record'
           ]);
       }
       

    }
    public function update_companyadmin(Request $request)//success new field country..
    {
        $token = $request->bearerToken();
        $secretKey ='345fgvvc4';
        $decryptedInput = decrypt($token, $secretKey);
        $token_data=list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
        $companyId=intval($id);
        $reqid=intval($request->id);
        $companyArrayUp =Company_Admins::where('_id',$reqid)->first();
        if (!$companyArrayUp) {
            return response()->json(['message' => 'User not found'], 404);
        }
            // $photo_name='';
            // $original_name='';
            // $size='';
            // $photo_path='';
            // if($request->file != null){
            //     if ($request->hasFile('file') && $request->file('file') != '') {
            //         if(!empty($companyArrayUp['file'][0]['filename'])){
            //             $imagePath = public_path('CompanyEmployee/'.$companyArrayUp['file'][0]['filename']);
            //             if(File::exists($imagePath)){
            //                 unlink($imagePath);
            //             }
            //         }
            //         $files = $request->file('file');
            //         $ImageUpload = Image::make($files);
            //         $originalPath = 'CompanyEmployee/';
            //         $ImageUpload->save($originalPath.time().$files->getClientOriginalName());
            //         $photo_path = 'CompanyEmployee/'.time().$files->getClientOriginalName();
            //         $photo_name = time().$files->getClientOriginalName();
            //         $original_name = $files->getClientOriginalName();
            //         $size = $request->file("file")->getSize();
            //     }
            // }else{
            //     $photo_name=$companyArrayUp['file'][0]['filename'];
            //     $original_name=$companyArrayUp['file'][0]['Originalname'];
            //     $size=$companyArrayUp['file'][0]['filesize'];
            //     $photo_path=$companyArrayUp['file'][0]['filepath'];
            // }

        $password = hash('sha1', $request->password);
        $data = [
            'company_name' => $request->company_name,
            'company_address' => $request->company_address,
            'admin_name'=>$request->admin_name,
            'password' =>$password,
            'admin_contact' => $request->admin_contact,
            'company_email' => $request->company_email,
            'admin_username' => $request->admin_username,
            'total_employee' => $request->total_employee,
            'token'=> $token,
            'country' => $request->country,
            'city' => $request->city,
            'state' => $request->state,
            'pincode' => $request->pincode,
            'fax' => $request->fax,
            // 'file' => array(array(
            //     'filename' => $photo_name,
            //     'Originalname' => $original_name,
            //     'filesize' => $size,
            //     'filepath' => $photo_path
            // )
            // ),
            'emailVerificationStatus' => 0,
            'subscription_id' => '',
            'subscription_status' => '',
            'otp' => '',
            'plan_name' => '',
            'plan_start' => '',
            'plan_end' => '',
            'api_status' => '',
            'company_upload_storage' => '',
            'register_ip' => '',
            'last_login_id' => '',
            'os' => '',
            'browser' => '',
            'login_time' => '',
            'password_change' => '',
            'forgototp' => '',
            'updated_at' => '',
            'created_at' => '',
        ];
        // dd($data);
        $result = $companyArrayUp->update($data);
        // dd($result);
            if ($result) {
            return response()->json(['message' => 'Admin updated successfully'], 200);
        } else {
            return response()->json(['message' => 'Failed to update Admin'], 500);
        }

    }
}
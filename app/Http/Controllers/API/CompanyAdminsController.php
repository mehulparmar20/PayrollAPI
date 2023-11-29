<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\API\Company_Admins;
use App\Models\API\TokenHandler;
use Illuminate\Support\Str;
use Auth;
use Mail;
use Session;
use Validator;

class CompanyAdminsController extends Controller
{
    public function store(Request $request)
    {
        $validator =  Validator::make($request->all(),[
        // 'company_id' => 'required',
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
            return response()->json(["result" => "Email already exits!"], 500);
        }
        $password = hash('sha1',$request->admin_password);
      
        $getCompany = Company_Admins::max('_id');
        $new_id=$getCompany+1;
      
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
            'country' => '',
            'city' => '',
            'state' => '',
            'pincode' => '',
            'fax' => '',
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
        $token = Str::lower(Str::random(22));
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
        $email=$request->email;
        $comapny_admin=Company_Admins::where('company_email',$email)->first();
        $comapny_admin->emailVerificationStatus="1";
        $comapny_admin->email_verified_at=now();
        $comapny_admin->save();

        $token=TokenHandler::where('company_id',$comapny_admin->_id)->first();
        $token->status="verified";
        $token->save();
        
        return response()->json(["result" => "ok"], 201);
    }

        public function company_login(Request $request)
        {
            $request->validate([
                'company_email' => 'required',
                'company_password' => 'required',
            ]);
            $email = $request->company_email;
            $password = $request->company_password;
            // $password = hash('sha1',$request->company_password);
        //    dd($email,sha1($password));
        //    $password = hash('sha1',$request->company_password);
           
            // $user = Company_Admins::where(['company_email'=>$email, 'password'=>$password])->first();
            // $user = Company_Admins::where(['company_email'=>$email, 'password'=>'da39a3ee5e6b4b0d3255bfef95601890afd80709'])->first();
            // dd($user);
            $collection=Company_Admins::raw();
        //    dd(sha1($password));
            $user = $collection->aggregate([['$match' => ['company_email' => $email, 'password' => sha1($password)]]]);
            
            // dd($user);
            // $user = $collection->aggregate([['$match' => ['company_email' => $email, 'password' => sha1($password)]]]);
             if ($user) {
                foreach($user as $u){
                    dd($u);

                    // $userModel = new Company_Admins(); // Create a new instance of the User model
                    // $userModel->companyID = $user->_id;
                    // $userModel->userEmail = $user->company_email;
                    // $userModel->userPass = $user->password;
                    // $token_data = TokenHandler::where(['company_id'=>$userModel->companyID])->first();
                    // $userModel->token = $token_data->token;
                }
            }
            die;
            if($user){
                // $result=$userModel;
                $success = true;
                $message = "Login Succesfully";
            } else {
                $success = false;
                $message = "Some error";
                $result=$userModel;
            }
            return response()->json([
                'success' => $success,
                'message' => $message,
                'data'=>$result,
            ]);
      
        }
    // public function company_dashboard(Request $request)
    // {
    //     // $companyID=Auth::user()->companyID;
    //     // $employement = Company_Admins::where('id',$companyID)->first();
    //     // return response()->json($employement); 
    //     $companyID=$request->input('company_id');
     
    //     $company = Company_Admins::where('_id',$companyID)->get();
    //     dd($company);
    //     return response()->json($company); 
     
    //     // return response()->json($customerCurr, 200, [], JSON_PARTIAL_OUTPUT_ON_ERROR);
    // }
}
<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\API\Company_admin;
use App\Models\API\Company_Admins;
use App\Models\API\Company_user;
use App\Models\API\Company_Employee;
use App\Helpers\AppHelper;
use App\Models\User;
use Illuminate\Http\Request;
use Image;
use File;
use Illuminate\Support\Facades\Hash;

class CompanyEmployeeController extends Controller
{
    public function add_employee(Request $request) //done
        {
        $maxLength = 7000;
        $token = $request->bearerToken();
        $secretKey ='345fgvvc4';
        $decryptedInput = decrypt($token, $secretKey);
        list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
        $companyId=intval($id);
        $password = hash('sha1',$request->password);
        $new_id = Company_Employee::max('_id') + 1;

        $photo_name="";
        $original_name="";
        $size="";
        $photo_path="";
        $path = public_path().'/CompanyEmployee';
        // dd($path);
        if ($files = $request->file('file')) {
            $ImageUpload = Image::make($files);
            $originalPath = 'CompanyEmployee/';
            // $ImageUpload->save($originalPath.time().$files->getClientOriginalName());

            $ImageUpload =  $originalPath.time().$files->getClientOriginalName();
                        $filePath=$files->move($path, $ImageUpload);

            $photo_path = 'CompanyEmployee/'.time().$files->getClientOriginalName();
            $photo_name = time().$files->getClientOriginalName();
            $original_name = $files->getClientOriginalName();
            $size = $request->file("file")->getSize();
        }


        $data = [
            '_id' => $new_id,
            'company_id'=>$companyId,
            // 'counter'=>$latest_total_employee,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email'=>$request->email,
            'joining_date'=>$request->joining_date,
            'phone'=>$request->phone,
            'department'=>$request->department,
            'password' =>$password,
            'salary' => $request->salary,
            'shift' => $request->shift,
            'file' => array(array(
                'filename' => $photo_name,
                'Originalname' => $original_name,
                'filesize' => $size,
                'filepath' => $photo_path
            )
            ),
            'insertedTime' => time(),
            'delete_status' => "NO",
            'deleteUser' => "",
            'deleteTime' => "",
        ];
        
            $result = Company_Employee::insert($data);
            
            if ($result) {
            return response()->json(['message' => 'Employee added successfully'], 200);
            } else {
            return response()->json(['message' => 'Failed to Add User'], 500);
            }
        
    }

    public function edit_employee(Request $request)
    {
       $token = $request->bearerToken();
       $secretKey ='345fgvvc4';
       $decryptedInput = decrypt($token, $secretKey);
       list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
       $companyId=intval($id);
       $id=intval($request->id);
       $existingemployeeData =Company_Employee::where('_id',$id)->where('delete_status','NO')->get();
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
    public function update_employee(Request $request) //done
    {
        $token = $request->bearerToken();
        $secretKey ='345fgvvc4';
        $decryptedInput = decrypt($token, $secretKey);
        $token_data=list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
        $companyId=intval($id);
        $reqid=intval($request->id);
        $companyArrayUp =Company_Employee::where('_id',$reqid)->first();
        if (!$companyArrayUp) {
            return response()->json(['message' => 'User not found'], 404);
        }
            $photo_name='';
            $original_name='';
            $size='';
            $photo_path='';
            if($request->file != null){
                if ($request->hasFile('file') && $request->file('file') != '') {
                    if(!empty($companyArrayUp['file'][0]['filename'])){
                        $imagePath = public_path('CompanyEmployee/'.$companyArrayUp['file'][0]['filename']);
                        if(File::exists($imagePath)){
                            unlink($imagePath);
                        }
                    }
                    $files = $request->file('file');
                    $ImageUpload = Image::make($files);
                    $originalPath = 'CompanyEmployee/';
                    $ImageUpload->save($originalPath.time().$files->getClientOriginalName());
                    $photo_path = 'CompanyEmployee/'.time().$files->getClientOriginalName();
                    $photo_name = time().$files->getClientOriginalName();
                    $original_name = $files->getClientOriginalName();
                    $size = $request->file("file")->getSize();
                }
            }else{
                $photo_name=$companyArrayUp['file'][0]['filename'];
                $original_name=$companyArrayUp['file'][0]['Originalname'];
                $size=$companyArrayUp['file'][0]['filesize'];
                $photo_path=$companyArrayUp['file'][0]['filepath'];
            }

        $password = hash('sha1', $request->user_password);
        $data = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email'=>$request->email,
            'joining_date'=>$request->joining_date,
            'phone'=>$request->phone,
            'department'=>$request->department,
            'password' =>$password,
            'salary' => $request->salary,
            'shift' => $request->shift,
            'file' => array(array(
                'filename' => $photo_name,
                'Originalname' => $original_name,
                'filesize' => $size,
                'filepath' => $photo_path
            )
            ),
            'insertedTime' => time(),
            'delete_status' => "NO",
            'deleteUser' => "",
            'deleteTime' => "",
        ];
        $result = $companyArrayUp->update($data);
            if ($result) {
            return response()->json(['message' => 'Employee updated successfully'], 200);
        } else {
            return response()->json(['message' => 'Failed to update Employee'], 500);
        }

        }
        public function delete_employee(Request $request) //done
        {
            $token = $request->bearerToken();
            $secretKey ='345fgvvc4';
            $decryptedInput = decrypt($token, $secretKey);
            list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
            $companyID=intval($id);
            $id=(int)$request->id;
            // $masterId=(int)$request->masterId;
            $userData=Company_Employee::raw()->updateOne(['company_id' => $companyID,'_id' => $id],
            ['$set' => ['delete_status' => 'YES','deleteUser' =>intval($id),'deleteTime' => time()]]
            );
           if ($userData==true)
           {
               $arr = array('status' => 'success', 'message' => 'Employee deleted successfully.','statusCode' => 200);
                return json_encode($arr);
           }
         }
            
      public function view_employee(Request $request)
        {
            $token = $request->bearerToken();
            //$token= $token_data->token;
            $secretKey ='345fgvvc4';
            $decryptedInput = decrypt($token, $secretKey);
            $token_data=list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
            $company_id=intval($id);
            $records=Company_Employee::where('delete_status', 'NO')->where('company_id',$company_id)->get();
            // return response()->json(['success' => true,'data' => $records], 200);
            if ($records->isEmpty()) {
            return response()->json(['message' => 'No results found'], 404);
            } else {
                return response()->json(['success' => true, 'data' => $records], 200);
            }
        }
        
    public function paginate_employee(Request $request)
        {
            $token = $request->bearerToken();
            //$token= $token_data->token;
            $secretKey ='345fgvvc4';
            $decryptedInput = decrypt($token, $secretKey);
            $token_data=list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
            $company_id=intval($id);
            $records=Company_Employee::where('delete_status', 'NO')->where('company_id',$company_id)->paginate(10);
           // return response()->json(['success' => true,'data' => $records], 200);
            if ($records->isEmpty()) {
            return response()->json(['message' => 'No results found'], 404);
            } else {
                return response()->json(['success' => true, 'data' => $records], 200);
            }
        }
        public function search_employee(Request $request) //search
        {
            $name=$request->name;
            $results=Company_Employee::where('email','like','%'.$name.'%')->get();
            // dd($results);
            if($results->isEmpty()) {
                return response()->json(['message' => 'No results found'], 404);
            } else {
                
                return response()->json(['results' => $results], 200);
            }
        }
}

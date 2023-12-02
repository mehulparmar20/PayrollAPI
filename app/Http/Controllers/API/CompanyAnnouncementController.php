<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\API\Company_Announcement;
use App\Helpers\AppHelper;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
                
            
            // else {
            //     return response()->json(['message' => 'Announcement not found'], 404);
            // }
        }
}
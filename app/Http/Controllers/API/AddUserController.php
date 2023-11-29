<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\API\Company_admin;
use App\Models\API\Company_user;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AddUserController extends Controller
{
        public function add_user(Request $request)
        {
            $token = $request->bearerToken();
            //$token= $token_data->token;
            $secretKey ='345fgvvc4';
            $decryptedInput = decrypt($token, $secretKey);
            $token_data=list($id, $user, $admin_name, $companyname) = explode('|', $decryptedInput);
            //dd($token_data['0']);

            $validatedData = $request->validate([
                    'user_email' => 'required',
                    'user_name'=>'required',
                    'user_password'=>'required',
                    'user_type'=>'required',
                    'user_add_date'=>'required',
                
            ]);
            $password = Hash::make($validatedData['user_password']);
            $new_id = Company_user::max('_id') + 1;

            $data = [
                '_id' => $new_id,
                'company_id'=>$token_data['0'],
                'user_email' => $validatedData['user_email'],
                'user_name' => $validatedData['user_name'],
                'user_password' =>$password,
                'user_type' => $validatedData['user_type'],
                'user_add_date' => $validatedData['user_add_date'],
                'otp' => 0,
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
                'created_at' => now(),
                'updated_at' => now(),
            ];

            $result = Company_user::insert($data);

            if ($result) {
                return response()->json(['message' => 'User Adder successfully'], 201);
            } else {
                return response()->json(['message' => 'Failed to Add user'], 500);
            }
        }


        }


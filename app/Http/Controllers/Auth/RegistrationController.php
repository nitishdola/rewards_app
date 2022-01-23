<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash, Validator, DB,Auth;
use App\Models\User;

class RegistrationController extends Controller
{

    public function registerUser(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'username' => 'required|string|digits:10|unique:users',
            'password'      => 'required|string|min:6|confirmed',
            'user_type'  => 'required|in:USR,AGN'
        ],
        [
            'username.unique'   => 'Mobile number already exists !',
            'email.unique'      => 'Email already exists !',
        ]);
        if ($validator->fails()) {
            return response()->json(['success'=>false,'message'=>$validator->errors()]);
        }
        $otp = mt_rand(100000, 999999);
        //$otp = 123456;
        DB::beginTransaction();

        $customerPhoneExist = User::where([['username',$request->username],['otp_verified','!=',null],['is_active',1]])->first();
        if($customerPhoneExist != null){
            return response()->json(['success'=>false,'message'=>'Mobile number already exists']);
        }


        if($request->email != '') {
            $customerEmailExists = User::where([['email',$request->email],['otp_verified','!=',null],['is_active',1]])->first();
            if($customerEmailExists != null){
                return response()->json(['success'=>false,'message'=>'Email already exists']);
            }
        }
       
        $agent_id = NULL;
        if($request->user_type == 'AGN') {
            $agent_id = random_int(100000, 999999);
        }
        
        $profile_photo_path = NULL;
        if($request->hasFile('profile_photo')){ 
            $validatedData = $request->validate([
             'profile_photo' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
     
            ]);
     
            $profile_photo_name = 'profile_pic_'.$agent_id.$request->username;//$request->file('profile_photo')->getClientOriginalName();
     
            $profile_photo_path = $request->file('profile_photo')->store('public/agents/images/profile_photo');
     
        }


        $id_proof_path = NULL;
        if($request->hasFile('id_proof')){ 
            $validatedData = $request->validate([
             'id_proof' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
     
            ]);
     
            $id_proof_name = 'id_proof_'.$agent_id.$request->username;//$request->file('id_proof')->getClientOriginalName();
     
            $id_proof_path = $request->file('id_proof')->store('public/agents/images/id_proof');
     
        }
        

        User::where([['username',$request->username],['otp_verified','!=',null],['is_active',0]])->orWhere([['username',$request->username],['otp_verified','=',null],['is_active',0]])->delete();
            $user = User::create([
                'name'          => $request->get('name'),
                'email'         => $request->get('email'),
                'username'      => $request->get('username'),
                'referral_code' => $request->get('referral_code'),
                'password' => Hash::make($request->get('password')),
                'otp'   => $otp,
                'user_type' => $request->get('user_type'),
                'is_active' => 0,
                'profile_photo_path' => $profile_photo_path,
                'id_proof_path' => $id_proof_path,
            ]);
            
            
            DB::commit();
            //Helper::sendSMS($request->username,$otp);
            return response()->json(['success'=>true,'message'=>'OTP sent succesfully','customer_details'=>$user->username]);
            

    }


    public function otpVerify(Request $request) {
        $validator = Validator::make($request->all(), [
           'username'       => 'required|numeric',
            'otp'           => 'required|numeric',
        ],
        [
            'username.required'     => 'Mobile number is required !',
            'otp.required'          => 'OTP is required !',
        ]);
        if ($validator->fails()) {
            return response()->json(['success'=>false,'message'=>$validator->errors()]);
        }

        $user = User::select('id','name','username','otp')->where([['username',$request->username],['otp_verified',0],['is_active',0]])->first();


        if($user){
            if($request->otp == $user->otp){
                $credentials = $request->only('username');

                DB::beginTransaction();
                User::where('username',$request->username)->update(
                                [
                                    'is_active'=>1,
                                    'otp_verified'=>1,
                                    'otp' => '',
                                    'otp_verified_at' => date('Y-m-d H:i:s')
                                ]
                            );
                DB::commit();

                return response()->json(["success"=>true,"msg"=>"OTP Verified succesfully"]);
            }else{
                return response()->json(["success"=>false,"msg"=>"Invalid OTP"]);
            }
        }else{
            return response()->json(["success"=>false,"msg"=>"Invalid User"]);
        }

    }

    public function resend_otp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username'=> 'required|numeric'
        ]);
        if ($validator->fails()) {
            return response()->json(['success'=>false,'error'=>$validator->errors()]);
        }
        if (User::where([['username', '=', $request->username],['is_active',0],['otp_verified',0]])->exists()) {
                $otp = mt_rand(100000, 999999);
                $update = User::where([['username',$request->username],['is_active',0]])->update(['otp'=>$otp]);
                if($update){
                    //Helper::sendSMS($request->mobile_number,$otp);
                    return response()->json(['success'=>true,'msg'=>'Otp sent successfully']);
                        }
            
            }
            else{
                return response()->json(['success'=>false,'error'=>'The mobile number does not exist']);
            }
        
    }


    
}

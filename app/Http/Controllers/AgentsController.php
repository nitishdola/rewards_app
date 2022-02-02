<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Validator, Redirect, DB, Hash, Helper;

class AgentsController extends Controller
{
    public function index(Request $request) {
        $results = User::where('user_type', 'AGN')->get();
        return view('admin.master.agents.index', compact('results'));
    }

    public function create() {
        return view('admin.master.agents.create');
    }

    public function store(Request $request) {

        $agent_id = random_int(100000, 999999);

        $data = $request->all();
        $data['added_by_admin_user_id'] = auth()->user()->id;
        $data['user_type']      = 'AGN';
        $data['agend_id']       = strtoupper($agent_id);


        $validatedData = $request->validate([
         'profile_photo' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
 
        ]);
 
        $profile_photo_name = 'profile_pic_'.$agent_id.$request->username;//$request->file('profile_photo')->getClientOriginalName();
 
        $profile_photo_path = $request->file('profile_photo')->store('public/agents/images/profile_photo');
 
        
        $data['profile_photo_path'] = $profile_photo_path;



        $validatedData = $request->validate([
         'id_proof' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
 
        ]);
 
        $id_proof_name = 'id_proof_'.$agent_id.$request->username;//$request->file('id_proof')->getClientOriginalName();
 
        $id_proof_path = $request->file('id_proof')->store('public/agents/images/id_proof');
 
        
        $data['id_proof_path'] = $id_proof_path;


        $data['password'] = bcrypt($agent_id);


        $validator = Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'username' => 'required|string|digits:10|unique:users',
            'password'      => 'required|string|min:6',
        ],
        [
            'username.unique'   => 'Mobile number already exists !',
            'email.unique'      => 'Email already exists !',
        ]);

        
        if ($validator->fails()) {
            if ($validator->fails()) return Redirect::back()->withErrors($validator)->withInput();
        }


        if(User::create($data)) 
            return Redirect::route('admin.agents.index')->with(['message' => 'Agent added successfully !', 'alert-class' => 'alert-success']);
        
 
    }

    public function enable($id) {
        $agent = User::find($id);
        $agent->is_active = 1;
        $agent->save();

        return Redirect::route('admin.agents.index')->with(['message' => 'Agent eanbled successfully !', 'alert-class' => 'alert-success']);
    }


    public function disable($id) {
        $agent = User::find($id);
        $agent->is_active = 0;
        $agent->save();

        return Redirect::route('admin.agents.index')->with(['message' => 'Agent disabled successfully !', 'alert-class' => 'alert-success']);
    }


    public function addVendor(Request $request) {

        if(!auth()->user()->user_type == 'AGN') exit();


        $validator = Validator::make($request->all(), [
            'name'      => 'required|string|max:255',
            'email'     => 'required|string|email|max:255|unique:users',
            'username'  => 'required|string|digits:10|unique:users',
            'pin'       => 'required|string|digits:6',
            'city'      => 'required|string',
            'state'     => 'required|string',
            'address'   => 'required|string',
            //'added_by_agent_user_id' => 'required|exists:users,id',
            //'password'  => 'required|string|min:6|confirmed',
            //'user_type' => 'required|in:VND'
        ],
        [
            'username.unique'   => 'Mobile number already exists !',
            'email.unique'      => 'Email already exists !',
        ]);
        if ($validator->fails()) {
            return response()->json(['success'=>false,'message'=>$validator->errors()]);
        }
        $otp = mt_rand(100000, 999999);

        $six_digit_password = random_int(100000, 999999);

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


        $profile_photo_path = NULL;
        if($request->hasFile('profile_photo')){ 
            $validatedData = $request->validate([
             'profile_photo' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
     
            ]);
     
            //$profile_photo_name = 'profile_pic_'.$request->username;//$request->file('profile_photo')->getClientOriginalName();
     
            $profile_photo_path = $request->file('profile_photo')->store('public/vendors/images/profile_photo');
     
        }


        $id_proof_path = NULL;
        if($request->hasFile('id_proof')){ 
            $validatedData = $request->validate([
             'id_proof' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
     
            ]);
     
            //$profile_photo_name = 'id_proof_'.$request->username;
     
            $id_proof_path = $request->file('id_proof')->store('public/vendors/images/id_proof');
     
        }


        $shop_photo_path = NULL;
        if($request->hasFile('shop_photo')){ 
            $validatedData = $request->validate([
             'shop_photo' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
     
            ]);
     
            //$profile_photo_name = 'id_proof_'.$request->username;
     
            $shop_photo_path = $request->file('shop_photo')->store('public/vendors/images/shop_photo');
     
        }


        

        User::where([['username',$request->username],['otp_verified','!=',null],['is_active',0]])->orWhere([['username',$request->username],['otp_verified','=',null],['is_active',0]])->delete();
            $user = User::create([
                'name'          => $request->get('name'),
                'trade_name'    => $request->get('trade_name'),
                'long'          => $request->get('long'),
                'lat'          => $request->get('lat'),
                'email'         => $request->get('email'),
                'username'      => $request->get('username'),
                'city'          => $request->get('city'),
                'state'         => $request->get('state'),
                'address'       => $request->get('address'),
                'pin'           => $request->get('pin'),
                'pin'           => $request->get('pin'),
                'gst_no' => $request->get('gst_no'),
                'password' => Hash::make($six_digit_password),
                'otp'   => $otp,
                'user_type' => 'VND',
                'is_active' => 0,
                'profile_photo_path'    => $profile_photo_path,
                'id_proof_path'         => $id_proof_path,
                'shop_photo_path'       => $shop_photo_path,
                'added_by_agent_user_id' => auth()->user()->id,
            ]);
            
            
            DB::commit();
            //Helper::sendSMS($request->username,$otp);
            /*return response()->json(['success'=>true,'msg'=>'OTP sent succesfully','customer_details'=> ['username' =>    $user->username, 'otp' => $otp, 'password' => $six_digit_password]]);
            */
            return response()->json(['success'=>true,'message'=>'OTP sent succesfully','customer_details'=> ['username' => $user->username, 'otp' => $otp, 'password' => $six_digit_password]]);
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



    /******************************ADD CONSUMER**********************************/
    public function addConsumer(Request $request) {

        if(!auth()->user()->user_type == 'AGN') exit();


        $validator = Validator::make($request->all(), [
            'name'      => 'required|string|max:255',
            'email'     => 'required|string|email|max:255|unique:users',
            'username'  => 'required|string|digits:10|unique:users',
            'pin'       => 'required|string|digits:6',
            'city'      => 'required|string',
            'state'     => 'required|string',
            'address'   => 'required|string',
            //'added_by_agent_user_id' => 'required|exists:users,id',
            //'password'  => 'required|string|min:6|confirmed',
            //'user_type' => 'required|in:VND'
        ],
        [
            'username.unique'   => 'Mobile number already exists !',
            'email.unique'      => 'Email already exists !',
        ]);
        if ($validator->fails()) {
            return response()->json(['success'=>false,'message'=>$validator->errors()]);
        }
        $otp = mt_rand(100000, 999999);

        $six_digit_password = random_int(100000, 999999);

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


        $profile_photo_path = NULL;
        if($request->hasFile('profile_photo')){ 
            $validatedData = $request->validate([
             'profile_photo' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
     
            ]);
     
            $profile_photo_name = 'profile_pic_'.$request->username;//$request->file('profile_photo')->getClientOriginalName();
     
            $profile_photo_path = $request->file('profile_photo')->store('public/users/images/profile_photo');
     
        }


        $id_proof_path = NULL;
        if($request->hasFile('id_proof')){ 
            $validatedData = $request->validate([
             'id_proof' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
     
            ]);
     
            $profile_photo_name = 'id_proof_'.$request->username;
     
            $id_proof_path = $request->file('id_proof')->store('public/users/images/id_proof');
     
        }


        

        User::where([['username',$request->username],['otp_verified','!=',null],['is_active',0]])->orWhere([['username',$request->username],['otp_verified','=',null],['is_active',0]])->delete();
            $user = User::create([
                'name'          => $request->get('name'),
                'email'         => $request->get('email'),
                'username'      => $request->get('username'),
                'city'          => $request->get('city'),
                'state'         => $request->get('state'),
                'address'       => $request->get('address'),
                'pin'           => $request->get('pin'),
                'referral_code' => $request->get('referral_code'),
                'password' => Hash::make($six_digit_password),
                'otp'   => $otp,
                'user_type' => 'USR',
                'is_active' => 0,
                'profile_photo_path' => $profile_photo_path,
                'added_by_agent_user_id' => auth()->user()->id,
            ]);
            
            
            DB::commit();
            //Helper::sendSMS($request->username,$otp);
            return response()->json(['success'=>true,'message'=>'OTP sent succesfully','customer_details'=> ['username' => $user->username, 'otp' => $otp, 'password' => $six_digit_password]]);
    }

    public function cosnumerOtpVerify(Request $request) {
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

    public function cosnumer_resend_otp(Request $request)
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
    /******************add consumer ends*************************/




    public function search_vendor(Request $request) {
        $data = User::where('added_by_agent_user_id', auth()->user()->id);

        if($request->date_from) {
            $date_from = date('Y-m-d', strtotime($request->date_from));
            $data = $data->whereDate('created_at', '>=', $date_from);
        }

        if($request->date_to) {
            $date_to = date('Y-m-d', strtotime($request->date_to));
            $data = $data->whereDate('created_at', '<=', $date_to);
        }

        if($request->user_type) {
            $data = $data->where('user_type', $request->user_type);
        }

        if($request->show_default_page == 'yes') {
            return $data->limit(10)->orderBy('created_at', 'DESC')->get();
        }

        
        return $data->orderBy('created_at', 'DESC')->get();
    }

    public function agentDashboard(Request $request) {


        $today_vendor_registrations = Helper::vendorRegistrationsCount($date = date('Y-m-d'), $added_by = auth()->user()->id);
        $total_vendor_registrations = Helper::vendorRegistrationsCount($date = null, $added_by = auth()->user()->id);

        $today_consumer_registrations = Helper::userRegistrationsCount($date = date('Y-m-d'), $added_by = auth()->user()->id);
        $total_consumer_registrations = Helper::userRegistrationsCount($date = null, $added_by = auth()->user()->id);

        
        /*return $this->success([
                'today_vendor_registrations'    => $today_vendor_registrations,
                'total_vendor_registrations'    => $total_vendor_registrations,
            ]);*/

        return response()->json([
                'today_vendor_registrations'    => $today_vendor_registrations,
                'total_vendor_registrations'    => $total_vendor_registrations,

                'today_consumer_registrations'    => $today_consumer_registrations,
                'total_consumer_registrations'    => $total_consumer_registrations,
        ]);
    }
}

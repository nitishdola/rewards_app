<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth, Validator;

class ProfileController extends Controller
{
    public function updateFCM(Request $request) {
        $user = Auth::user();


        $validator = Validator::make($request->all(), [
            'fcm_token' => 'required|string|max:255',
        ],
        [
            'fcm_token.required'   => 'FCM Token is required !',
        ]);
        if ($validator->fails()) {
            return response()->json(['success'=>false,'message'=>$validator->errors()]);
        }

        $user->fcm_token = $request->fcm_token;
        if($user->save()) {
            return response()->json(['success'=>true,'message'=> 'FCM Token updated']);
        }
        return response()->json(['success'=>false,'message'=> 'Plz try again']);
    }


    public function updateFCM(Request $request) {
        $user = Auth::user();


        $validator = Validator::make($request->all(), [
            'longitude' => 'required|string|max:255',
            'latitude' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()]);
        }

        $user->longitude    = $request->longitude;
        $user->latitude     = $request->latitude;
        if($user->save()) {
            return response()->json(['success'=>true,'message'=> 'longitude latitude updated']);
        }
        return response()->json(['success'=>false,'message'=> 'Plz try again']);
    }
}

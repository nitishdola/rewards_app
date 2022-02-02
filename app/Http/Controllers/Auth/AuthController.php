<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Helper;
class AuthController extends Controller
{
    use ApiResponser;

    public function login(Request $request)
    {
        $attr = $request->validate([
            'username' => 'required|string|digits:10',
            'password'      => 'required',
        ]);

        

        if (!Auth::attempt($attr)) {
            /*return $this->error('Credentials not match', 401);*/
            return response()->json([
                'message' => 'Invalid login details'
                           ], 401);
                       
        }
        $token = auth()->user()->createToken('API Token')->plainTextToken;

        if(auth()->user()->user_type == 'AGN') {
            $lifetime_score = 12978;
            return $this->success([
                'username'          => auth()->user()->username,
                'name'              => auth()->user()->name,
                'agent_id'          => auth()->user()->agend_id,
                'token'             => $token,
            ]);
        }else if(auth()->user()->user_type == 'USR') {
            
            return $this->success([
                'token'             => $token,
            ]);
        }
        
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Logout successfully'
        ];
    }
}
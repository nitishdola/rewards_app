<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
class HomeController extends Controller
{

    public function __construct() {
        
    }
    public function dashboard(Request $request) {
        if(!Auth::user()->user_type === 'ADM') return 'ERROR';
        return view('admin.dashboard');
    }

}

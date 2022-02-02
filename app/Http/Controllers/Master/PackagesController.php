<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Redirect, DB, Validator;
use App\Models\Master\Package;
class PackagesController extends Controller
{

    public function index(Request $request) {
        $results = Package::get();
        return view('admin.master.package.index', compact('results'));
    }

    public function create() {
        return view('admin.master.package.create');
    }

    public function store(Request $request) {

        $data = $request->all();

        $validator = Validator::make($data, Package::$rules);
            if ($validator->fails()) return Redirect::back()->withErrors($validator)->withInput();

        if(Package::create($data)) 
            return Redirect::route('admin.package.index')->with(['message' => 'Package added successfully !', 'alert-class' => 'alert-success']);
    }

    public function apiViewAllPackages(Request $request) {
        return Package::select('id','name','threshold_amount')->where('status',1)->get();
    }
}

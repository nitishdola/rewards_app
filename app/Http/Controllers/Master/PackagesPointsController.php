<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Redirect, DB, Validator;
use App\Models\Master\Package;
use App\Models\Master\PackagePoint;
class PackagesPointsController extends Controller
{
    public function index(Request $request) {
        $results = Package::with('points')->get(); //dd($results);
        return view('admin.master.package_points.index', compact('results'));
    }

    public function create() {
        $packages = Package::pluck('name', 'id');
        return view('admin.master.package_points.create', compact('packages'));
    }

    public function store(Request $request) {

        $data = $request->all();

        $validator = Validator::make($data, PackagePoint::$rules);
            if ($validator->fails()) return Redirect::back()->withErrors($validator)->withInput();

        if(PackagePoint::create($data)) 
            return Redirect::route('admin.package_points.index')->with(['message' => 'Package point added successfully !', 'alert-class' => 'alert-success']);
    }
}

@extends('layouts.default')
@section('main_content')
<div class="col-lg-12 mb-4">
    <!-- Simple Tables -->
    <div class="card">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <div class="cil-md-9">
          <h6 class="m-0 font-weight-bold text-primary">Packages Points </h6>
        </div>

        <div class="col-md-3">
          <a class="btn btn-warning btn-sm" href="{{ route('admin.agents.create') }}"> <i class="fas fa-plus-square"></i> ADD NEW AGENT</a>
        </div>
      </div>
		<?php 
			$base_url = str_replace('public', '', url('/'));
			
		
		?>
        <div class="table-responsive">
        <table class="table align-items-center table-flush">
          <thead class="thead-light">
            <tr>
              <th>Name</th>
              <th>Mobile Number</th>
              <th>Email</th>
              <th>City/State</th>
              <th>Profile Photo</th>
              <th>ID Proof</th>
              <th>ID</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($results as $k => $v)
            <tr>
              <td>{{ $v->name }}</td>
              <td>{{ $v->username }}</td>
              <td>{{ $v->email }}</td>
              <td>{{ $v->city }}, {{ $v->state }}</td>
              <td><a target="_blank" href="{{ $base_url.'/storage/app/'.$v->profile_photo_path }}">View</a> </td>
              <td><a target="_blank" href="{{ $base_url.'/storage/app/'.$v->id_proof_path }}">View</a> </td>
              <td>{{ $v->agend_id }}</td>
              <td>
                @if($v->is_active)
                <a href="{{ route('admin.agent.disable', $v->id) }}" class="btn btn-sm btn-danger">Disbale Agent</a>
                @else
                <a href="{{ route('admin.agent.enable', $v->id) }}" class="btn btn-sm btn-success">Enable Agent</a>
                @endif
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="card-footer"></div>
    </div>
  </div>
@stop
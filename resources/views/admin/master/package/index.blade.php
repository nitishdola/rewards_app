@extends('layouts.default')
@section('main_content')
<div class="col-lg-12 mb-4">
    <!-- Simple Tables -->
    <div class="card">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <div class="cil-md-9">
          <h6 class="m-0 font-weight-bold text-primary">Packages</h6>
        </div>

        <div class="col-md-3">
          <a class="btn btn-warning btn-sm" href="{{ route('admin.package.create') }}"> <i class="fas fa-plus-square"></i> CREATE NEW PACKAGE</a>
        </div>
      </div>
      <div class="table-responsive">
        <table class="table align-items-center table-flush">
          <thead class="thead-light">
            <tr>
              <th>Package Name</th>
              <th>Threshold Amount</th>
              <th>Status</th>
              <th>View</th>
            </tr>
          </thead>
          <tbody>
            @foreach($results as $k => $v)
            <tr>
              <td>{{ $v->name }}</td>
              <td>{{ $v->threshold_amount }}</td>
              <td>{{ $v->status ? 'Active': 'Disabled' }}</td>
              <td><a href="{{ route('admin.package_points.index') }}" class="btn btn-sm btn-primary">View Points Table</a></td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="card-footer"></div>
    </div>
  </div>
@stop
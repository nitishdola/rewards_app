@extends('layouts.default')
@section('main_content')
<div class="col-lg-12 mb-4">
    <!-- Simple Tables -->
    <div class="card">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <div class="cil-md-8">
          <h6 class="m-0 font-weight-bold text-primary">Packages Points </h6>
        </div>

        <div class="col-md-4">
          <a class="btn btn-warning btn-sm" href="{{ route('admin.package_points.create') }}"> <i class="fas fa-plus-square"></i> CREATE NEW PACKAGE POINT</a>
        </div>
      </div>
      
        @foreach($results as $k => $v)
        <div class="col-md-12">
          <h7><i>{{ $v->name }}</i></h7>

            @if(count($v->points))
            <div class="col-md-4">
              <br>
              <table class="table table-bordered small-table">
                <thead>
                  <tr>
                    <th>Points</th>
                    <th>Percentage</th>
                  </tr>
                </thead>

                @foreach($v->points as $k1 => $v1)
                <tr>
                  <td>{{ $v1->min_points }} - {{ $v1->max_points }}</td>
                  <td>{{ $v1->percentage }}</td>
                </tr>
                @endforeach
              </table>
          </div>
          @endif
          <hr>
        </div>
        @endforeach
      
      <div class="card-footer"></div>
    </div>
  </div>
@stop
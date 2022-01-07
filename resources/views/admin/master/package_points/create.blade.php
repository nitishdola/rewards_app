@extends('layouts.default')
@section('main_content')

<div class="col-lg-12">
  <!-- Form Basic -->
    <div class="card-header py-4 d-flex flex-row align-items-center justify-content-between">
      <h8 class="m-0 font-weight-bold text-primary">Package Point</h8>
    </div>
    <div class="card-body">
      	@if ($errors->any())
	            {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
	    @endif
	    
	    {!! Form::open(array('route' => 'admin.package_points.store',  'id' => 'admin.package_points.store', 'class' => 'form-horizontal bucket-form')) !!}

      	@include('admin.master.package_points._form')
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>
@stop
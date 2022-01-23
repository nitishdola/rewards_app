@extends('layouts.default')
@section('main_content')

<div class="col-lg-12">
  <!-- Form Basic -->
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary">Add New Agent</h6>
    </div>
    <div class="card-body">
      	@if ($errors->any())
	            {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
	    @endif
	    
	    {!! Form::open(array('route' => 'admin.agents.store', 'files' => true, 'id' => 'admin.agents.store', 'class' => 'form-horizontal bucket-form')) !!}

      	@include('admin.master.agents._form')
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>
@stop
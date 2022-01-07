<div class="form-group {{ $errors->has('package_id') ? 'has-error' : ''}}">
    {!! Form::label('Select Package', '', array('class' => 'col-md-3 control-label')) !!}
    <div class="col-md-5">
      {!! Form::select('package_id', $packages, null, ['class' => 'form-control', 'id' => 'package_id', 'placeholder' => 'Select Package', 'autocomplete' => 'off', 'required' => 'true']) !!}
    </div>
    {!! $errors->first('package_id', '<span class="help-inline">:message</span>') !!}
</div>


<div class="form-group {{ $errors->has('min_points') ? 'has-error' : ''}}">
    {!! Form::label('min_points', '', array('class' => 'col-md-3 control-label')) !!}
    <div class="col-md-5">
      {!! Form::number('min_points', null, ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'Min. Point', 'autocomplete' => 'off', 'required' => 'true']) !!}
    </div>
    {!! $errors->first('min_points', '<span class="help-inline">:message</span>') !!}
</div>


<div class="form-group {{ $errors->has('max_points') ? 'has-error' : ''}}">
    {!! Form::label('max_points', '', array('class' => 'col-md-3 control-label')) !!}
    <div class="col-md-5">
      {!! Form::number('max_points', null, ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'Max. Point', 'autocomplete' => 'off', 'required' => 'true']) !!}
    </div>
    {!! $errors->first('max_points', '<span class="help-inline">:message</span>') !!}
</div>


<div class="form-group {{ $errors->has('percentage') ? 'has-error' : ''}}">
    {!! Form::label('percentage', '', array('class' => 'col-md-3 control-label')) !!}
    <div class="col-md-5">
      {!! Form::number('percentage', null, ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'Percentage', 'autocomplete' => 'off', 'required' => 'true']) !!}
    </div>
    {!! $errors->first('percentage', '<span class="help-inline">:message</span>') !!}
</div>
<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    {!! Form::label('Package Name', '', array('class' => 'col-md-3 control-label')) !!}
    <div class="col-md-5">
      {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name', 'placeholder' => ' Package Name', 'autocomplete' => 'off', 'required' => 'true']) !!}
    </div>
    {!! $errors->first('name', '<span class="help-inline">:message</span>') !!}
</div>


<div class="form-group {{ $errors->has('threshold_amount') ? 'has-error' : ''}}">
    {!! Form::label('threshold_amount', '', array('class' => 'col-md-3 control-label')) !!}
    <div class="col-md-5">
      {!! Form::number('threshold_amount', null, ['class' => 'form-control', 'id' => 'name', 'placeholder' => ' Threshold Amount', 'autocomplete' => 'off', 'required' => 'true']) !!}
    </div>
    {!! $errors->first('threshold_amount', '<span class="help-inline">:message</span>') !!}
</div>
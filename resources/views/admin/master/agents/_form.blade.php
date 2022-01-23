<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    {!! Form::label('Agent Name', '', array('class' => 'col-md-3 control-label')) !!}
    <div class="col-md-5">
      {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name', 'placeholder' => ' Agent Name', 'autocomplete' => 'off', 'required' => 'true']) !!}
    </div>
    {!! $errors->first('name', '<span class="help-inline">:message</span>') !!}
</div>


<div class="form-group {{ $errors->has('username') ? 'has-error' : ''}}">
    {!! Form::label('mobile_number', '', array('class' => 'col-md-3 control-label')) !!}
    <div class="col-md-5">
      {!! Form::text('username', null, ['class' => 'form-control', 'id' => 'mobile_number', 'placeholder' => 'Mobile Number', 'autocomplete' => 'off', 'required' => 'true']) !!}
    </div>
    {!! $errors->first('username', '<span class="help-inline">:message</span>') !!}
</div>


<div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
    {!! Form::label('email', '', array('class' => 'col-md-3 control-label')) !!}
    <div class="col-md-5">
      {!! Form::email('email', null, ['class' => 'form-control', 'id' => 'mobile_number', 'placeholder' => 'Email ID', 'autocomplete' => 'off', 'required' => 'true']) !!}
    </div>
    {!! $errors->first('email', '<span class="help-inline">:message</span>') !!}
</div>


<div class="form-group {{ $errors->has('profile_photo_path') ? 'has-error' : ''}}">
    {!! Form::label('profile_photo_path', '', array('class' => 'col-md-3 control-label')) !!}
    <div class="col-md-5">
      <input type="file" name="profile_photo">
    </div>
    {!! $errors->first('profile_photo_path', '<span class="help-inline">:message</span>') !!}
</div>


<div class="form-group {{ $errors->has('id_proof_path') ? 'has-error' : ''}}">
    {!! Form::label('ID_proof_path', '', array('class' => 'col-md-3 control-label')) !!}
    <div class="col-md-5">
      <input type="file" name="id_proof">
    </div>
    {!! $errors->first('id_proof_path', '<span class="help-inline">:message</span>') !!}
</div>

<div class="form-group {{ $errors->has('state') ? 'has-error' : ''}}">
    {!! Form::label('state', '', array('class' => 'col-md-3 control-label')) !!}
    <div class="col-md-5">
      {!! Form::text('state', null, ['class' => 'form-control', 'id' => 'mobile_number', 'placeholder' => 'State', 'autocomplete' => 'off', 'required' => 'true']) !!}
    </div>
    {!! $errors->first('state', '<span class="help-inline">:message</span>') !!}
</div>


<div class="form-group {{ $errors->has('city') ? 'has-error' : ''}}">
    {!! Form::label('city', '', array('class' => 'col-md-3 control-label')) !!}
    <div class="col-md-5">
      {!! Form::text('city', null, ['class' => 'form-control', 'id' => 'mobile_number', 'placeholder' => 'City', 'autocomplete' => 'off', 'required' => 'true']) !!}
    </div>
    {!! $errors->first('city', '<span class="help-inline">:message</span>') !!}
</div>

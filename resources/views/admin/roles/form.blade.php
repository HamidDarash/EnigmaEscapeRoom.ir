<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">

    <div class="col-md-12">
        {!! Form::label('name', 'نام دسترسی', ['class' => 'control-label']) !!}
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'ایجاد دسترسی', ['class' => 'btn btn-primary btn-block']) !!}
    </div>
</div>

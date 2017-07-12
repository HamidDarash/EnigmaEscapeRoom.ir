<div class="form-group {{ $errors->has('header') ? 'has-error' : ''}}">
    {!! Form::label('header', 'سرتیتر پست یا خبر', ['class' => 'col-md-12 control-label']) !!}
    <div class="col-md-12">
        {!! Form::text('header', null, ['class' => 'form-control']) !!}
        {!! $errors->first('header', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('content') ? 'has-error' : ''}}">
    {!! Form::label('content', 'متن', ['class' => 'col-md-12 control-label']) !!}
    <div class="col-md-12">
        {!! Form::textarea('content', null, ['class' => 'form-control']) !!}
        {!! $errors->first('content', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('activate') ? 'has-error' : ''}}">
    {!! Form::label('activate', 'نمایش/مخفی', ['class' => 'col-md-12 control-label']) !!}
    <div class="col-md-12">
        <div class="checkbox">
    <label>{!! Form::radio('activate', '1') !!} نمایش</label>
</div>
<div class="checkbox">
    <label>{!! Form::radio('activate', '0', true) !!} مخفی</label>
</div>
        {!! $errors->first('activate', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-6">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'ایجاد', ['class' => 'btn btn-primary']) !!}
    </div>
</div>

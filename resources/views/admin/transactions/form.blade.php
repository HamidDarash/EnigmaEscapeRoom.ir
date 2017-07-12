<div class="form-group {{ $errors->has('port') ? 'has-error' : ''}}">
    {!! Form::label('port', 'Port', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('port', null, ['class' => 'form-control']) !!}
        {!! $errors->first('port', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('price') ? 'has-error' : ''}}">
    {!! Form::label('price', 'Price', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('price', null, ['class' => 'form-control']) !!}
        {!! $errors->first('price', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('ref_id') ? 'has-error' : ''}}">
    {!! Form::label('ref_id', 'Ref Id', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('ref_id', null, ['class' => 'form-control']) !!}
        {!! $errors->first('ref_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('tracking_code') ? 'has-error' : ''}}">
    {!! Form::label('tracking_code', 'Tracking Code', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('tracking_code', null, ['class' => 'form-control']) !!}
        {!! $errors->first('tracking_code', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('card_number') ? 'has-error' : ''}}">
    {!! Form::label('card_number', 'Card Number', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('card_number', null, ['class' => 'form-control']) !!}
        {!! $errors->first('card_number', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
    {!! Form::label('status', 'Status', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('status', ['INIT', 'SUCCEED', 'FAILED'], null, ['class' => 'form-control']) !!}
        {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('ip') ? 'has-error' : ''}}">
    {!! Form::label('ip', 'Ip', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('ip', null, ['class' => 'form-control']) !!}
        {!! $errors->first('ip', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('payment_date') ? 'has-error' : ''}}">
    {!! Form::label('payment_date', 'Payment Date', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::date('payment_date', null, ['class' => 'form-control']) !!}
        {!! $errors->first('payment_date', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>

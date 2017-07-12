<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <div class="col-md-12">
        {!! Form::label('name', 'نام بازی', ['class' => 'control-label']) !!}
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
        {!! $errors->first('name', '<p class="help-block">نام بازی را وارد کنید</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('quick-information') ? 'has-error' : ''}}">
    <div class="col-md-12">
        {!! Form::label('quick-information', 'خلاصه بازی', ['class' => 'control-label']) !!}
        {!! Form::textarea('quick-information', null, ['class' => 'form-control']) !!}
        {!! $errors->first('quick-information', '<p class="help-block">خلاصه داستان را وارد کنید</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('information') ? 'has-error' : ''}}">
    <div class="col-md-12">
        {!! Form::label('information', 'توضیحات بازی', ['class' => 'control-label']) !!}
        {!! Form::textarea('information', null, ['class' => 'form-control']) !!}
        {!! $errors->first('information', '<p class="help-block">داستان کامل گیم را وارد کنید</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('price') ? 'has-error' : ''}}">
    <div class="col-md-12">
        {!! Form::label('price', 'قیمت بازی', ['class' => 'control-label']) !!}
        {!! Form::text('price', null, ['class' => 'form-control']) !!}
        {!! $errors->first('price', '<p class="help-block">قیمت هر نفر را وارد کنید</p>') !!}
    </div>

</div>

<div class="form-group {{ $errors->has('minutes') ? 'has-error' : ''}}">
    <div class="col-md-12">
        {!! Form::label('minutes', 'مدت زمان بازی', ['class' => 'control-label']) !!}
        {!! Form::text('minutes', null, ['class' => 'form-control']) !!}
        {!! $errors->first('minutes', '<p class="help-block">مدت زمان بازی را وارد کنید</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('minutesforuser') ? 'has-error' : ''}}">
    <div class="col-md-12">
        {!! Form::label('minutesforuser', 'نمایش زمان بازی برای کاربر', ['class' => 'control-label']) !!}
        {!! Form::text('minutesforuser', null, ['class' => 'form-control']) !!}
        {!! $errors->first('minutes', '<p class="help-block">مدت زمان بازی برای نمایش به کاربر را وارد کنید</p>') !!}
    </div>
</div>


<div class="form-group {{ $errors->has('activate') ? 'has-error' : ''}}">
    <div class="col-md-12">
        {!! Form::label('activate', 'فعالسازی', ['class' => 'control-label']) !!}
        @if(isset($game))
            <div class="checkbox">
                <label>{!! Form::radio('activate', '1') !!} فعال</label>
            </div>
            <div class="checkbox">
                <label>{!! Form::radio('activate', '0', true) !!} غیر فعال</label>
            </div>
        @else
            <div class="checkbox">
                <label>{!! Form::radio('activate', '1',true) !!} فعال</label>
                <label>{!! Form::radio('activate', '0') !!} غیر فعال</label>
            </div>
        @endif
    </div>
</div>
<div class="form-group {{ $errors->has('arraycount') ? 'has-error' : ''}}">
    <div class="col-md-12">
        {!! Form::label('arraycount', 'تعداد مجاز بازی کننده', ['class' => 'control-label']) !!}
        {!! Form::text('arraycount', null, ['class' => 'form-control text-left','style'=>'direction:ltr;']) !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'ایجاد بازی', ['class' => 'btn btn-primary btn-block']) !!}
    </div>
</div>

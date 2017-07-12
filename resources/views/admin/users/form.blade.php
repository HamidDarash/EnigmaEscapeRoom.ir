<div class="form-group">
    <div class="col-md-6 {{ $errors->has('name') ? 'has-error' : ''}}">
        {!! Form::label('name', 'نام', ['class' => 'control-label']) !!}
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="col-md-6 {{ $errors->has('family') ? 'has-error' : ''}}">
        {!! Form::label('family', 'نام خانوادگی', ['class' => 'control-label']) !!}
        {!! Form::text('family', null, ['class' => 'form-control']) !!}
        {!! $errors->first('family', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group ">
    <div class="col-md-6 {{ $errors->has('email') ? 'has-error' : ''}}">
        {!! Form::label('email', 'ادرس ایمیل', ['class' => 'control-label']) !!}
        {!! Form::text('email', null, ['class' => 'form-control']) !!}
        {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="col-md-6 {{ $errors->has('password') ? 'has-error' : ''}}">
        {!! Form::label('password', 'کلمه عبور', ['class' => 'control-label']) !!}
        <input name="password" type="password" class="form-control" id="password"/>
        {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
    </div>

</div>

<div class="form-group">
    <div class="col-md-6 {{ $errors->has('telephone') ? 'has-error' : ''}}">
        {!! Form::label('telephone', 'تلفن ثابت', ['class' => 'control-label']) !!}
        {!! Form::text('telephone', null, ['class' => 'form-control','style'=>'direction:ltr','placeholder'=>'02144444444']) !!}
        {!! $errors->first('telephone', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="col-md-6 {{ $errors->has('mobile') ? 'has-error' : ''}}">
        {!! Form::label('mobile', 'تلفن همراه', ['class' => 'control-label']) !!}
        {!! Form::text('mobile', null, ['class' => 'form-control','style'=>'direction:ltr','placeholder'=>'09121111111']) !!}
        {!! $errors->first('mobile', '<p class="help-block">:message</p>') !!}
    </div>
</div>


<div class="form-group {{ $errors->has('address') ? 'has-error' : ''}}">
    <div class="col-md-12">
        {!! Form::label('address', 'آدرس', ['class' => 'control-label']) !!}
        {!! Form::textarea('address', null, ['class' => 'form-control','placeholder'=>'ادرس']) !!}
        {!! $errors->first('address', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-6 {{ $errors->has('code_melli') ? 'has-error' : ''}}">
        {!! Form::label('code_melli', 'شماره ملی', ['class' => 'control-label']) !!}
        {!! Form::text('code_melli', null, ['class' => 'form-control','maxlength'=>'10','style'=>'direction:ltr','placeholder'=>'000-00000-00']) !!}
        {!! $errors->first('code_melli', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="col-md-6 {{ $errors->has('zip_code') ? 'has-error' : ''}}">
        {!! Form::label('zip_code', 'Zip Code', ['class' => 'control-label']) !!}
        {!! Form::text('zip_code', null, ['class' => 'form-control','style' =>'direction:ltr;','maxlength'=>'16','placeholder'=>'00000-00000']) !!}
        {!! $errors->first('zip_code', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-12 {{ $errors->has('city') ? 'has-error' : ''}}">
        {!! Form::label('province', 'استان', ['class' => 'control-label']) !!}
        <select class="province form-control" id="province" name="province"></select>
        {!! $errors->first('province', '<p class="help-block">:message</p>') !!}
        {!! Form::label('city', 'شهر', ['class' => 'control-label']) !!}
        <select class="city form-control" id="city" name="city"> </select>
        {!! $errors->first('city', '<p class="help-block">:message</p>') !!}
    </div>

</div>


<div class="form-group {{ $errors->has('bank_account_number') ? 'has-error' : ''}}">
    <div class="col-md-12">
        {!! Form::label('bank_account_number', 'شماره کارت بانک', ['class' => 'control-label']) !!}
        {!! Form::text('bank_account_number', null, ['class' => 'form-control','style' =>'direction:ltr;','maxlength'=>'16','placeholder'=>'0000-0000-0000-0000']) !!}
        {!! $errors->first('bank_account_number', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-12">
        {!! Form::label('roles', 'سطح دسترسی', ['class' => 'control-label']) !!}
        <select id="id_label_multiple"
                class="js-example-basic-multiple js-states select2-hidden-accessible form-control" multiple="multiple"
                name="roles[]" id="sports">
            {{-- check edit or add --}}

            {!! $select = '' !!}
            @if(!empty($user))
                @foreach($roles as $aKey => $aRole)
                    @foreach($user->roles as $rkey => $rRole)
                        @if($aRole->id === $rRole->id)
                            <?php $select = 'selected' ?>
                        @endif
                    @endforeach
                    {{--{{$aRole->name}}--}}
                    <option value="{{$aRole->id}}" {{ $select }}>{{ $aRole->name }}</option>
                    <?php $select = '' ?>
                @endforeach
            @else
                @foreach($roles as $aRole)
                    <option value="{{$aRole->id}}">{{$aRole->name}}</option>
                @endforeach
            @endif
        </select>
    </div>
</div>

<div class="form-group">
    <div class="col-md-3">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'ایجاد', ['class' => 'btn btn-primary btn-block']) !!}
    </div>
</div>

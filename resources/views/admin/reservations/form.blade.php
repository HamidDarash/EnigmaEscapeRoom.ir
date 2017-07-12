<div class="form-group">
    <div class="col-md-6 {{ $errors->has('user_id') ? 'has-error' : ''}}">
        {!! Form::label('user_id', 'کاربر مورد نظر', ['class' => 'col-md-12 text-right']) !!}
        @if(isset($usersAll) && !empty($usersAll))
            <select name="user_id" class="form-control">
                @foreach($usersAll as $u)
                    <option value="{{ $u->id }}">{{ $u->email }}
                        --- {{ $u->name }} {{ $u->family }}</option>
                @endforeach
            </select>
        @endif

        @if(isset($reservation) && !empty($reservation))
            <select name="user_id" class="form-control">
                <option value="{{ $userSelect->id }}" selected>{{ $userSelect->email }}
                    --- {{ $userSelect->name }} {{ $userSelect->family }}</option>
            </select>
        @endif
        {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="col-md-6 {{ $errors->has('game_id') ? 'has-error' : ''}}">
        {!! Form::label('game_id', 'بازی مورد نظر', ['class' => 'col-md-12 text-right']) !!}

        @if( isset($gamesAll) && !empty($gamesAll))
            <select id="game_id" name="game_id" class="form-control" value="">
                @foreach($gamesAll as $g)
                    <option price-data="{{ $g->price }}" value="{{ $g->id }}">{{ $g->name }}</option>
                @endforeach
            </select>
        @endif


        @if(isset($reservation) && !empty($reservation))
            <select name="game_id" class="form-control disabled">
                <option value="{{ $gameSelect->id }}" selected>{{ $gameSelect->name }}</option>
            </select>

        @endif
        {!! $errors->first('game_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group">
    <div class="col-md-6 {{ $errors->has('date_reserved') ? 'has-error' : ''}}">
        {!! Form::label('dateReserve', 'انتخاب تاریخ', ['class' => 'col-md-12 control-label']) !!}
        {!! Form::text('dateReserve', null, ['class' => 'form-control','id' => 'datePicker']) !!}
        {!! $errors->first('dateReserve', '<p class="help-block">:message</p>') !!}
        <input type="hidden" id="date_reserved" name="date_reserved" value="" />
    </div>
    <div class="col-md-6 {{ $errors->has('time_reserved') ? 'has-error' : ''}}">
        {!! Form::label('time_reserved', 'انتخاب ساعت', ['class' => 'col-md-12 control-label']) !!}
        <div class="" id="time_reserved_holder">
            <p>لطفا تاریخ را انتخاب کنید</p>
        </div>
        {!! $errors->first('time_reserved', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<hr />
<div class="form-group">
    <div class="col-md-6 {{ $errors->has('activate') ? 'has-error' : ''}}">
        {!! Form::label('activate', 'وضعیت فعالسازی', ['class' => 'col-md-6']) !!}
        <div class="checkbox">
            <label>{!! Form::radio('activate', '1') !!} فعال</label>
            <label>{!! Form::radio('activate', '0', true) !!} غیر فعال</label>
        </div>
        {!! $errors->first('activate', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="col-md-6 {{ $errors->has('canceled') ? 'has-error' : ''}}">
        {!! Form::label('canceled', 'وضعیت کنسلی', ['class' => 'col-md-6']) !!}
        <div class="checkbox">
            <label>{!! Form::radio('canceled', '1') !!} فعال</label>
            <label>{!! Form::radio('canceled', '0', true) !!} غیر فعال</label>
        </div>
        {!! $errors->first('canceled', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
    {!! Form::label('description', 'توضیحات', ['class' => 'col-md-12 ']) !!}
    <div class="col-md-12">
        {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
        {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('person_count') ? 'has-error' : ''}}">
    {!! Form::label('person_count', 'تعداد نفرات', ['class' => 'col-md-12 control-label']) !!}
    <div class="col-md-12">
        {!! Form::number('person_count', null, ['class' => 'form-control']) !!}
        {!! $errors->first('person_count', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <label for="price">نرخ بازی برای هر نفر</label>
    <div class="col-md-11"><input  type="text" class="form-control" name="price" id="gamePrice" disabled/></div>
    <div class="col-md-1"> ريال </div>
</div>

<div class="form-group {{ $errors->has('sum_price') ? 'has-error' : ''}}">
    {!! Form::label('sum_price', 'جمع پرداختی', ['class' => 'col-md-12 control-label']) !!}
    <div class="col-md-12">
        {!! Form::text('sum_price', null, ['class' => 'form-control']) !!}
        {!! $errors->first('sum_price', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'رزرو شود', ['class' => 'btn btn-primary']) !!}
    </div>
</div>

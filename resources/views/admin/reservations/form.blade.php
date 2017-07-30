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
            <select name="user_id" class="form-control" disabled>
                <option value="{{ $userSelect->id }}" selected>{{ $userSelect->email }}
                    --- {{ $userSelect->name }} {{ $userSelect->family }}</option>
            </select>
        @endif
        {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="col-md-6 {{ $errors->has('game_id') ? 'has-error' : ''}}">
 
        @if(isset($gameSelect))
            <label for="game_id" class='col-md-12 text-right'>بازی انتخاب شده <span class="label label-info"> {{ $gameSelect->name }} </span>  می باشد </label>

        @else
            <label for="game_id" class='col-md-12 text-right'> بازی مورد نظر را انتخاب کنید </label>

        @endif
 
        @if( isset($gamesAll) && !empty($gamesAll))
            
            <select id="game_id" name="game_id" class="form-control" value="">
                @foreach($gamesAll as $g)
                    <option price-data="{{ $g->arraycount }}" value="{{ $g->id }}">{{ $g->name }}</option>
                @endforeach
            </select>
        @endif

        {!! $errors->first('game_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group">
    <div class="col-md-6 {{ $errors->has('date_reserved') ? 'has-error' : ''}}">
        {!! Form::label('dateReserve', 'انتخاب تاریخ', ['class' => 'col-md-12 control-label']) !!}
        
        @if(isset($reservation) && !empty($reservation))
          {!! Form::text('dateReserve', $reservation->date_reserved , ['class' => 'form-control','id' => 'datePicker']) !!}
        @else
          {!! Form::text('dateReserve', null, ['class' => 'form-control','id' => 'datePicker']) !!}
        @endif
       
        
        {!! $errors->first('dateReserve', '<p class="help-block">:message</p>') !!}
        
        {{ Form::hidden('date_reserved', null , array('id' => 'date_reserved')) }}
        
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
    <div class="col-md-4 {{ $errors->has('activate') ? 'has-error' : ''}}">
        {!! Form::label('activate', 'وضعیت فعالسازی', ['class' => 'col-md-6 label-info']) !!}
        <br/>
        <div class="checkbox">
            <label>{!! Form::radio('activate', '1') !!} فعال</label>
            <label>{!! Form::radio('activate', '0', true) !!} غیر فعال</label>
        </div>
        {!! $errors->first('activate', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="col-md-4 {{ $errors->has('canceled') ? 'has-error' : ''}}">
        {!! Form::label('canceled', 'وضعیت کنسلی', ['class' => 'col-md-6 label-danger']) !!}
        <br/>
        <div class="checkbox">
            <label>{!! Form::radio('canceled', '1') !!} فعال</label>
            <label>{!! Form::radio('canceled', '0', true) !!} غیر فعال</label>
        </div>
        {!! $errors->first('canceled', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="col-md-4 {{ $errors->has('law_ok') ? 'has-error' : ''}}">
        {!! Form::label('law_ok', 'قبول قوانین سایت', ['class' => 'col-md-6 label-info']) !!}<br/>
        <div class="checkbox">
            <label>{!! Form::radio('law_ok', '1') !!} قبول </label>
            <label>{!! Form::radio('law_ok', '0', true) !!} غیر قابل قبول </label>
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
         <select name="person_count" id="person_count" class="form-control"></select>
        
        {!! $errors->first('person_count', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<!--<div class="form-group">-->
<!--    <label for="price">نرخ بازی برای هر نفر</label>-->
<!--    <div class="col-md-11"><input  type="text" class="form-control" name="price" id="gamePrice" disabled/></div>-->
<!--    <div class="col-md-1"> ريال </div>-->
<!--</div>-->

<div class="form-group {{ $errors->has('sum_price') ? 'has-error' : ''}}">
    {!! Form::label('sum_price', 'جمع پرداختی', ['class' => 'col-md-12 control-label']) !!}
    <div class="col-md-11">
          {!! Form::text('sum_price', null, ['class' => 'form-control','id'=>'sum_price']) !!}
        {!! $errors->first('sum_price', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="col-md-1">ريال</div>
    </div>
<div class="form-group">
    <div class="col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'رزرو شود', ['class' => 'btn btn-primary']) !!}
    </div>
</div>

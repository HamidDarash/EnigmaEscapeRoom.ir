<div class="form-group {{ $errors->has('type') ? 'has-error' : ''}}">

    {!! Form::label('type', 'نوع', ['class' => 'col-md-12 control-label']) !!}
    <div class="col-md-12">
        {{--{!! Form::text('type', null, ['class' => 'form-control']) !!}--}}
        <select name="type" class="form-control">
            <option value="0">جوامع مجازی</option>
        </select>
        {!! $errors->first('type', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('key') ? 'has-error' : ''}}">
    {!! Form::label('key', 'کلید', ['class' => 'col-md-12 control-label']) !!}
    <div class="col-md-12">
        {!! Form::text('key', null, ['class' => 'form-control']) !!}
        {!! $errors->first('key', '<p class="help-block">:message</p>') !!}
        <div class="icons-soceial">
            <span class="fa fa-bitbucket fa-2x" title="fa fa-bitbucket"></span>
            <span class="fa fa-digg fa-2x" title="fa fa-digg"></span>
            <span class="fa fa-dropbox fa-2x" title="fa fa-dropbox"></span>
            <span class="fa fa-facebook fa-2x" title="fa fa-facebook "></span>
            <span class="fa fa-flickr fa-2x" title="fa fa-flickr"></span>
            <span class="fa fa-foursquare fa-2x" title="fa fa-foursquare"></span>
            <span class="fa fa-github fa-2x" title="fa fa-github"></span>
            <span class="fa fa-google fa-2x" title="fa fa-google"></span>
            <span class="fa fa-google-plus fa-2x" title="fa fa-google-plus"></span>
            <span class="fa fa-instagram fa-2x" title="fa fa-instagram"></span>
            <span class="fa fa-jsfiddle fa-2x" title="fa fa-jsfiddle"></span>
            <span class="fa fa-linkedin fa-2x" title="fa fa-linkedin"></span>
            <span class="fa fa-pinterest fa-2x" title="fa fa-pinterest"></span>
            <span class="fa fa-reddit fa-2x" title="fa fa-reddit"></span>
            <span class="fa fa-skype fa-2x" title="fa fa-skype"></span>
            <span class="fa fa-soundcloud fa-2x" title="fa fa-soundcloud"></span>
            <span class="fa fa-spotify fa-2x" title="fa fa-spotify"></span>
            <span class="fa fa-stack-exchange fa-2x" title="fa fa-stack-exchange"></span>
            <span class="fa fa-stack-overflow fa-2x" title="fa fa-stack-overflow"></span>
            <span class="fa fa-steam fa-2x" title="fa fa-steam"></span>
            <span class="fa fa-stumbleupon fa-2x" title="fa fa-stumbleupon"></span>
            <span class="fa fa-tumblr fa-2x" title="fa fa-tumblr"></span>
            <span class="fa fa-twitter fa-2x" title="fa fa-twitter"></span>
            <span class="fa fa-vimeo-square fa-2x" title="fa fa-vimeo-square"></span>
            <span class="fa fa-vine fa-2x" title="fa fa-vine"></span>
            <span class="fa fa-windows fa-2x" title="fa fa-windows"></span>
            <span class="fa fa-wordpress fa-2x" title="fa fa-wordpress"></span>
            <span class="fa fa-yahoo fa-2x" title="fa fa-yahoo"></span>
            <span class="fa fa-youtube fa-2x" title="fa fa-youtube"></span>
        </div>
    </div>
</div><div class="form-group {{ $errors->has('value') ? 'has-error' : ''}}">
    {!! Form::label('value', 'مقدار', ['class' => 'col-md-12 control-label']) !!}
    <div class="col-md-12">
        {!! Form::text('value', null, ['class' => 'form-control']) !!}
        {!! $errors->first('value', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-6">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'ساخت', ['class' => 'btn btn-primary']) !!}
    </div>
</div>

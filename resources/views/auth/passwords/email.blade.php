@extends('layouts.layoutReset')

<!-- Main Content -->
@section('reset')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <h1>ایمیل خورد را وارد کنید</h1>
    <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
        {{ csrf_field() }}

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="email" class="col-md-12 control-label">آدرس ایمیل</label>
            <div class="col-md-12">
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

                @if ($errors->has('email'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                @endif
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-btn fa-envelope"></i> ارسال لینک بازآوری کلمه عبور
                </button>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <a class="btn btn-default" href="{{ url('/') }}">بازگشت</a>
            </div>
        </div>
    </form>
@endsection

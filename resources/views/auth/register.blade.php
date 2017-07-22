<h1 style="margin-bottom: 30px;" class="text-right">فرم ثبت نام</h1>
<form id="form-register" class="form-horizontal" style="padding: 35px;margin: 10px" role="form" method="POST"
      action="{{ url('/register') }}">
    {{ csrf_field() }}
    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label for="name" class="col-md-12 control-label">نام</label>
        <div class="col-md-12">
            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}">
            <div id="nameError" class="err alert alert-danger hidden text-right">
            </div>
        </div>
    </div>

    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <label for="email" class="col-md-12 control-label">ایمیل</label>
        <div class="col-md-12">
            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">
            <div id="emailError" class="err alert alert-danger hidden text-right">

            </div>
        </div>
    </div>
    <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
        <label for="name" class="col-md-12 control-label">موبایل</label>
        <div class="col-md-12">
            <input id="mobile" type="text" class="form-control" name="mobile" value="{{ old('mobile') }}" maxlength="11" minlength="11">
            <div id="mobileError" class="err hidden alert alert-danger text-right">

            </div>
        </div>
    </div>
    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
        <label for="password" class="col-md-12 control-label">کلمه عبور</label>

        <div class="col-md-12">
            <input id="password" type="password" class="form-control" name="password">
            <div id="passwordError" class="err hidden alert alert-danger text-right">

            </div>
        </div>

    </div>
    </div>

    <div class="hidden form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
        <label for="password-confirm" class="col-md-4 control-label">تکرار کلمه عبور</label>

        <div class="col-md-6">
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation">

            @if ($errors->has('password_confirmation'))
                <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
            @endif
        </div>
    </div>
     

    <div class="form-group">
        <div class="col-md-6">
            <button type="button" id="click-register" class="btn btn-primary btn-block">
                <i class="fa fa-btn fa-user"></i> ثبت نام
            </button>
        </div>
        <div class="col-md-6">
            <a href="#" class="btn btn-link" id="ifRegistered" data-dismiss="modal">چنانچه قبلا ثبت نام نموده اید به فرم لاگین منتقل شوید</a>
        </div>
    </div>
</form>



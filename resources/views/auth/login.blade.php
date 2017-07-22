<h1 class="text-right">فرم ورود</h1>
<form id="login-ajax" class="form-horizontal" role="form" method="POST" action="#">
    {{ csrf_field() }}
    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <label for="email" class="col-md-12 control-label text-right">آدرس ایمیل</label>

        <div class="col-md-12">
            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

        </div>
    </div>
    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
        <label for="password" class="col-md-12 control-label text-right">کلمه عبور</label>

        <div class="col-md-12">
            <input id="password" type="password" class="form-control" name="password">
        </div>
    </div>
    <div class="form-group hidden">
        <div class="col-md-12 text-right">
            <div class="checkbox">
                <label>
                    <input  type="checkbox" name="remember" checked> مرا بخاطر بسپار
                </label>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-6">
            <button id="click-login" type="button" class="btn btn-primary btn-block">
                <i class="fa fa-btn fa-sign-in"></i> ورود
            </button>
            
        </div>
        <div class="col-md-6">
            <a class="btn btn-link" href="{{ url('/password/reset') }}">کلمه عبور خود را فراموش کردید؟</a>
        </div>    
    </div>
    <div id="error-holder" class="form-group hidden">
        <div id="error" class="alert alert-danger">
        </div>
    </div>
</form>



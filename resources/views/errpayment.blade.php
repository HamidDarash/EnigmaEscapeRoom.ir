<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="/css/theme/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="//cdn.rawgit.com/morteza/bootstrap-rtl/v3.3.4/dist/css/bootstrap-rtl.min.css">
    <link href="/css/theme/freelancer.css" rel="stylesheet">
    <title> {{ config('app.name', 'Laravel') }}</title>
</head>
<body>
<div class="container container-fluid">

    <div class="col-md-4"></div>
    <div class="col-md-4 center-block" style="margin-top: 20px">
        <div class="alert alert-danger">
            <h1>پرداخت ناموفق</h1>
            <span class="fa fa-warning"></span> <span>{{ $errorMessage != null ? $errorMessage : '' }}</span>
        </div>
        <a class="btn btn-lg btn-block btn-success" href="{{ url('/') }}">بازگشت به سایت</a>
    </div>
    <div class="col-md-4"></div>

</div>
</body>
</html>

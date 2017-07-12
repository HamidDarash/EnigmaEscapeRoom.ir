<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="/css/theme/bootstrap.min.css" rel="stylesheet">
    <link href="/css/reservationTable.css" rel="stylesheet">
    <link href="/css/slider/responsiveslides.css" rel="stylesheet">
    <link href="/css/slider/theme_slider.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="//cdn.rawgit.com/morteza/bootstrap-rtl/v3.3.4/dist/css/bootstrap-rtl.min.css">
    <link href="/css/theme/freelancer.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/jquery.toast.min.css">


    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body id="page-top" class="index">


<div class="loading">
    <div class="circle"></div>
</div>
<div id="skipnav"><a href="#maincontent"></a></div>

<!-- Navigation -->
<nav id="mainNav" class="navbar navbar-default navbar-fixed-top navbar-custom affix">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header page-scroll">
            <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span> <i class="fa fa-bars fa-2x"></i>
            </button>
            <a class="navbar-brand" style="margin-left: 20px"
               href="{{ url('/') }}"><img style="margin-top: -19px;" src="{{ asset('img/logo-site-2.png') }}"/>
            </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li class="page-scroll active">
                    <a href="#home"><span class="fa fa-home"></span> خانه</a>
                </li>
                @if(isset($posts) && count($posts)>0)
                    <li class="page-scroll">
                        <a href="#news"><span class="fa fa-newspaper-o"></span> اخبار</a>
                    </li>
                @endif
                <li class="page-scroll">
                    <a href="#about"><span class="fa fa-info-circle"></span> درباره ما</a>
                </li>
                <li class="page-scroll">
                    <a href="#games"><span class="fa fa-gamepad"></span> بازی ها</a>
                </li>
                @if(isset($games))
                    <li class="page-scroll">
                        <a href="#reserved">رزرو بازی</a>
                    </li>
                @endif
                <li class="page-scroll">
                    <a href="#maps_google"><span class="fa fa-map"></span> آدرس ما</a>
                </li>


            </ul>
            <ul class="nav navbar-nav navbar-left">
                @if(!Auth::check())
                    <li id="login-menu-item" class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">ورود / ثبت نام
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a id="login-form-load" href="#">ورود</a></li>
                            <li><a id="register-form-load" href="#">ثبت نام</a></li>
                        </ul>
                    </li>
                @else
                    <li id="logined-menu-item" class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown"
                           href="#">
                            @if(Auth::User()->avatar)
                                <img class="img-circle" src="{{ asset('img/users/').'/'.Auth::User()->avatar }}"
                                     width="32" height="32"/>
                            @else
                                <img class="img-circle" src="{{ asset('img/icon_Profile.png') }}" width="32"
                                     height="32"/>
                            @endif
                            {{ Auth::User()->name }} {{ Auth::User()->family }}

                            <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a id="dashboard" href="#" data-toggle="modal" data-target="#user-profile-edit-modal">ویرایش
                                    پروفایل</a></li>
                            <li><a id="logout" href="{{ url('/logout') }}">خروج</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>

@yield('content')
<button class="btn btn-success btn-block" data-toggle="modal" data-target="#ReserveResultModal">Launch Modal</button>

<footer class="text-center">
    <div class="footer-above">
        <div class="container">
            <div class="row">
                <div class="footer-col col-md-4">
                    <h3>آدرس</h3>
                    <p>برج ميلاد،گذرگاه ميلاد،روبروي اورژانس</p>
                    <p>تماس با پشتیبانی <span style="color:yellow">09120030269</span></p>
                    <br/><br/><br/><br/>
                    <p>
                        {{--<script src="https://www.zarinpal.com/webservice/TrustCode" type="text/javascript"></script>--}}
                    </p>
                </div>
                <div class="footer-col col-md-4">
                    <h3>همراه ما در جوامع مجازی باشید</h3>
                    <ul class="list-inline">
                        @if(isset($setting))
                            @foreach($setting as $settingItem)
                                @if($settingItem->type == 0)
                                    <li>
                                        <a href="{{ $settingItem->value }}" class="btn-social btn-outline"><span
                                                    class="sr-only">{{ $settingItem->key }}</span><i
                                                    class="fa fa-fw fa-{{ $settingItem->key }}"></i></a>
                                    </li>
                                @endif
                            @endforeach
                        @endif

                    </ul>
                </div>
                <div class="footer-col col-md-4">
                    <h3>تماس با پشتیبانی</h3>
                    <form action="#" id="messageSender">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group text-right">
                            <label class="control-label">ایمیل</label>
                            <input type="text" name="emailto" style="direction: ltr" class="form-control"
                                   placeholder="ایمیل خود را وارد کنید">
                        </div>
                        <div class="form-group text-right">
                            <label class="control-label">موضوع</label>
                            <input type="text" name="subject" class="form-control" placeholder="موضوع خود را وارد کنید">
                        </div>
                        <div class="form-group text-right">
                            <label class="control-label">متن</label>
                            <textarea class="form-control" name="message" placeholder="متن خود را وارد کنید"></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-default btn-block btn-info"><i class="fa fa-envelope-o"
                                                                                                aria-hidden="true"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-below">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    Copyright © <span style="color:yellow">enigmascaperoom.ir</span>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
<div class="scroll-top page-scroll hidden-sm hidden-xs hidden-lg hidden-md">
    <a class="btn btn-primary" href="#page-top">
        <i class="fa fa-chevron-up"></i>
    </a>
</div>
<div id="login-modal" class="portfolio-modal modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-content">
        <div class="close-modal" data-dismiss="modal">
            <div class="lr">
                <div class="rl">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="modal-body">

            </div>
        </div>
    </div>
</div>
<div id="game-info-modal" class="portfolio-modal modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-content">
        <div class="close-modal" data-dismiss="modal">
            <div class="lr">
                <div class="rl">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="modal-body">

            </div>
        </div>
    </div>
</div>

<!-- email sende modal -->
<div id="MessageResultModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">ارسال پیام</h4>
            </div>
            <div class="modal-body">
                <div id="result_send_email">

                </div>
            </div>
        </div>

    </div>
</div>
<!-- edit profile Modal -->


<div id="user-profile-edit-modal" class="portfolio-modal modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-content">
        <div class="close-modal" data-dismiss="modal">
            <div class="lr">
                <div class="rl">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="modal-body">
                @if(Auth::check())
                    @include('profile.edit')
                @endif
            </div>
        </div>
    </div>
</div>

<!-- end profile Modal -->


@if(isset($status))
    @if(Auth::check())
        <!-- Reserve Message -->
        <div id="ReserveResultModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">رزرو بازی</h4>
                    </div>
                    <div class="modal-body">
                        <div id="result_reserve_game">
                            <h2>
                                <span>با تشکر از شما</span>&nbsp;<span>{{ Auth::user()->name }}</span>&nbsp;<span>عزیز</span>
                            </h2>
                            <p>درخواست رزرو بازی شما بدرستی ثبت گردید جهت کسب اطلاعات بیشتر با شماره 09120030269 تماس
                                حاصل فرمایید و یا کمی صبر کنید تا مسئولین بازی با شما تماس بگیرند</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- End Reserve Message -->
    @endif
@endif

<div id="cropItModal" style="direction: ltr" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">برش عکس پروفایل</h4>
            </div>
            <div class="modal-body">
                <button class="btn btn-success btn-lg btn-block" id="browseImgBtn">انتخاب تصویر</button>
                <form id="formImguploader" action="#">
                    <div class="image-editor">
                        <input type="file" id="selectFile" class="cropit-image-input hidden">
                        <div class="cropit-preview" style="margin: 35px auto;"></div>
                        <label>زوم تصویر</label>
                        <input type="range" class="cropit-image-zoom-input">

                        <button type="submit" class="btn btn-info btn-lg btn-block">آپلود شود</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-warning" data-dismiss="modal">بستن پنجره
                </button>
            </div>
        </div>

    </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
{{--<script src="/js/app.js"></script>--}}
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<script src="/js/theme/freelancer.js"></script>
<script src="/js/slider/responsiveslides.js"></script>
<script src="/js/theme/app.js"></script>
<script src="/js/jquery.toast.min.js" type="text/javascript"></script>
<script src="/js/map/gmaps.js" type="text/javascript"></script>


@yield('mapScript')

<script src="/js/jquery.cropit.js"></script>
<script src="/js/jquery.mask.js"></script>
<script src="/js/Iran-Address-JS.js"></script>

<script>
    $(document).ready(function () {
        $(document).ajaxStart(function () {
            $('.loading').fadeIn(10);
        });
        $(document).ajaxComplete(function () {
            $('.loading').fadeOut(10);
        });

        @if(Auth::check())
        $('#profileImgSelect').click(function () {
            $('#formImguploader')[0].reset();
            $('input.cropit-image-input').val('');
            $('.cropit-preview-image').attr('src', '');
            $('#cropItModal').modal();
            $('.image-editor').cropit();
        });
        $('#browseImgBtn').click(function () {
            $(".cropit-image-input").trigger('click');
        });
        $('#formImguploader').submit(function (event) {
            event.preventDefault();
            var imageData = $('.image-editor').cropit('export');
            $("input[name='image-data']").attr('value', imageData);
            $('#cropItModal').modal('hide');
            $('#profileImgSelect').attr('src', imageData);
        });
        $('#bank_account_number').mask('0000-0000-0000-0000');
        $('#zip_code').mask('00000-00000');
        $('#code_melli').mask('000-00000-00');
        $('#mobile').mask('00000000000');
        $('#telephone').mask('00000000000');
        setTimeout(function () {
            var province = '{{ Auth::user()->province }}';
            var city = '{{ Auth::user()->city }}';

            $("#province option").filter(function () {
                //may want to use $.trim in here
                return $(this).text() == province;
            }).prop('selected', true);

            $('#province').change();

            $("#city option").filter(function () {
                //may want to use $.trim in here
                return $(this).text() == province;
            }).prop('selected', true);

            $('#city').change();

        }, 1200);
        @endif

        $('#login-form-load').click(function () {
            $.ajax({
                type: 'GET',
                url: '/login',
                success: function (data) {
                    $("#login-modal .modal-body").html(data);

                    $("#click-login").click(function () {
                        var formData = $('#login-ajax').serialize();

                        $.ajax({
                            type: 'POST',
                            url: '/login',
                            data: formData,
                            success: function (data) {
                                if (data == '0') {
                                    $('#error').html('<p>اطلاعات وارد شده صحیح نمی باشد</p>');
                                    $('#error-holder').removeClass('hidden')
                                } else {
                                    $.ajax({
                                        type: 'GET',
                                        url: '/',
                                        success: function (data) {
                                            setTimeout(function () {
                                                window.location.href = "{{ url('/') }}";
                                            }, 500);

                                        }
                                    });
                                }
                            }
                        });
                    });


                    setTimeout(function () {
                        $('#login-modal').modal('show');
                    }, 1000)
                }
            });
        });
        $('#register-form-load').click(function () {
            $.ajax({
                type: 'GET',
                url: '/register',
                success: function (data) {
                    $("#login-modal .modal-body").html(data);
                    $("#click-register").click(function () {
                        var formData = $('#form-register').serialize();
//                        console.log(formData);
                        $(".err").removeClass('hidden').addClass('hidden');
                        $.ajax({
                            type: 'POST',
                            url: '/register',
                            data: formData,
                            success: function (data) {
                                if (data == '0') {
                                    $('#error').html('<p>اطلاعات وارد شده صحیح نمی باشد</p>');
                                    $('#error-holder').removeClass('hidden')
                                } else {
                                    $.ajax({
                                        type: 'GET',
                                        url: '/',
                                        success: function (data) {
                                            setTimeout(function () {
                                                window.location.href = "{{ url('/') }}";
                                            }, 500);

                                        }
                                    });
                                }
                            },
                            error: function (jqXHR, exception) {
                                if (jqXHR.status == 422) {
                                    var responseText = $.parseJSON(jqXHR.responseText);
                                    $.each(responseText, function (k, v) {

                                        $("#" + k + "Error").removeClass('hidden').html(v);
//                                        if (k == 'mobile') {
//                                            $("#mobileError").removeClass('hidden').html(v);
//                                        }
//                                        if (k == 'email') {
//                                            $("#emailError").removeClass('hidden').html(v);
//                                        }
//                                        if (k == 'password') {
//                                            $("#passwordError").removeClass('hidden').html(v);
//                                        }
//                                        if (k == 'name') {
//                                            $("#nameError").removeClass('hidden').html(v);
//                                        }
                                    });
                                }
                            }
                        });
                    });
                    setTimeout(function () {
                        $('#login-modal').modal('show');

                    }, 1000)
                }
            });
        });
        $("#slider4").responsiveSlides({
            auto: true,
            pager: false,
            nav: true,
            speed: 2000,
            namespace: "callbacks",
            before: function () {

            },
            after: function () {

            }
        });
        $('#logout').click(function (event) {
            event.preventDefault();
            $.ajax
            ({
                url: '{{ url('/logout') }}',
                success: function () {
                    location.reload();
                }
            });
        });
        $('#messageSender').submit(function (event) {
            //send email ajax
            event.preventDefault();
            $.ajax({
                url: '{{ url('/sendmessage') }}',
                data: $(this).serialize(),
                type: 'POST',
                success: function (data) {
                    $('#result_send_email').html(data);
                    setTimeout(function () {
                        $('#MessageResultModal').modal();
                        setTimeout(function () {
                            $('#MessageResultModal').modal('hide');
                        }, 2000);
                    }, 1000);
                },
                error: function (err, status) {
                    $('#result_send_email').html("<h1>خطا رخ داد</h1>");
                    setTimeout(function () {
                        $('#MessageResultModal').modal();
                    }, 1000);
                }
            });
        });


        @if(isset($status) == 'reserved')
          @if(Auth::check())
                $('#ReserveResultModal').modal('show');
          @endif
        @endif

    });
</script>
@yield('javascript')

</body>

</html>

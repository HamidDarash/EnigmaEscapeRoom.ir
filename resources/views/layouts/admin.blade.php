<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

    <link rel="stylesheet" href="/admin/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/admin/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="/admin/dist/css/skins/_all-skins.css">
    <!-- Styles -->

    <link rel="stylesheet" href="/admin/dist/css/style.css">
    <link rel="stylesheet" href="/css/jquery.toast.min.css">


@yield('stylesheet')

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->


    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body class="skin-blue sidebar-mini wysihtml5-supported" data-spy="scroll" data-target="#scrollspy">

<div class="wrapper">
    <header class="main-header">
        <!-- Logo -->
        <!-- Logo -->
        <a href="#" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>E</b>SR</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>Enigma</b>ScapeRoom</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">

                    <li><a href="{{ url('admin/reservations') }}" title="کل رویت نشده ها"><span class="fa fa-bell-o"></span><span class="badge alert-warning" style="position: absolute;top: 3px;left: 5px;font-weight: 100;">{{ $unread }}</span></a></li>
                    <li><a href="{{ url('/admin/reservations/orderedactivate/desc') }}" title="فعال شده های رویت نشده"><span class="fa fa-bell"></span><span class="badge alert-success" style="position: absolute;top: 3px;left: 5px;font-weight: 100;">{{ $reserved }}</span></a></li>
                    <li><a href="#" title="کنسل شده های رویت نشده"><span class="fa fa-bell"></span><span class="badge alert-danger" style="position: absolute;top: 3px;left: 5px;font-weight: 100;">{{ $reservecancel }}</span></a></li>
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">

                            @if(Auth::User()->avatar && Auth::check())
                                <img class="user-image" src="{{ asset('img/users/').'/'.Auth::User()->avatar }}" width="32" height="32" />
                            @else
                                <img class="user-image" src="{{ asset('img/icon_Profile.png') }}" width="32" height="32" />
                            @endif

                            <span class="hidden-xs">{{ Auth::check() ? Auth::user()->name.' '.Auth::user()->family : 'unknown'}}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                @if(Auth::User()->avatar && Auth::check())
                                    <img class="img-circle" src="{{ asset('img/users/').'/'.Auth::User()->avatar }}" width="32" height="32" />
                                @else
                                    <img class="img-circle" src="{{ asset('img/icon_Profile.png') }}" width="32" height="32" />
                                @endif

                                <p>
                                    <span> سلام مدیر سیستم</span>
                                    <small>آدرس ایمیل شما:{{ Auth::check() ? Auth::user()->email : 'ورود ناشناس' }}</small>
                                </p>
                            </li>
                            <li class="user-footer">

                                <div class="pull-right">
                                    <a href="{{ url('/logout') }}" class="btn btn-default btn-flat">خروج از سیستم</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <aside class="main-sidebar direction">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <ul class="sidebar-menu">
                <li class="header">منو اصلی</li>
                <li class="treeview {{ Session::get('current_menu_select')=='dashboard'?'active':'' }}">
                    <a href="{{ url('/admin/dashboard') }}">
                        <i class="fa fa-dashboard"></i> <span>داشبورد</span> <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li class="active">
                            <a href="{{ url('/admin/dashboard') }}"><i class="fa fa-circle-o"></i> داشبورد </a>
                        </li>
                    </ul>
                </li>
                <li class="treeview {{ Session::get('current_menu_select')=='users'?'active':'' }}">
                    <a href="#">
                        <i class="fa fa-users"></i>
                        <span>کاربران</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ Route::getCurrentRoute()->getPath() == 'admin/users/create' ? 'active':'' }}"><a
                                    href="{{ url('admin/users/create') }}"><i class="fa fa-plus-circle"></i>کاربر
                                جدید</a></li>
                        <li class="{{ Route::getCurrentRoute()->getPath() ==  'admin/users' ?'active':'' }}"><a
                                    href="{{ url('admin/users') }}"><i class="fa fa-list"></i>مشخصات کاربران</a></li>
                    </ul>
                </li>
                <li class="treeview {{ Session::get('current_menu_select')=='roles'?'active':'' }}">
                    <a href="#">
                        <i class="fa fa-shield"></i>
                        <span>سطح دسترسی کاربران</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ Route::getCurrentRoute()->getPath() == 'admin/roles/create' ? 'active':'' }}"><a
                                    href="{{ url('admin/roles/create') }}"><i class="fa fa-plus-circle"></i> ایجاد سطح
                                دسترسی</a></li>
                        <li class="{{ Route::getCurrentRoute()->getPath() == 'admin/roles' ? 'active':'' }}"><a
                                    href="{{ url('admin/roles') }}"><i class="fa fa-list"></i>مشاهده کل دسترسی ها</a>
                        </li>
                    </ul>
                </li>
                <li class="treeview {{ Session::get('current_menu_select')=='games'?'active':'' }}">
                    <a href="#">
                        <i class="fa fa-gamepad"></i> <span>بازی ها</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ Route::getCurrentRoute()->getPath() == 'admin/games/create' ? 'active':'' }}"><a
                                    href="{{ url('admin/games/create')  }}"><i class="fa fa-plus-circle"></i>ایجاد بازی
                                جدید</a></li>
                        <li class="{{ Route::getCurrentRoute()->getPath() == 'admin/games' ? 'active':'' }}">
                            <a href="{{ url('admin/games')  }}"><i class="fa fa-list"></i> مشاهده بازی ها</a>
                        </li>
                    </ul>
                </li>
                <li class="treeview {{ Session::get('current_menu_select')=='reservations'?'active':'' }}">
                    <a href="#">
                        <i class="fa fa-table"></i> <span>رزرو بازی</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ Route::getCurrentRoute()->getPath() == 'admin/reservations/create' ? 'active':'' }}">
                            <a href="{{ url('/admin/reservations/create')  }}"><i class="fa fa-circle-o"></i> رزرو کردن
                                بازی</a></li>
                        <li class="{{ Route::getCurrentRoute()->getPath() == 'admin/reservations' ? 'active':'' }}"><a
                                    href="{{ url('admin/reservations') }}"><i class="fa fa-list"></i> بازی های رزرو شده</a></li>
                    </ul>
                </li>
                <li class="treeview {{ Session::get('current_menu_select')=='posts'?'active':'' }}">
                    <a href="#">
                        <i class="fa fa-picture-o"></i> <span>اخبار</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ Route::getCurrentRoute()->getPath() == 'admin/posts' ? 'active':'' }}">
                            <a href="{{ url('admin/posts')  }}"><i class="fa fa-list"></i>اخبار</a>
                        </li>
                    </ul>
                </li>
                <li class="treeview {{ Session::get('current_menu_select')=='slider'?'active':'' }}">
                    <a href="#">
                        <i class="fa fa-picture-o"></i> <span>اسلایدر</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ Route::getCurrentRoute()->getPath() == 'admin/slider' ? 'active':'' }}">
                            <a href="{{ url('admin/slider')  }}"><i class="fa fa-list"></i>اسلایدر</a>
                        </li>
                    </ul>
                </li>
                <li class="treeview {{ Session::get('current_menu_select')=='setting'?'active':'' }}">
                    <a href="#">
                        <i class="fa fa-cogs"></i> <span>تنظیمات</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ Route::getCurrentRoute()->getPath() == 'admin/slider' ? 'active':'' }}">
                            <a href="{{ url('admin/settings')  }}"><i class="fa fa-sliders"></i>تنظیمات</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->


        <div class="content-header">
            <h1>
                @yield('title')
            </h1>
            {{--<ol class="breadcrumb">--}}
            {{--<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>--}}
            {{--<li class="active">Documentation</li>--}}
            {{--</ol>--}}
        </div>

        <!-- Main content -->
        <div class="content body" style="direction: rtl;overflow: hidden">
            @yield('content')
        </div><!-- ./wrapper -->

        <!-- jQuery 2.2.3 -->
        <script src="/admin/plugins/jQuery/jquery-2.2.3.min.js"></script>
        <!-- Bootstrap 3.3.6 -->
        <script src="/admin/bootstrap/js/bootstrap.min.js"></script>
        <script src="/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>

        <!-- FastClick -->
        <script src="/admin/plugins/fastclick/fastclick.min.js"></script>

        <!-- SlimScroll 1.3.0 -->
        <script src="/admin/plugins/slimScroll/jquery.slimscroll.min.js"></script>
        {{--convert date to miladi--}}
        <script src="/js/moment.js"></script>
        <script src="/js/moment-jalaali.js" type="text/javascript"></script>
        <script src="/js/jquery.toast.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="/admin/dist/js/app.min.js"></script>
        <script src="/admin/dist/js/demo.js"></script>

        @yield('script')
        @if(Session::has('flash_message'))
            <script>
                $(document).ready(function () {
                    $.toast({
                        text: '{{ Session::get('flash_message') }}',
                        icon: 'info',
                        loader: true,        // Change it to false to disable loader
                        loaderBg: '#9EC600'  // To change the background
                    });
                });
            </script>
@endif

</body>
</html>

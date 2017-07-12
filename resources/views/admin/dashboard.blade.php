@extends('layouts.admin')

@section('script')

    <script src="/admin/dist/js/bootstrap3-typeahead.min.js"></script>
    <script>
        $(document).ready(function () {

            {{--var $input = $("#email");--}}
            {{--$input.typeahead({--}}
                {{--source: {!! $emails !!},--}}
                {{--autoSelect: true--}}
            {{--});--}}

            $('#formSendEmail').submit(function (event) {
                event.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: '{{ url('admin/dashboard/sendemail') }}',
                    data: $(this).serialize(),
                    success: function (data) {
                        $('#emailStatus').html(data);
                        setTimeout(function () {
                            $('#emailStatus div').fadeOut(150);
                            setTimeout(function () {
                                $('#formSendEmail')[0].reset();
                            }, 250)
                        }, 3000)
                    }
                });
            });
        });

    </script>
@stop
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading"><h1>داشبورد</h1></div>
        <div class="panel-body">
            <section class="content">
                <div class="row">
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-aqua">
                            <div class="inner">
                                <h3>{{ $allReserved }}</h3>

                                <p>کل رزرو ها</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-table"></i>
                            </div>
                            <a href="{{ url('admin/reservations') }}" class="small-box-footer"><i
                                        class="fa fa-arrow-circle-left"></i> اطلاعات بیشتر </a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-green">
                            <div class="inner">
                                <h3>{{ $reserved }}</h3>

                                <p>فعال شده های رویت نشده</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="{{ url('/admin/reservations/orderedactivate/desc') }}" class="small-box-footer"><i
                                        class="fa fa-arrow-circle-left"></i> اطلاعات بیشتر </a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-yellow">
                            <div class="inner">
                                <h3>{{ $unread }}</h3>

                                <p>کل رویت نشده ها</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-eye-slash"></i>
                            </div>
                            <a href="#" class="small-box-footer"><i class="fa fa-arrow-circle-left"></i> اطلاعات بیشتر
                            </a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-red">
                            <div class="inner">
                                <h3>{{ $reservecancel }}</h3>

                                <p>کنسل شده های رویت نشده</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-ban"></i>
                            </div>
                            <a href="#" class="small-box-footer"><i class="fa fa-arrow-circle-left"></i> اطلاعات بیشتر
                            </a></div>
                    </div>
                    <!-- ./col -->
                </div>
            </section>
            <section class="content">
                <div class="box box-info">
                    <form id="formSendEmail" action="#" method="post">
                        <div class="box-header ui-sortable-handle" style="cursor: move;">
                            <h3 class="box-title">ارسال ایمیل</h3>
                            <i class="fa fa-envelope"></i>
                        </div>
                        <div class="box-body">
                            <input name="_token" value="{{ csrf_token() }}" type="hidden"/>
                            <div class="form-group">
                                <input type="email" id="email" style="direction: ltr" class="form-control"
                                       name="emailto" placeholder="ایمیل">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="subject" placeholder="عنوان">
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="message" id="message" placeholder="متن"></textarea>
                            </div>

                        </div>
                        <div class="box-footer clearfix">
                            <button type="submit" class="pull-left btn btn-default" id="sendEmail">ارسال
                                <i class="fa fa-arrow-circle-left"></i></button>
                        </div>
                    </form>
                </div>
                <div id="emailStatus">

                </div>
            </section>
        </div>
    </div>


@endsection

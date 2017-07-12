@extends('layouts.admin')
@section('stylesheet')
    <link rel="stylesheet" href="/css/datepicker/persian-datepicker-0.4.5.min.css" type="text/css" media="screen">
@stop
@section('script')
    <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script src="/js/persian-date.min.js"></script>
    <script src="/js/persian-datepicker-0.4.5.min.js"></script>


    <script type="text/javascript">
        $(document).ready(function () {
            $("#datePicker").pDatepicker({
                format: "YYYY/MM/DD"
            });
            $('#datePicker').change(function () {
                var game_id = $('#game_id').val();

                $('#date_reserved').val(moment($("#datePicker").val(), 'jYYYY/jM/jD').format('YYYY-M-D'));

                var url_page = "{{ url('/admin/renderSelect') }}";
                $.ajax({
                    data: $(this).parent().parent().parent().serialize(),
                    url: url_page,
                    type: 'POST',
                    cache: false,
                    success: function (data) {
                        $('#time_reserved_holder').html(data);
                    }
                });
            });
            var price = 0;
            $('#game_id').change(function () {
                $("#datePicker").val('');
                price = $('option:selected', this).attr('price-data');
                $("#gamePrice").val(price);
                $('#time_reserved_holder').html("<p>لطفا تاریخ را انتخاب کنید</p>");
            });

            $('#person_count').keyup(function () {
                if (parseInt($(this).val()) <= 0 || !($(this).val())) {
                    $(this).val(1);
                }
                $('#sum_price').val($(this).val() * price);
            });
            $('#person_count').mousedown(function () {
                $('#person_count').keyup();
            });
            $('#person_count').mouseleave(function () {
                $('#person_count').keyup();
            });

            setTimeout(function () {
                $('#game_id').change();
                $('#person_count').keyup();
            },1000);

            CKEDITOR.replace('description');

        });
    </script>
@stop
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading"> <h1> رزرو بازی </h1></div>
        <div class="panel-body">
            <div>
                <a href="{{ url('/admin/reservations') }}" title="Back">
                    <button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i>بازگشت
                    </button>
                </a>
                <br/>
                <br/>
                @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

                {!! Form::open(['url' => '/admin/reservations', 'class' => 'form-horizontal', 'files' => true]) !!}

                @include ('admin.reservations.form')

                {!! Form::close() !!}

            </div>
        </div>
    </div>




@endsection

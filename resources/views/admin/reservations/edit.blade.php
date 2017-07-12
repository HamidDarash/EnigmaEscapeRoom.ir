@extends('layouts.admin')
@section('stylesheet')
    <link rel="stylesheet" href="/css/datepicker/persian-datepicker-0.4.5.min.css" type="text/css" media="screen">
@stop
@section('script')
    <script src="/js/persian-date.min.js"></script>
    <script src="/js/persian-datepicker-0.4.5.min.js"></script>
@stop

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading"><h1>ویرایش رزرو #{{ $reservation->user['email']}} : {{  \Morilog\Jalali\jDatetime::strftime('Y-m-d',$reservation->date_reserved) }} : {{ $reservation->time_reserved }}</h1></div>
        <div class="panel-body">

            <div>
                <a href="{{ url('/admin/reservations') }}" >
                    <button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i>بازگشت</button>
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

                {!! Form::model($reservation, [
                    'method' => 'PATCH',
                    'url' => ['/admin/reservations', $reservation->id],
                    'class' => 'form-horizontal',
                    'files' => true
                ]) !!}

                @include ('admin.reservations.form', ['submitButtonText' => 'Update'])

                {!! Form::close() !!}

            </div>
        </div>
    </div>



@endsection

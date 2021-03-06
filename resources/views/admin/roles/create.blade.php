@extends('layouts.admin')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading"><h1>ایجاد سطح دسترسی</h1></div>
        <div class="panel-body">
            <div>
                <a href="{{ url('/admin/roles') }}">
                    <button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> بازگشت
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

                {!! Form::open(['url' => '/admin/roles', 'class' => 'form-horizontal', 'files' => true]) !!}

                @include ('admin.roles.form')

                {!! Form::close() !!}

            </div>
        </div>
    </div>

@endsection

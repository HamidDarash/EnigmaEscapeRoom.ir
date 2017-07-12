@extends('layouts.admin')

@section('script')
    <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script>
        $(document).ready(function () {
            $('#activate').change(function () {
                if ($(this).is(":checked")) {
                    $(this).val(1);
                } else {
                    $(this).val(0);
                }
            });
            CKEDITOR.replace('information');
        });
    </script>
@endsection

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading"><h1>ایجاد بازی جدید</h1></div>
        <div class="panel-body">
            <div>
                <a href="{{ url('/admin/games') }}">
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
                {!! Form::open(['url' => '/admin/games', 'class' => 'form-horizontal', 'files' => true]) !!}
                @include ('admin.games.form')
                {!! Form::close() !!}
            </div>
        </div>
    </div>





@endsection

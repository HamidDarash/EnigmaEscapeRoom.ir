@extends('layouts.admin')
@section('script')
    <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script>
        $(document).ready(function () {

            CKEDITOR.replace('content');
        });
    </script>
@endsection
@section('content')

    <div class="panel panel-default">
                    <div class="panel-heading">نوشتن پست یا خبر جدید</div>
                    <div class="panel-body">
                        <a href="{{ url('/admin/posts') }}"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> بازگشت</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        {!! Form::open(['url' => '/admin/posts', 'class' => 'form-horizontal', 'files' => true]) !!}

                        @include ('admin.posts.form')

                        {!! Form::close() !!}

                    </div>
                </div>

@endsection

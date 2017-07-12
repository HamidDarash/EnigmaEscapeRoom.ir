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
                    <div class="panel-heading">ویرایش پست یا خبر  #{{ $post->header }}</div>
                    <div class="panel-body">
                        <a href="{{ url('/admin/posts') }}" title="بازگشت"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> بازگشت</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        {!! Form::model($post, [
                            'method' => 'PATCH',
                            'url' => ['/admin/posts', $post->id],
                            'class' => 'form-horizontal',
                            'files' => true
                        ]) !!}

                        @include ('admin.posts.form', ['submitButtonText' => 'ویرایش'])

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

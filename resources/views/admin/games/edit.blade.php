@extends('layouts.admin')

@section('script')
    <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script>
        $(document).ready(function () {
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#previewImage').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }

            $(".fileUpload").change(function () {
                readURL(this);
            });
            $('#activate').change(function () {
                if ($(this).is(":checked")) {
                    $(this).val(1);
                } else {
                    $(this).val(0);
                }
            });
        });

        CKEDITOR.replace('information');
    </script>
@endsection

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading"><h1>ویرایش بازی #{{ $game->name }}</h1></div>
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

                {!! Form::model($game, [
                    'method' => 'PATCH',
                    'url' => ['/admin/games', $game->id],
                    'class' => 'form-horizontal',
                    'files' => true
                ]) !!}

                <div class="form-group">
                    <div class="col-md-6">
                        {!! Form::label('File', 'تصویر بازی را در اندازه 300 طول در 400 عرض', ['class' => 'form-control control-label alert alert-info']) !!}
                        {!! Form::file('image', ['class' => 'form-control fileUpload']) !!}
                    </div>
                    <div class="col-md-6">
                        @if($game->previewImg)
                            <img style="margin: 0 auto" class="thumbnail" id="previewImage"
                                 src="{{ asset('img/games').'/'.$game->previewImg }}" alt="picture" width="300"
                                 height="400"/>
                        @else
                            <img style="margin: 0 auto" class="thumbnail" id="previewImage"
                                 src="{{ asset('img/image-preview.jpg') }}" alt="picture" width="300" height="400"/>
                        @endif
                    </div>
                </div>
                <hr/>
                @include ('admin.games.form', ['submitButtonText' => 'ویرایش بازی'])

                {!! Form::close() !!}

            </div>
        </div>
    </div>


@endsection

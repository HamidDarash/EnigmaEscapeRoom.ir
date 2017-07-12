@extends('layouts.admin')
@section('script')
    <script src="/js/jquery.cropit.js"></script>
    <script>
        $(document).ready(function () {
            $('.image-editor').cropit();
            $('#browseImgBtn').click(function () {
                $(".cropit-image-input").trigger('click');
            });
            $('#formImguploader').submit(function (event) {
                event.preventDefault();
                if (!window.File || !window.FileReader || !window.FileList || !window.Blob) {
                    alert('The File APIs are not fully supported in this browser.');
                    return;
                }
                var typeFile = $("#selectFileInput")[0].files[0].type;
                if (typeFile != 'undefined' && typeFile != 'null' && typeFile != '') {
                    var imageData = $('.image-editor').cropit('export', {
                        type: typeFile,
                        quality: 1.0,
                        originalSize: true,
                    });

                    $("input[name='image-data']").attr('value', imageData);
                    $('#cropItModal').modal('hide');
                    $('#profileImgSelect').attr('src', imageData);
                }

            });
        });
    </script>
@stop

@section('content')
      <div class="panel panel-default">
        <div class="panel-heading"><h1>آپلود عکس جدید</h1></div>
        <div class="panel-body">

            <a href="{{ url('/admin/slider') }}" title="بازگشت">
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

            {!! Form::open(['url' => '/admin/slider', 'class' => 'form-horizontal', 'files' => true]) !!}

            @include ('admin.slider.form')

            {!! Form::close() !!}

        </div>
    </div>

@endsection

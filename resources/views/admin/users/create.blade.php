@extends('layouts.admin')
@section('script')
    <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script src="/js/jquery.cropit.js"></script>
    <script src="/js/jquery.mask.js"></script>
    <script src="/js/Iran-Address-JS.js"></script>


    <script>
        $(document).ready(function () {
            $('#profileImgSelect').click(function () {
                $('#formImguploader')[0].reset();
                $('input.cropit-image-input').val('');
                $('.cropit-preview-image').attr('src', '');
                $('#cropItModal').modal();
                $('.image-editor').cropit();
            });

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
                        quality: 0.5,
                        originalSize: true,
                    });

                    $("input[name='image-data']").attr('value', imageData);
                    $('#cropItModal').modal('hide');
                    $('#profileImgSelect').attr('src', imageData);
                }

            });

            $('#bank_account_number').mask('0000-0000-0000-0000');
            $('#zip_code').mask('00000-00000');
            $('#code_melli').mask('000-00000-00');
            $('#mobile').mask('00000000000');
            $('#telephone').mask('00000000000');
        });
    </script>
@endsection
@section('content')

    <div class="panel panel-default">
        <div class="panel-heading"><h1 class="">ساخت کاربر جدید</h1></div>
        <div class="panel-body">
            <div id="cropItModal" style="direction: ltr" class="modal fade" role="dialog" >
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">برش عکس پروفایل</h4>
                        </div>
                        <div class="modal-body">
                            <button class="btn btn-success btn-lg btn-block" id="browseImgBtn">انتخاب تصویر</button>
                            <form id="formImguploader" action="#">
                                <div class="image-editor">
                                    <input type="file" id="selectFileInput" class="cropit-image-input hidden">
                                    <div class="cropit-preview" style="margin: 35px auto;"></div>
                                    <label>زوم تصویر</label>
                                    <input type="range" class="cropit-image-zoom-input">

                                    <button type="submit" class="btn btn-info btn-lg btn-block">آپلود شود</button>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default btn-warning" data-dismiss="modal">بستن پنجره</button>
                        </div>
                    </div>

                </div>
            </div>
            <div class="well" style="display:inline-block">
                <h4 class="text-center">تصویر پروفایل</h4>
                <div class="hiddenFileInputContainter">
                    <img id="profileImgSelect" class="img-circle fileDownload" src="{{ asset('img/icon_Profile.png') }}">
                </div>
            </div>
            <br/>
            <div class="">
                <a href="{{ url('/admin/users') }}">
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

                {!! Form::open(['url' => '/admin/users', 'class' => 'form-horizontal', 'files' => true]) !!}
                <input type="hidden" name="image-data" class="hidden-image-data"/>
                @include ('admin.users.form')

                {!! Form::close() !!}

            </div>
        </div>
    </div>


@endsection

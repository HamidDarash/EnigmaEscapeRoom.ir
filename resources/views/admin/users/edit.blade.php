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

            $('#browseImgBtn').click(function () {
                $(".cropit-image-input").trigger('click');
            });
            $('#formImguploader').submit(function (event) {
                event.preventDefault();
                var imageData = $('.image-editor').cropit('export');
                $("input[name='image-data']").attr('value', imageData);
                $('#cropItModal').modal('hide');
                $('#profileImgSelect').attr('src', imageData);
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
        <div class="panel-heading"><h1>ویرایش {{ $user->email }}</h1></div>
        <div class="panel-body">
            <div id="cropItModal" style="direction: ltr" class="modal fade" role="dialog">
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
                                    <input type="file" class="cropit-image-input hidden">
                                    <div class="cropit-preview" style="margin: 35px auto;"></div>
                                    <label>زوم تصویر</label>
                                    <input type="range" class="cropit-image-zoom-input">

                                    <button type="submit" class="btn btn-info btn-lg btn-block">آپلود شود</button>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default btn-warning" data-dismiss="modal">بستن پنجره
                            </button>
                        </div>
                    </div>

                </div>
            </div>
            <div class="well" style="display:inline-block">
                <h4 class="text-center">تصویر پروفایل</h4>
                <div class="hiddenFileInputContainter">
                    <img id="profileImgSelect" class="img-circle fileDownload"
                         src="{{ $user->avatar ? asset('img/users').'/'.$user->avatar : asset('img/icon_Profile.png') }}">
                </div>
            </div>
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

                {!! Form::model($user, [
                    'method' => 'PATCH',
                    'url' => ['/admin/users', $user->id],
                    'class' => 'form-horizontal',
                    'files' => true
                ]) !!}

                <input type="hidden" name="image-data" class="hidden-image-data"/>
                @include ('admin.users.form', ['submitButtonText' => 'بروزرسانی'])

                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

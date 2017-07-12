@extends('layouts.admin')

@section('stylesheet')
    <style>
        .cropit-preview-image-container {
            cursor: move;
            border-radius: 0 !important;
        }
    </style>
@stop
@section('script')
    <script src="/js/jquery.cropit.js"></script>
    <script>
        $(document).ready(function () {
            $('.image-editor').cropit({width: 1280, height: 520});
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

                    $.ajax({
                        type: 'POST',
                        url: '{{ url('/admin/slider') }}',
                        data: $(this).serialize(),
                        success: function (data) {
                            console.log(data)
                            if (data.mode === 1) {
                                $.toast({
                                    text: data.message,
                                    icon: 'info',
                                    loader: true,        // Change it to false to disable loader
                                    loaderBg: '#C62F00'  // To change the background
                                });

                                var html_element = '<div class="col-md-4" style="margin-top: 25px">' +
                                    '<div>' + '<img class="img-thumbnail" width="100%"' +
                                    'src="{{ asset('img/slider')}}/' + data.filename + '" alt="$item->alt"/>' +
                                    '</div><div>برای حذف این آیتم صفحه را بروزرسانی کنید</div></div>';


                                //filename
                                $('#wrap_pictures').append(html_element);


                            } else {
                                $.toast({
                                    text: data.message,
                                    icon: 'error',
                                    loader: true,        // Change it to false to disable loader
                                    loaderBg: '#C62F00'  // To change the background
                                });
                            }
                        }
                    });
                }
            });
        });
    </script>
@stop
@section('content')

    <div id="cropItModal" style="direction: ltr" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg" style="width: 100%;height: 100vh;margin-top: 0">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">برش عکس پروفایل</h4>
                </div>
                <div class="modal-body">
                    <button class="btn btn-success btn-lg btn-block" id="browseImgBtn">انتخاب تصویر</button>
                    <form id="formImguploader" action="#" enctype="multipart/form-data">
                        <div class="image-editor ">
                            <input type="file" id="selectFileInput" class="cropit-image-input hidden">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="cropit-preview" style="margin: 35px auto;"></div>
                            <label>زوم تصویر</label>
                            <input type="range" class="cropit-image-zoom-input">
                            <input type="hidden" name="image-data">
                            {!! Form::hidden('alt', null) !!}
                            {!! Form::hidden('sliderpicture', null) !!}
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

    <div class="panel panel-default">
        <div class="panel-heading">تصاویر اسلایدر</div>
        <div class="panel-heading">
            <a href="#" onclick="$('#cropItModal').modal()" class="btn btn-success btn-sm">
                <i class="fa fa-plus" aria-hidden="true"></i> اضافه کردن اسلایدر
            </a>
        </div>
        <div class="panel-body" id="wrap_pictures">
            @foreach($slider as $item)
                <div class="col-md-4" style="margin-top: 25px">
                    <div>
                        <img class="img-thumbnail" width="100%"
                             src="{{ asset('img/slider')}}/{{ $item->sliderpicture }}" alt="$item->alt"/>
                    </div>
                    <div>
                        {!! Form::open([
                'method'=>'DELETE',
                'url' => ['/admin/slider', $item->id],
                'style' => 'display:inline'
                ]) !!}

                        {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> حذف', array(
                        'type' => 'submit',
                        'class' => 'btn btn-danger btn-xs',
                        'title' => 'حذف اسلایدر',
                        'onclick'=>'return confirm("آیا از حذف اسلایدر اطمینان دارید؟")'
                        )) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection

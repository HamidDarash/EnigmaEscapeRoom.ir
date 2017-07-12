<div class="panel panel-default">
    <div class="panel-heading"><h3>ویرایش {{ $user->email }}</h3></div>
    <div class="panel-body">

        <div class="well" style="display:inline-block">
            <h4 class="text-center">تصویر پروفایل</h4>
            <div class="hiddenFileInputContainter">
                <img id="profileImgSelect" class="img-circle fileDownload"
                     src="{{ $user->avatar ? asset('img/users').'/'.$user->avatar : asset('img/icon_Profile.png') }}">
            </div>
        </div>
        <div class="">
            <br/>
            <br/>

            {!! Form::model($user, [
                'method' => 'POST',
                'url' => ['/userProfileEdit'],
                'class' => 'form-horizontal',
                'files' => true
            ]) !!}

            <input type="hidden" name="image-data" class="hidden-image-data"/>
            @include ('profile.form', ['submitButtonText' => 'بروزرسانی'])

            {!! Form::close() !!}
        </div>
    </div>
</div>
@extends('layouts.admin')

@section('script')
 <script>
     $(document).ready(function(){
         $(".icons-soceial .fa").click(function(){
             $("#optionText").text($(this).attr('title'));
             $("#optionText").val($(this).attr('title'));
         });
         
     });
 </script>
@stop

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">ویرایش تنظیمات #{{ $setting->key }}</div>
        <div class="panel-body">
            <a href="{{ url('/admin/settings') }}" title="بازگشت">
                <button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> بازگشت</button>
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

            {!! Form::model($setting, [
                'method' => 'PATCH',
                'url' => ['/admin/settings', $setting->id],
                'class' => 'form-horizontal',
                'files' => true
            ]) !!}

            @include ('admin.settings.form', ['submitButtonText' => 'ویرایش'])

            {!! Form::close() !!}

        </div>
    </div>

@endsection

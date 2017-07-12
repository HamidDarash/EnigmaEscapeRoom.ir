@extends('layouts.app')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">Edit Slider #{{ $slider->id }}</div>
        <div class="panel-body">
            <a href="{{ url('/admin/slider') }}" title="Back">
                <button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button>
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

            {!! Form::model($slider, [
                'method' => 'PATCH',
                'url' => ['/admin/slider', $slider->id],
                'class' => 'form-horizontal',
                'files' => true
            ]) !!}

            @include ('admin.slider.form', ['submitButtonText' => 'Update'])

            {!! Form::close() !!}

        </div>
    </div>

@endsection

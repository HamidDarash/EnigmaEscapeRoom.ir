@extends('layouts.admin')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">تنظیمات</div>
        <div class="panel-body">
            <a href="{{ url('/admin/settings/create') }}" class="btn btn-success btn-sm" title="ورود تنظیمات جدید">
                <i class="fa fa-plus" aria-hidden="true"></i> ورود تنظیمات جدید
            </a>

            {!! Form::open(['method' => 'GET', 'url' => '/admin/settings', 'class' => 'navbar-form navbar-right', 'role' => 'search'])  !!}
            <div class="input-group">
                <input type="text" class="form-control" name="search" placeholder="جستجو...">
                <span class="input-group-btn">
                                <button class="btn btn-default" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
            </div>
            {!! Form::close() !!}

            <br/>
            <br/>
            <div class="table-responsive">
                <table class="table table-borderless">
                    <thead>
                    <tr>
                        <th>نوع</th>
                        <th>کلید</th>
                        <th>مقدار</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($settings as $item)
                        <tr>
                            <td>{{ $item->type }}</td>
                            <td>{{ $item->key }}</td>
                            <td>{{ $item->value }}</td>
                            <td>
                                {{--<a href="{{ url('/admin/settings/' . $item->id) }}" title="View Setting">--}}
                                    {{--<button class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i>--}}
                                        {{--View--}}
                                    {{--</button>--}}
                                {{--</a>--}}
                                <a href="{{ url('/admin/settings/' . $item->id . '/edit') }}" title="Edit Setting">
                                    <button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o"
                                                                              aria-hidden="true"></i> ویرایش
                                    </button>
                                </a>
                                {!! Form::open([
                                    'method'=>'DELETE',
                                    'url' => ['/admin/settings', $item->id],
                                    'style' => 'display:inline'
                                ]) !!}
                                {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> حذف', array(
                                        'type' => 'submit',
                                        'class' => 'btn btn-danger btn-xs',
                                        'title' => 'حذف تنظیمات',
                                        'onclick'=>'return confirm("آیا مطمئن هستید؟")'
                                )) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="pagination-wrapper"> {!! $settings->appends(['search' => Request::get('search')])->render() !!} </div>
            </div>
        </div>
    </div>
@endsection

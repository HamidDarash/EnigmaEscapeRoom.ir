@extends('layouts.admin')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">سطح دسترسی</div>
        <div class="panel-body">
            <a href="{{ url('/admin/roles/create') }}" class="btn btn-success btn-large">
                <i class="fa fa-plus" aria-hidden="true"></i> اضافه کردن دسترسی جدید
            </a>

            {!! Form::open(['method' => 'GET', 'url' => '/admin/roles', 'class' => 'navbar-form navbar-right','style' => 'margin-top:0;', 'role' => 'search'])  !!}
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
                        <th>نام دسترسی</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($roles as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>
                                <a href="{{ url('/admin/roles/' . $item->id . '/edit') }}">
                                    <button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o"
                                                                              aria-hidden="true"></i> ویرایش
                                    </button>
                                </a>
                                {!! Form::open([
                                    'method'=>'DELETE',
                                    'url' => ['/admin/roles', $item->id],
                                    'style' => 'display:inline'
                                ]) !!}
                                {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> حذف', array(
                                        'type' => 'submit',
                                        'class' => 'btn btn-danger btn-xs',
                                        'title' => 'حذف دسترسی',
                                        'onclick'=>'return confirm("آیا مطمپن هستید؟")'
                                )) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="pagination-wrapper"> {!! $roles->appends(['search' => Request::get('search')])->render() !!} </div>
            </div>

        </div>
    </div>


@endsection

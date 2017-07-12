@extends('layouts.admin')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading"> <h1>کاربران</h1></div>
        <div class="panel-body">
            <div>
                <a href="{{ url('/admin/users/create') }}" class="btn btn-success btn-large">
                    <i class="fa fa-plus" aria-hidden="true"></i> کاربر جدید
                </a>

                {!! Form::open(['method' => 'GET', 'url' => '/admin/users', 'class' => 'navbar-form navbar-right' ,'style' => 'margin-top: 0', 'role' => 'search'])  !!}
                <div class="input-group">
                    <input type="text" class="form-control" name="search" placeholder="جستجو ...">
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
                            <th>آواتار</th>
                            <th>نام</th>
                            <th>فامیلی</th>
                            <th>ایمیل</th>
                            <th>شماره موبایل</th>
                            <th>شماره ملی</th>
                            <th>شهر</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $item)
                            <tr>
                                <td>
                                    @if($item->avatar)
                                        <img width="48" height="48" src="{{ asset('img/users/').'/'.$item->avatar }}"
                                             class="img-circle"/>
                                    @else
                                        <img width="48" height="48" style="background-color: #00B0E8" src="{{ asset('img').'/icon_Profile.png' }}"
                                             class="img-circle"/>
                                    @endif
                                </td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->family }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->mobile }}</td>
                                <td>{{ $item->code_melli }}</td>
                                <td>{{ $item->city }}</td>
                                <td>
                                    <a href="{{ url('/admin/users/' . $item->id . '/edit') }}">
                                        <button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o"
                                                                                  aria-hidden="true"></i> ویرایش
                                        </button>
                                    </a>
                                    {!! Form::open([
                                        'method'=>'DELETE',
                                        'url' => ['/admin/users', $item->id],
                                        'style' => 'display:inline'
                                    ]) !!}
                                    {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> حذف', array(
                                            'type' => 'submit',
                                            'class' => 'btn btn-danger btn-xs',
                                            'title' => 'حذف کاربر',
                                            'onclick'=>'return confirm("آیا مطمئن هستید؟")'
                                    )) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="pagination-wrapper"> {!! $users->appends(['search' => Request::get('search')])->render() !!} </div>
                </div>
            </div>
        </div>
    </div>



@endsection

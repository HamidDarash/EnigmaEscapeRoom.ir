@extends('layouts.admin')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">تراکنش های مالی</div>
        <div class="panel-body">

            <div class="col-md-12">
                {!! Form::open(['method' => 'GET', 'url' => '/admin/transactions', 'class' => 'navbar-form navbar-right', 'role' => 'search'])  !!}
                <div class="input-group">
                    <input type="text" class="form-control" name="search" placeholder="جستجو...">
                    <span class="input-group-btn">
                                <button class="btn btn-default" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                </div>
                {!! Form::close() !!}
            </div>

            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-borderless">
                        <thead>
                        <tr>
                            <th>کاربر</th>
                            <th>شناسه</th>
                            <th>درگاه</th>
                            <th>مبلغ</th>
                            <th>کد پیگیری</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($transactions as $item)
                            <tr>
                                <td> {{ $item->Users()->email }}</td>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->port }}</td>
                                <td>{{ $item->price }}</td>
                                <td>{{ $item->tracking_code }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="pagination-wrapper"> {!! $transactions->appends(['search' => Request::get('search')])->render() !!} </div>
                </div>
            </div>

        </div>
    </div>
@endsection

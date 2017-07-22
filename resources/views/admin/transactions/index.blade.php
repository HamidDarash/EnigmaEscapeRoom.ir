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
                            <th>کاربر </th>
                            <th>شناسه</th>
                            <th>درگاه</th>
                            <th>مبلغ</th>
                            <th>کد پیگیری</th>
                            <th>زمان پرداخت</th>
                            <th>وضعیت پرداخت</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($transactions as $item)
                            <tr>
                                 @php $listUsers = $item->Users()->get(); @endphp
                                  @if(count($listUsers) > 0)
                                    @foreach($listUsers as $it)
                                      <th> {{ $it->email }} </th>
                                    @endforeach
                                  @else
                                      <th> {{ 'نامشخص' }} </th>
                                  @endif
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->port }}</td>
                                <td>{{ $item->price }} <span class="badge alert-info">تومان</span></td>
                                <td>{!! $item->tracking_code ? $item->tracking_code :'<span class="badge alert-warning">خالی</span>' !!}</td>
                                <td> {!! $item->payment_date != null ?  jDate::forge($item->payment_date)->format('date') : '<span class="badge alert-danger">خطا داشته</span>' !!}</td>
                                <td>  
                                @php
                                   switch ($item->status) {
                                    case 'INIT':
                                     echo "<span class='badge alert-warning'>در وضعیت انتظار</span>";
                                    break;
                                    case 'SUCCEED':
                                    echo "<span class='badge alert-success'>وضعیت موفق</span>";
                                    break;
                                    case 'FAILED':
                                      echo "<span class='badge alert-danger'>وضعیت نا موفق</span>";
                                    break;
                                    }
                                @endphp
                                </td>
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

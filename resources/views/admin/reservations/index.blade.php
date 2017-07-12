@extends('layouts.admin')

@section('script')
    <script>
        $(document).ready(function () {
            $(".formActivate").submit(function (event) {
                var form = $(this);
                event.preventDefault();
                var url_page = "{{ url('/admin/reservations/changeActivate') }}";
                $.ajax({
                    data: $(this).serialize(),
                    url: url_page,
                    type: 'POST',
                    cache: false,
                    success: function (data) {
//                        var obj = '#activateField' + data.reserveid;
//                        var inputActivate = document.getElementById(obj);
//                        inputActivate.setAttribute('value', data.activate);
                        if (data.activate === 1) {
                            form.find("input[type='submit']").val('تغییر به غیر فعال');
                            form.find("input[name='activate']").attr('value', data.activate);
                            form.find("input[type='submit']").removeClass('btn-danger').addClass('btn-success');
                            $.toast({
                                text: 'رزرو بازی مورد نظر فعال گردید',
                                icon: 'info',
                                loader: true,        // Change it to false to disable loader
                                loaderBg: '#C62F00'  // To change the background
                            });
                        } else {
                            form.find("input[name='activate']").attr('value', data.activate);
                            form.find("input[type='submit']").val('تغییر به فعال');
                            form.find("input[type='submit']").removeClass('btn-success').addClass('btn-danger');
                            $.toast({
                                text: 'رزرو بازی مورد نظر غیر فعال گردید',
                                icon: 'info',
                                loader: true,        // Change it to false to disable loader
                                loaderBg: '#C62F00'  // To change the background
                            });
                        }

                    }
                });
            });
            $(".formCancel").submit(function (event) {
                var form = $(this);
                event.preventDefault();
                var url_page = "{{ url('/admin/reservations/changeCancel') }}";
                $.ajax({
                    data: $(this).serialize(),
                    url: url_page,
                    type: 'POST',
                    cache: false,
                    success: function (data) {
                        if (data.canceled === 1) {
                            form.find("input[type='submit']").val('خروج از کنسل');
                            form.find("input[name='canceled']").attr('value', data.canceled);
                            form.find("input[type='submit']").removeClass('btn-danger').addClass('btn-success');
                            $.toast({
                                text: 'رزرو بازی مورد نظر کنسل گردید',
                                icon: 'info',
                                loader: true,        // Change it to false to disable loader
                                loaderBg: '#C62F00'  // To change the background
                            });
                        } else {
                            form.find("input[name='canceled']").attr('value', data.canceled);
                            form.find("input[type='submit']").val('کنسل شود');
                            form.find("input[type='submit']").removeClass('btn-success').addClass('btn-danger');
                            $.toast({
                                text: 'رزرو بازی مورد نظر از کنسلی خارج گردید',
                                icon: 'info',
                                loader: true,        // Change it to false to disable loader
                                loaderBg: '#C62F00'  // To change the background
                            });
                        }

                    }
                });
            });

        });
    </script>
@stop
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading"><h1>لیست رزرو ها</h1></div>
        <div class="panel-body">
            <div>
                <div class="col-md-12">
                    <a href="{{ url('/admin/reservations/create') }}" class="btn btn-success btn-large">
                        <i class="fa fa-plus" aria-hidden="true"></i> رزرو بازی
                    </a>
                    {!! Form::open(['method' => 'GET', 'url' => '/admin/reservations','style'=>'margin-top: 0', 'class' => 'navbar-form navbar-right', 'role' => 'search'])  !!}
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
                                <th>مشاهده</th>
                                <th>آواتار</th>
                                <th>کاربر</th>
                                <th>بازی رزرو شده</th>
                                <th>ساعت رزرو</th>
                                <th>تاریخ رزرو</th>
                                <th>توضیحات</th>
                                <th>
                                    <a href="{{ url('/admin/reservations/orderedactivate/asc') }}"><span
                                                class="fa fa-angle-down"></span></a>&nbsp;<span>فعال/غیرفعال</span>&nbsp;<a
                                            href="{{ url('/admin/reservations/orderedactivate/desc') }}"><span
                                                class="fa fa-angle-up"></span></a>
                                </th>
                                <th>وضعیت سفارش</th>
                                <th>وضعیت رویت</th>
                                <th>عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($reservations as $item)
                                <tr>
                                    <td><a  href="{{ url('admin/reservations',$item->id) }}" class="btn btn-block btn-info btn-xs">مشاهده</a></td>
                                    <td>
                                        @if($item->user['avatar'])
                                            <img width="48" height="48" src="{{ asset('img/users/').'/'.$item->user['avatar'] }}"
                                                 class="img-circle"/>
                                        @else
                                            <img width="48" height="48" style="background-color: #00B0E8" src="{{ asset('img').'/icon_Profile.png' }}"
                                                 class="img-circle"/>
                                        @endif
                                    </td>
                                    <td>{!! $item->user['email']? $item->user['email']: "<span class='badge alert-danger'> کاربر وجود ندارد </span>" !!} </td>
                                    <td>{!! $item->game['name'] ?  $item->game['name'] : "<span class='badge alert-danger'> کاربر وجود ندارد </span>" !!}</td>
                                    <td>{{ $item->time_reserved }}</td>
                                    <td>{{ jDate::forge($item->date_reserved)->format('date') }}</td>
                                    <td>{!! $item->description ? $item->description : "<span class='badge badge-info'>  خالی </span>" !!}</td>
                                    <td>
                                        <form action="#"
                                              class="formActivate" method="post">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                                            <input name="reserveid" value="{{ $item->id }}" type="hidden"/>
                                            <input id="#activateField{{ $item->id }}" name="activate"
                                                   value="{{ $item->activate }}" type="hidden"/>
                                            <input type="submit"
                                                   class="btn btn-xs btn-block btn-{{ $item->activate?'success':'danger' }}"
                                                   value="  تغییر به{{ $item->activate?' غیر فعال':' فعال' }}">
                                        </form>
                                    </td>
                                    <td>
                                        <form action="#"
                                              class="formCancel" method="post">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                                            <input name="cancelReserveId" value="{{ $item->id }}" type="hidden"/>
                                            <input id="#cancelField{{ $item->id }}" name="canceled"
                                                   value="{{ $item->canceled }}" type="hidden"/>
                                            <input type="submit"
                                                   class="btn btn-xs btn-block btn-{{ $item->canceled?'success':'danger' }}"
                                                   value="{{ $item->canceled?'خروج از کنسلی':' کنسل شود' }}">
                                        </form>
                                    </td>
                                    <td>{!!  $item->reading ?  "<span class='badge alert-success'> رویت شده </span>": "<span class='badge alert-danger'> رویت نشده </span>"  !!}</td>
                                    <td>

                                        {!! Form::open([
                                            'method'=>'DELETE',
                                            'url' => ['/admin/reservations', $item->id],
                                            'style' => 'display:inline'
                                        ]) !!}
                                        {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> حذف', array(
                                                'type' => 'submit',
                                                'class' => 'btn btn-danger btn-xs btn-block',
                                                'title' => 'حذف رزرو',
                                                'onclick'=>'return confirm("آیا مطمئن هستید؟")'
                                        )) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                        <div class="pagination-wrapper"> {!! $reservations->appends(['search' => Request::get('search')])->render() !!} </div>
                    </div>

                </div>

            </div>
        </div>
    </div>



@endsection

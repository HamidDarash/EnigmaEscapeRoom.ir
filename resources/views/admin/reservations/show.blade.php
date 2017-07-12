@extends('layouts.admin')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading"><h1> رزرو #{{ $reservation->user['email']}}
                :  {{ jDate::forge($reservation->date_reserved)->format('date') }} }}
                : {{ $reservation->time_reserved }}</h1></div>
        <div class="panel-body">
            <div class="col-md-8">

                <a href="{{ url('/admin/reservations') }}" title="Back">
                    <button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> بازگشت به
                        صفحه قبل
                    </button>
                </a>
                <a href="{{ url('/admin/reservations/' . $reservation->id . '/edit') }}" title="Edit Reservation">
                    <button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                        ویرایش
                    </button>
                </a>
                {!! Form::open([
                    'method'=>'DELETE',
                    'url' => ['admin/reservations', $reservation->id],
                    'style' => 'display:inline'
                ]) !!}
                {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> حذف', array(
                        'type' => 'submit',
                        'class' => 'btn btn-danger btn-xs',
                        'title' => 'حذف رزرو',
                        'onclick'=>'return confirm("آیا مطمئن هستید؟")'
                ))!!}
                {!! Form::close() !!}
                <br/>
                <br/>

                <div class="table-responsive">
                    <table class="table table-borderless">
                        <thead>
                        <tr>
                            <th>
                                @if($reservation->user['avatar'])
                                    <img width="128" height="128"
                                         src="{{ asset('img/users/').'/'.$reservation->user['avatar'] }}"
                                         class="img-circle"/>
                                @else
                                    <img width="128" height="128" style="background-color: #00B0E8"
                                         src="{{ asset('img').'/icon_Profile.png' }}"
                                         class="img-circle"/>
                                @endif
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th>کاربر</th>
                            <td> {{ $reservation->user['email'] }} </td>
                        </tr>
                        <tr>
                            <th>بازی رزرو شده</th>
                            <td> {{ $reservation->game->name }} </td>
                        </tr>
                        <tr>
                            <th>تاریخ رزرو</th>
                            <td>{{ jDate::forge($reservation->date_reserved)->format('date') }}</td>
                        </tr>
                        <tr>
                            <th>ساعت رزرو</th>
                            <td>{{ $reservation->time_reserved }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-4">
                @if($reservation->game->previewImg)
                    <img class="imgPrevGame" width="300" height="400"
                         src="{{ asset('img/games').'/'.$reservation->game->previewImg }}"
                         alt="{{ $reservation->game->previewImg }}">
                @else
                    <img class="imgPrevGame" width="300" height="400"
                         src="{{ asset('img/image-preview.jpg') }}"
                         alt="image-preview">
                @endif
            </div>
        </div>
    </div>

@endsection

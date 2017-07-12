@extends('layouts.admin')

@section('script')
    <script>
        $(document).ready(function () {
            $(".formActivate").submit(function (event) {
                var form = $(this);
                event.preventDefault();
                var url_page = "{{ url('/admin/games/changeActivate') }}";
                $.ajax({
                    data: $(this).serialize(),
                    url: url_page,
                    type: 'POST',
                    cache: false,
                    success: function (data) {
                        if (data.activate === 1) {
                            form.find("input[type='submit']").val('تغییر به غیر فعال');
                            form.find("input[name='activate']").attr('value', data.activate);
                            form.find("input[type='submit']").removeClass('btn-danger').addClass('btn-success');
                            $.toast({
                                text: 'بازی مورد نظر فعال گردید',
                                icon: 'info',
                                loader: true,        // Change it to false to disable loader
                                loaderBg: '#c62f00'  // To change the background
                            });
                        } else {
                            form.find("input[name='activate']").attr('value', data.activate);
                            form.find("input[type='submit']").val('تغییر به فعال');
                            form.find("input[type='submit']").removeClass('btn-success').addClass('btn-danger');
                            $.toast({
                                text: 'بازی مورد نظر غیر فعال گردید',
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
        <div class="panel-heading"><h1>بازی ها</h1></div>
        <div class="panel-body">
            <div>
                <a href="{{ url('/admin/games/create') }}" class="btn btn-success btn-large">
                    <i class="fa fa-plus" aria-hidden="true"></i> ایجاد بازی جدید
                </a>

                {!! Form::open(['method' => 'GET', 'url' => '/admin/games', 'class' => 'navbar-form navbar-right','style'=>'margin-top:0;', 'role' => 'search'])  !!}
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
                            <th>تصویر</th>
                            <th>نام بازی</th>
                            <th>فعال/غیرفعال</th>
                            <th>قیمت(نفر)</th>
                            <th>مدت زمان</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($games as $item)
                            <tr>
                                @if($item->previewImg)
                                    <td><img src="{{ asset('img/games').'/'.$item->previewImg }}" width="37" height="50"/></td>
                                @else
                                    <td><img src="{{ asset('img/image-preview.jpg') }}" width="37" height="50"/></td>
                                @endif
                                <td>{!!  $item->name ? $item->name : "<span class='badge btn-info btn-block'>  خالی </span>"  !!}</td>
                                <td>
                                    <form action="#"
                                          class="formActivate" method="post">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                                        <input name="gameId" value="{{ $item->id }}" type="hidden"/>
                                        <input id="#activateField{{ $item->id }}" name="activate"
                                               value="{{ $item->activate }}" type="hidden"/>
                                        <input type="submit"
                                               class="btn btn-xs btn-block btn-{{ $item->activate?'success':'danger' }}"
                                               value="  تغییر به{{ $item->activate?' غیر فعال':' فعال' }}">
                                    </form>
                                </td>
                                <td>{{ $item->price }} ريال</td>
                                <td> {{ floor($item->minutes / 60) }} ساعت و {{ floor($item->minutes % 60)  }} دقیقه</td>
                                <td>
                                    <a href="{{ url('/admin/games/' . $item->id . '/edit') }}" title="Edit Game">
                                        <button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o"
                                                                                  aria-hidden="true"></i> ویرایش
                                        </button>
                                    </a>
                                    {!! Form::open([
                                        'method'=>'DELETE',
                                        'url' => ['/admin/games', $item->id],
                                        'style' => 'display:inline-block'
                                    ]) !!}
                                    {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> حذف', array(
                                            'type' => 'submit',
                                            'class' => 'btn btn-danger btn-xs',
                                            'title' => 'حذف بازی',
                                            'onclick'=>'return confirm("آیا مطمپن هستید؟")'
                                    )) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="pagination-wrapper"> {!! $games->appends(['search' => Request::get('search')])->render() !!} </div>
                </div>
            </div>
        </div>
    </div>
@endsection

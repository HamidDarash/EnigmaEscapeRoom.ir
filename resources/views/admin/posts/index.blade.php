@extends('layouts.admin')
@section('script')
    <script>
        $(document).ready(function () {
            $(".formActivate").submit(function (event) {
                var form = $(this);
                event.preventDefault();
                var url_page = "{{ url('/admin/posts/changeActivate') }}";
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
                                text: 'پست/خبر مورد نظر قابل نمایش گردید',
                                icon: 'info',
                                loader: true,        // Change it to false to disable loader
                                loaderBg: '#c62f00'  // To change the background
                            });
                        } else {
                            form.find("input[name='activate']").attr('value', data.activate);
                            form.find("input[type='submit']").val('تغییر به فعال');
                            form.find("input[type='submit']").removeClass('btn-success').addClass('btn-danger');
                            $.toast({
                                text: 'پست/خبر مورد نظر غیر قابل نمایش گردید',
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
        <div class="panel-heading">پست ها/خبر ها</div>
        <div class="panel-body">
            <a href="{{ url('/admin/posts/create') }}" class="btn btn-success btn-sm">
                <i class="fa fa-plus" aria-hidden="true"></i> ایجاد پست/خبر جدید
            </a>

            {!! Form::open(['method' => 'GET', 'url' => '/admin/posts', 'class' => 'navbar-form navbar-right', 'role' => 'search'])  !!}
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
                        <th>سرتیتر</th>
                        <th>وضعیت</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($posts as $item)
                        <tr>
                            <td>{{ $item->header }}</td>
                            <td>
                                <form action="#"
                                      class="formActivate" method="post">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                                    <input name="postId" value="{{ $item->id }}" type="hidden"/>
                                    <input id="#activateField{{ $item->id }}" name="activate"
                                           value="{{ $item->activate }}" type="hidden"/>
                                    <input type="submit"
                                           class="btn btn-xs btn-block btn-{{ $item->activate?'success':'danger' }}"
                                           value="  تغییر به{{ $item->activate?' غیر فعال':' فعال' }}">
                                </form>
                            </td>
                            <td>
                                <a href="{{ url('/admin/posts/' . $item->id . '/edit') }}" title="Edit Post">
                                    <button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o"
                                                                              aria-hidden="true"></i> ویرایش
                                    </button>
                                </a>
                                {!! Form::open([
                                    'method'=>'DELETE',
                                    'url' => ['/admin/posts', $item->id],
                                    'style' => 'display:inline'
                                ]) !!}
                                {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                        'type' => 'submit',
                                        'class' => 'btn btn-danger btn-xs',
                                        'title' => 'حذف خبر/پست',
                                        'onclick'=>'return confirm("آیا مطمئن هستید؟")'
                                )) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="pagination-wrapper"> {!! $posts->appends(['search' => Request::get('search')])->render() !!} </div>
            </div>

        </div>
    </div>

@endsection

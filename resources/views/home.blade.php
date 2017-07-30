@extends('layouts.app')

@section('mapScript')
    <script>
        function initMap() {
            var usRoadMapType = new google.maps.StyledMapType([
                {
                    "featureType": "all",
                    "elementType": "labels.text.fill",
                    "stylers": [
                        {
                            "color": "#ffffff"
                        }
                    ]
                },
                {
                    "featureType": "all",
                    "elementType": "labels.text.stroke",
                    "stylers": [
                        {
                            "color": "#000000"
                        },
                        {
                            "lightness": 13
                        }
                    ]
                },
                {
                    "featureType": "administrative",
                    "elementType": "geometry.fill",
                    "stylers": [
                        {
                            "color": "#000000"
                        }
                    ]
                },
                {
                    "featureType": "administrative",
                    "elementType": "geometry.stroke",
                    "stylers": [
                        {
                            "color": "#144b53"
                        },
                        {
                            "lightness": 14
                        },
                        {
                            "weight": 1.4
                        }
                    ]
                },
                {
                    "featureType": "landscape",
                    "elementType": "all",
                    "stylers": [
                        {
                            "color": "#08304b"
                        }
                    ]
                },
                {
                    "featureType": "poi",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "color": "#0c4152"
                        },
                        {
                            "lightness": 5
                        }
                    ]
                },
                {
                    "featureType": "road.highway",
                    "elementType": "geometry.fill",
                    "stylers": [
                        {
                            "color": "#000000"
                        }
                    ]
                },
                {
                    "featureType": "road.highway",
                    "elementType": "geometry.stroke",
                    "stylers": [
                        {
                            "color": "#0b434f"
                        },
                        {
                            "lightness": 25
                        }
                    ]
                },
                {
                    "featureType": "road.arterial",
                    "elementType": "geometry.fill",
                    "stylers": [
                        {
                            "color": "#000000"
                        }
                    ]
                },
                {
                    "featureType": "road.arterial",
                    "elementType": "geometry.stroke",
                    "stylers": [
                        {
                            "color": "#0b3d51"
                        },
                        {
                            "lightness": 16
                        }
                    ]
                },
                {
                    "featureType": "road.local",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "color": "#000000"
                        }
                    ]
                },
                {
                    "featureType": "transit",
                    "elementType": "all",
                    "stylers": [
                        {
                            "color": "#146474"
                        }
                    ]
                },
                {
                    "featureType": "water",
                    "elementType": "all",
                    "stylers": [
                        {
                            "color": "#021019"
                        }
                    ]
                }
            ], 'EnigmaEscapeRoom');

            var bangalore = {lat: 35.74613, lng: 51.37563};
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 13,
                center: {lat: 35.74613, lng: 51.37563},
                zoomControl: true,
                zoomControlOpt: {
                  style: 'SMALL',
                  position: 'TOP_LEFT'
                }
            
                //mapTypeControlOptions: {
               //     mapTypeIds: [google.maps.MapTypeId.HYBRID, '']
               // }
            });
            var marker = new google.maps.Marker({
                position: bangalore,
                map: map,
                icon: "{{ asset('img/logo-site-4.png') }}"
            });
            marker.setAnimation(google.maps.Animation.BOUNCE);
            
            
            //map.mapTypes.set('EnigmaEscapeRoom', usRoadMapType);
           // map.setMapTypeId(google.maps.MapTypeId.HYBRID);
        }
    </script>
    <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyD1Ywz1RgQ1Qwlw184YnOR_hxpZpsjOtsc&callback=initMap"
            type="text/javascript"></script>
@stop
@section('javascript')

    <script type="text/javascript" rel="script">
    document.addEventListener("touchstart", function() {}, false);
    
        $(document).ready(function () {
            
             
             
            $('.slide').textSlider();

            $("#lawCheck").change(function () {

                if ($(this).prop('checked')) {
                    $(this).val(1);
                } else {
                    $(this).val(0);
                }

                ckb = $(this).is(':checked');
                if (ckb) {
                    $("#formReservedGame").find('input[type="submit"]').removeClass('disabled');
                } else {
                    $("#formReservedGame").find('input[type="submit"]').addClass('disabled');
                }
            });


                    @if(Auth::check())
            var userId = {{ Auth::User()->id }};
                    @else
            var userId = "";

            @endif

            function initilizeTable() {
                $.ajax({
                    type: 'GET',
                    data: $("#SendInfoDrawerForm").serialize(),
                    url: '{{ url('/drawtimetable') }}',
                    cache: false,
                    success: function (data) {
                        $('#contentTable').html(data.tableBody);
                        $('#theader').html(data.tableHead);
                        $('#clickNextWeek').attr('nextWeek', data.nextWeek);
                        $('#clickLastWeek').attr('lastWeek', data.lastWeek);
                    },
                    error: function (jqXHR, textStatus, errorMessage) {
                        alert(errorMessage);
                    }
                });
            };

            initilizeTable();
            $('#SendInfoDrawerForm').submit(function (event) {
                event.preventDefault();
                $.ajax({
                    type: 'GET',
                    data: $(this).serialize(),
                    url: '{{ url('/drawtimetable') }}',
                    success: function (data) {
                        $('#contentTable').html(data.tableBody);
                        $('#theader').html(data.tableHead);
                        $('#clickNextWeek').attr('nextWeek', data.nextWeek);
                        $('#clickLastWeek').attr('lastWeek', data.lastWeek);
                        console.log(data)
                    },
                    error: function (jqXHR, textStatus, errorMessage) {
                        alert(errorMessage);
                    }
                });
            });
            $('#selecterGame').change(function () {
                $('#SendInfoDrawerForm').submit();
            });
            $('#clickNextWeek').click(function (event) {
                event.preventDefault();
                $('#sDate').val($(this).attr('nextWeek'));
                $('#SendInfoDrawerForm').submit();
            });
            $('#clickLastWeek').click(function (event) {
                event.preventDefault();
                $('#sDate').val($(this).attr('lastWeek'));
                $('#SendInfoDrawerForm').submit();
            });
            
                $("#btnformCheckGameReserve").click(function(event){
                    event.preventDefault();
                         $.ajax({
                            type: 'POST',
                            data: $("#formCheckGameReserve").serialize(),
                            url: '{{ url('/findReserve') }}',
                         success: function (data) {
                            if(data == 0 && $.isNumeric(data)){
                              $('#form-reserve-game').modal();
                            }else{
                              $('#sorryModal').modal();
                            }
                         },
                    error: function (jqXHR, textStatus, errorMessage) {
                           console.log(errorMessage);
                    }
                });
                 
               });
               
                
            $(document).on('click', '.dataReserved', function (event) {
                $("#lawCheck").prop('checked', false);
                if (!$(this).find('input[type="submit"]').hasClass('disabled')) {
                    $("#formReservedGame").find('input[type="submit"]').addClass('disabled');
                }
                
                var timeGo = $(this).attr('time-select');
                var dateGo = $(this).attr('date-miladi');


                var ShamsiDate = $(this).attr('date-shamsi');
                var priceGo = $(this).attr('game-price');
                
                var game_id_chack = $('#selecterGame option:selected').val();
                // init modal form
                $('#gameId').val($('#selecterGame option:selected').val());
                

                //check login for reserve
                if (userId != null && userId != "") {
                    $("#sDateCheck").val(dateGo);
                    $("#timeCheck").val(timeGo);
                    $("#gameIdCheck").val(game_id_chack);
                    $("#btnformCheckGameReserve").click();
               
                } else {
                    $('#register-form-load').click();
                    return false;
                }

                
                

                // get Count Person of array field selected game
                var dataSelectPerson = $('#selecterGame option:selected').attr('selected_person_count');
                var opt = dataSelectPerson.split(',');
                //create help table
                if(opt.length>0){
                    var i = 0;
                    var tempOption = '';
                    var tempTable =   '<table class="table table-bordered"><tr><th>تعداد نفر</th><th>قیمت به ازای هر نفر</th></tr>';
                    for (i = 0; i <= opt.length - 1; i++) {
                        var tempVal = opt[i].split('|');
                        tempOption += '<option price="'+ tempVal[0]*tempVal[1] +'" value="' + tempVal[0] + '">' + tempVal[0] + ' نفر ' + '</option>';
                        var j = 0;
                        tempTable += '<tr>';
                        for (j = 0; j <= tempVal.length - 1; j++) {
                            if (j==0){
                                tempTable += '<td>' + tempVal[j] +  ' نفر ' + '</td>';
                            }else{
                                tempTable += '<td>' + tempVal[j] +  ' ريال ' + '</td>';
                            }

                        }
                        tempTable += '</tr>'
                    }
                }


                $('#select_count_person').html(tempOption);
                $('#select_count_person').change(function(){
                    var price = $(this).attr('price');
                    $('#sumPrice').val(price);
                });
                
                $('#priceHelp').html(tempTable);
                // $('#userId').val(userId);
                $('#dateSelectForReservedText').html(ShamsiDate);
                $('#dateSelectForReservedInput').val(dateGo);
                $('#timeSelectForReservedText').html(timeGo);
                $('#timeSelectForReservedInput').val(timeGo);
 
                $('#discrip').val($('#selecterGame option:selected').html());
                $('#nameGame').html($('#selecterGame option:selected').html());
                var collectionImgPreview = $('.imgPrevGame');
                collectionImgPreview.each(function (index, element) {
                    if ($(element).attr('game-img-id') === $('#selecterGame option:selected').val()) {
                        var img = "<img src='" + $(element).attr('src') + "' width='100%' />"

                        $('#imgPrevInModal').html(img);
                        $('#imgPrevInModal img').addClass('thumbnail');
                    }
                });

            });
            //submit on form reserve


            $('#formReservedGame').submit(function (event) {
                event.preventDefault();

                if (!$(this).find('input[type="submit"]').hasClass('disabled')) {
                    $(this).unbind("submit");
                    $(this).submit();
                }
            });

            $('.gameBtnReserve').click(function (event) {
                var id = $(this).attr('game-id');
                $('#selecterGame').val(id);
                $('#SendInfoDrawerForm').submit();
//                var collectionOpion = $('#selecterGame option');
//                collectionOpion.each(function (index, element) {
//                    if ($(element).attr('value') === id) {
//
//                    }
//                });
            });

            $('.getDataGame').submit(function (event) {
                event.preventDefault();
                $.ajax({
                    type: 'POST', url: '{{ url('/getGameInformation') }}',
                    data: $(this).serialize(),
                    success: function (data) {
                        if (data === 0) {
                            alert('خطا در بارگذاری اطلاعات بازی رخ داد')
                        } else {
                            $('#game-info-modal .modal-body').html(data);
                            $('#game-info-modal').modal();
                        }
                    }
                });
            });

            $("#newsFormReader").submit(function (event) {
                event.preventDefault();
                $.ajax({
                    data: $(this).serialize(),
                    type: 'POST',
                    url: '{{ url('/news') }}',
                    success: function (data) {
                        if (data != 0) {
                            $('#newsSubject').html(data.header);
                            $('#newsContent').html(data.content);
                            $('#form-news-reader').modal();
                        }

                    }
                });
            });
        });


    </script>

    <script src="/js/text-slider.js"></script>
@stop

@section('content')

    <!-- home Section -->
    <section id="home" style="overflow: hidden">
        <div class="callbacks_container">
            <ul class="rslides" id="slider4">
                @if(isset($sliders))
                    @foreach($sliders as $slider)
                        <li>
                            @if($slider->sliderpicture)
                                <img src="{{ asset('img/slider') }}/{{ $slider->sliderpicture }}"
                                     alt="{{ $slider->alt }}">
                            @endif
                        </li>
                    @endforeach
                @endif
            </ul>
        </div>
    </section>
    @if(isset($posts) && count($posts)>0)
        <section id="news">
            <div class="container">
                <div class="header clearfix">
                    <h2 class="text-muted" style="margin: 10px;color: #333;">اخبار
                        سایت </h2>
                </div>

                <div class="jumbotron" style="margin-top: 10px;padding-top: 10px;background-color:transparent;">
                    <div class="slide">
                        @foreach($posts as $p)
                            <div class="slider-item">
                                <h3 class="text-right" style="font-size: 18px;color:#1b2835;">{{ $p->header }}</h3>
                                <div class="content">
                                    {!! str_limit($p->content,350,'...')  !!}
                                    {{--{!!  $p->content   !!}--}}
                                </div>
                                <form id="newsFormReader">
                                    <input type="hidden" value="{{ csrf_token() }}" name="_token">
                                    <input name="idNews" value="{{ $p->id }}" type="hidden"/>
                                    <button href="#" class="btn btn-default" id="readMoreNews">مطالعه کامل</button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>

        </section>
        <div id="form-news-reader" class="portfolio-modal modal fade" tabindex="-1" role="dialog" aria-hidden="false">
            <div class="modal-content">
                <div class="close-modal" data-dismiss="modal">
                    <div class="lr">
                        <div class="rl">

                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="modal-body">
                        <h1 class="text-right" style="color:#2C3E50;">خبر #<span id="newsSubject"
                                                                                 style="color:#4e6b88;"></span></h1>
                        <h2 id="createAt"></h2>
                        <div class="container">
                            <div id="newsContent" class="content">

                            </div>
                        </div>
                        <hr/>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <!-- About Section -->
    <section id="about" style="overflow: hidden">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="text-right" style="margin-bottom: 30px">درباره ما</h2>
                    <div class="col-md-6">
                        <h3 style="color:#000" class="text-right">تاریخچه ماشین انیگما</h3>
                        <p style="text-align: justify">ماشین انیگما در سال 1920 و بعد از جنگ جهانی اول بدست مهندسان آلمانی اختراع شد . این ماشین جهت رمز نگاری و رمز گشایی پیامهای نظامی در طول جنگ جهانی دوم بکار میرفت. در نهایت بدلیل ضعف های رمز نگاری و ایراد های کاربران و پی بردن متفقین به جدول های رمز گشایی, و
                        در راس آنها ریاضیدان و نابغه انگلیسی آلن تورینگ رمز آن شکسته شد.</p> 
                        <img src="{{ asset('img/escape-logo-black.png') }}" width="100%" style="margin-top:8px"/>
                    </div>
                    <div class="col-md-6">
                        <h3 style="color:#000" class="text-right">بازی فرار از اتاق چیست؟</h3>
                        <p style="text-align: justify">
                             بازی فرار از اتاق یک بازی فیزیکی ـ ماجراجویی است که در آن بازیکنان در یک اتاق قفل شده قرار
                            میگیرند و می بایست به صورت گروهی و در قالب یک تیم با حل کردن معما ها پیدا کردن سرنخ ها و به
                            کار بردن استراتژی های متفاوت و مختلف در زمانی مشخص که از قبل تعیین شده از اتاق فرار کنند
                            نام بازی فرار از اتاق از یک بازی ویدئویی به همین نام که در سال 2007 در ژاپن تولید شد گرفته
                            شده . بازی فیزیکی فرار از اتاق به این صورت که امروز در حال انجام است ابتدا در شرق آسیا, سپس
                            در اروپا و آمریکا گسترش یافت .
                            اتاق فرار انیگما به قصد پر نمودن اوقات فراغت جوانان و بزرگسالان با هیجان انگیزترین حالت ممکن
                            در مجموعه برج میلاد تهران در خرداد ماه 1396 راه اندازی گردیده است.
                        </p>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <p></p>
                </div>
                <div class="col-md-4">
                    <p></p>
                </div>

            </div>
        </div>
    </section>

    <section id="games">
        <div id="game-wraper">
            <div id="main-header" class="col-lg-12">
                <h2 class="container">بازی ها</h2>
            </div>
            <div style="padding: 0 60px;">
                @if($games)
                    @foreach($games as $game_item)
                        <div class="game-item col-lg-4 col-md-4 col-sm-6 col-xs-12" ontouchstart="">
                            <div class="loaderDemo"></div>
                            @if($game_item->previewImg)
                                <img game-img-id="{{ $game_item->id }}" class="imgPrevGame" width="100%" height="auto"
                                     src="{{ asset('img/games').'/'.$game_item->previewImg }}"
                                     alt="{{ $game_item->previewImg }}">
                            @else
                                <img class="imgPrevGame" game-img-id="{{ $game_item->id }}" width="100%" height="auto"
                                     src="{{ asset('img/image-preview.jpg') }}"
                                     alt="image-preview">
                            @endif
                            <div class="game-information">
                                <div class="icon text-center">
                                    <i class="fa fa-gamepad fa-3x"></i>
                                </div>
                                <div class="text-right">
                                    <h2 class="text-center"
                                        style="margin-top:10px;font-size:2em">{{ $game_item?$game_item->name:'بدون نام' }}</h2>
                                    @if($game_item->getAttribute('quick-information'))
                                        <div class="paragraph" style="padding:15px">
                                            <p class="hidden-lg hidden-md" style="text-align: justify;font-size: .8em">{{ str_limit( $game_item->getAttribute('quick-information'),150)  }} </p>
                                            <p class="hidden-sm hidden-xs" style="text-align: justify;font-size: 1.2em">{{ str_limit( $game_item->getAttribute('quick-information'),400)  }} </p>
                                            <form class="getDataGame">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                                                <input type="hidden" name="game_id" value="{{ $game_item->id }}"/>
                                                <button type="submit" href="#" class="readMore btn btn-xs">مطالعه داستان
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="buttonReserveHolder page-scroll">
                                <a game-id="{{ $game_item->id }}" href="#reserved"
                                   class="btn btn-danger btn-default btn-block gameBtnReserve"><span
                                            style="margin-left: 10px"
                                            class="fa fa-plus"></span>
                                    <span>رزرو کنید</span>
                                </a>
                            </div>
                        </div>
                    @endforeach
                @endif

            </div>
        </div>
    </section>

    @if(isset($games))
        <!-- reserved Section -->
        
        <form class="hidden" id="formCheckGameReserve">
            <!--findReservItem-->
            <input name="__token" value="{{ csrf_token() }}" type="hidden"/>
            <input id="sDateCheck" name="sDateCheck" type="hidden" value=""/>
            <input id="timeCheck" name="timeCheck" type="hidden" />
            <input id="gameIdCheck" name="gameIdCheck" type="hidden" />
            <input type="submit" id="btnformCheckGameReserve" />
        </form>
        <section id="reserved" class="success">
            <div class="container">
                <h1 style="color:yellow">رزرو بازی</h1>
                <h3 class="text-right">بازی مورد نظر خود را انتخاب کنید</h3>
                <div class="col-md-12">
                    <form id="SendInfoDrawerForm">
                        <input name="__token" value="{{ csrf_token() }}" type="hidden"/>
                        <input id="sDate" name="sDate" type="hidden" value=""/>
                        <input id="userId" name="userId" type="hidden" value="{{ Auth::check()?Auth::User()->id:-1 }}"/>

                        <div class="input-group" style="margin-bottom: 15px">
                            <span class="input-group-addon"
                                  style="background-color: #0d141a;color: white;border: 1px solid rgb(8, 12, 16);">انتخاب کنید</span>
                            <select id="selecterGame"
                                    style="font-size: 1.5em;height: 48px;background-color: #161f27;color: white;border: 1px solid rgb(8, 12, 16);"
                                    class="form-control"
                                    value="-1" name="gameId">
                                @foreach($games as $item_temp)
                                    <option selected_person_count="{{ $item_temp->arraycount }}"
                                            value="{{ $item_temp->id }}"> {{ $item_temp->name }}
                                        | {{ $item_temp->minutesforuser }} دقیقه
                                    </option>
                                    {{--| {{ floor($item_temp->minutes/60) }} {{ 'ساعت و ' }}{{ floor($item_temp->minutes%60) }} {{'دقیقه'}}   </option>--}}
                                @endforeach
                            </select>

                        </div>
                        <div class='form-group' style="box-shadow: 0 0 290px black;border: 1px solid rgb(8, 12, 16);">
                            <div class="table-responsive" style="padding: 10px;box-shadow: inset 0 0 330px black;">
                                <table class='table text-center' style="margin-top: 10px">
                                    <thead>
                                    <tr>
                                        <th colspan='12' class='text-center'>
                                            <div class='col-lg-2' style="margin-top: 10px">
                                                <div>
                                                    <a id='clickLastWeek' lastWeek=''
                                                       href='#'> <i class="fa fa-arrow-circle-right fa-4x"
                                                        ></i> </a>
                                                </div>
                                            </div>
                                            <br class="hidden-lg hidden-md"/>
                                            <div class='col-lg-8'><h1 style='margin: 0'>فرم رزرواسیون بازی </h1></div>
                                            <br class="hidden-lg hidden-md"/>
                                            <div class='col-lg-2' style="margin-top: 10px">
                                                <div>
                                                    <a id='clickNextWeek' nextWeek=''
                                                       href='#'><i class="fa fa-arrow-circle-left fa-4x"
                                                        ></i> </a>
                                                </div>
                                            </div>
                                        </th>
                                    </tr>
                                    <tr id="theader">

                                    </tr>
                                    </thead>
                                    <tbody id="contentTable" style="font-size: 1.2em">

                                    </tbody>
                                    <tfoot>

                                    </tfoot>
                                </table>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </section>

        <div id="form-reserve-game" class="portfolio-modal modal fade" tabindex="-1" role="dialog" aria-hidden="false">
            <div class="modal-content">
                <div class="close-modal" data-dismiss="modal">
                    <div class="lr">
                        <div class="rl">

                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="modal-body">
                        <h4 class="text-right" style="color:#2C3E50;">فرم رزرو بازی # <span id="nameGame"
                                                                                            style="color:#730202;"></span>
                        </h4>
                        <!-- url('/reserve_user') -->
                        <form action="{{ url('/sendDataBank') }}" method="POST" id="formReservedGame">
                            <input type="hidden" name="description" id="discrip" value=""/>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="gameId" id="gameId" value="">

                            {{--<input type="hidden" name="userId" id="userId" value="{{ Auth::check()?Auth::User()->id:-1 }}">--}}
                            <input type="hidden" name="dateSelectForReservedInput" id="dateSelectForReservedInput"
                                   value="">
                            <input type="hidden" name="timeSelectForReservedInput" id="timeSelectForReservedInput"
                                   value="">
                            <input type="hidden" name="price" id="price" value="550000">
                            <input type="hidden" name="sumPrice" id="sumPrice"/>

                            <div class="row" style="margin-top: 30px">
                                <div class="col-md-4 success">
                                    <div id="imgPrevInModal" style="margin: 0 auto">
                                        {{--show img selected--}}
                                    </div>
                                </div>
                                <div class="col-md-4">

                                    <div class="form-group">
                                        <div class="text-right">
                                            <strong>تاریخ : </strong>
                                            <p id="dateSelectForReservedText"></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="text-right">
                                            <strong>ساعت : </strong>
                                            <p id="timeSelectForReservedText"></p>
                                        </div>
                                    </div>
                                    <div class="form-group hidden">
                                        <div class="text-right">
                                            <strong>قیمت واحد : </strong>
                                            <p id="priceSelectForReservedText"></p>
                                        </div>
                                    </div>
                                    <div class="form-group text-right">
                                        <label for="person_count" class="text-right">تعداد افراد را مشخص کنید:</label>
                                        <select class="form-control" name="person_count" id="select_count_person">

                                        </select>
                                        <div id="priceHelp" class="table-responsive">

                                        </div>
                                    </div>
                                    <div class="form-group text-right">

                                        <p><input type="checkbox" style="display: inline-block" value="0"
                                                  id="lawCheck" name="law"/> <span> تمامی  </span> <a
                                                    data-toggle="modal"
                                                    data-target="#LawModal"
                                                    href="#">قوانین و شرایط</a>
                                            <span>را مطالعه کردم</span></p>
                                    </div>
                                    
                                    <div class="form-group text-right alert alert-danger">
                                        <p style="font-size: 1.1em;text-align: justify;font-weight: bolder;">
                                              کاربر گرامی مبلغ 55000 تومان بعنوان پیش پرداخت از شما کسر خواهد شد و مابقی هزینه بازی بصورت حضوری در محل از شما دریافت می گردد
                                        </p>
                                    </div>
                                    <div class="form-group text-right hidden">
                                        <span style="color: darkred;font-weight: bold;font-size: 1.1em">جمع پرداختی شما :</span><strong
                                                id="priceSumLabel"
                                                style="color: #00a65a;font-weight: bold;font-size: 1.1em"></strong><span
                                                style="color: darkred;font-weight: bold;font-size: 1.1em"> ريال می باشد </span>

                                    </div>
                                </div>
                                <div class="col-md-4">

                                    <input type="submit" value="رزرو کنید"
                                           class="btn btn-success btn-lg disabled"/>
                                </div>
                            </div>

                        </form>
                        <hr/>
                    </div>
                </div>
            </div>
        </div>

        <div id="LawModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header label-info">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">قوانین و شرایط بازی</h4>
                    </div>
                    <div class="modal-body">
                        <p>بروزرسانی نشده</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">بستن</button>
                    </div>
                </div>

            </div>
        </div>
        
           <div id="sorryModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header label-danger">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">هم زمانی رزرو</h4>
                    </div>
                    <div class="modal-body">
                        <h1>متاسفیم!!!</h1>
                        <p style="text-align:justify">کاربر دیگری این بازی رو قبل از شما رزرو کرده و چون شما صفحه را بروزرسانی نکردیده متوجه این رزرو نشده اید شما می توانید از ساعات دیگر برای رزرو استفاده کنید</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">بستن</button>
                    </div>
                </div>

            </div>
        </div>
        
    @endif
    <!-- end games Section -->

    <!-- map  
    <section id="maps_google">
        <h1 class="text-center" style="margin-bottom: 0px;">آدرس ما</h1>
        <br/>
        <div style="margin-bottom: 100px;box-shadow: 0 0 10px rgba(0,0,0,.3)">
            <div id="map" style="height: 400px;box-shadow: 0 0 25px #000"></div>
        </div>
    </section>
     end map -->

@endsection

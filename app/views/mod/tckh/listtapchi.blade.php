@extends('front-page')

@section('main_content')
<script src="{{Config::get('app.url')}}/asset/js/slider/jquery.bxslider.min.js"></script>
<!-- bxSlider CSS file -->
<link href="{{Config::get('app.url')}}/asset/js/slider/jquery.bxslider.css" rel="stylesheet" />

<div class="news_viewarticle_box">
    <div class="fp-boxtitle" style="text-align: left;border-radius: 4px 4px 0px 0px;">Danh sách tạp chí</div>

    @foreach ( $list_sotapchi as $namtapchi => $ds_sotapchi)
    <div style="clear:both;">
        <div class="tckh_groupnam">Năm {{$namtapchi}}</div>

        <ul class="bxslider">
            @foreach ( $ds_sotapchi as $sotapchi )
                <li onclick="self.location.href='{{url("tckh/xemtapchi?idsotapchi=".$sotapchi->id)}}'">
                    <div class="tckh_item">
                        <img class="tckh_anhbia_thumb" src="{{Config::get('app.url')}}/tckhbia/{{$sotapchi->anhbia == '' ? '_default.gif' : $sotapchi->anhbia}}">
                        <p>Số {{$sotapchi->sotapchi}}</p>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
    @endforeach
    <script type="text/javascript">
    $(document).ready(function(){
        $('.bxslider').bxSlider({
            minSlides: 3,
            maxSlides: 3,
            slideWidth: 220,
            slideMargin: 10,
            pager: false,
            infiniteLoop: false,
            hideControlOnEnd: true
        });
    });
    </script>
</div>

@stop
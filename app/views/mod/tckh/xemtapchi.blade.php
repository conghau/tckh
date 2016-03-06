@extends('front-page')

@section('main_content')
<script src="{{Config::get('app.url')}}/asset/js/slider/jquery.bxslider.min.js"></script>
<!-- bxSlider CSS file -->
<link href="{{Config::get('app.url')}}/asset/js/slider/jquery.bxslider.css" rel="stylesheet" />

<div class="news_viewarticle_box">
    <div class="fp-boxtitle" style="text-align: left;border-radius: 4px 4px 0px 0px;">Bài viết của tạp chí số {{$sotapchiinfo->sotapchi}} năm {{$sotapchiinfo->namtapchi}}</div>
    <div class="row" style="padding-right: 30px;padding-left:10px">
        <table class="mform">
            @foreach ( $list_baiviet as $tennhom => $ds_baiviet )
            <tr>
                <td colspan="3" class="tckh_nhombaiviet">{{$tennhom}}</td>
            </tr>
                @foreach ( $ds_baiviet as $baiviet )
                <tr>
                    <td class="tckh_tacgia tckh_row" width="200px;" style="padding-right:20px">
                    <?php
                        $tg_html = '';
                        if ( $baiviet->tacgia != '' ) {
                            $list_tacgia = json_decode($baiviet->tacgia);
                            if ( $list_tacgia && count($list_tacgia) > 0 ) {
                                foreach ( $list_tacgia as $tg ) {
                                    if ( $tg_html == '' ) $tg_html = $tg;
                                    else $tg_html .= '<br />' . $tg;
                                }
                            }
                        }
                    ?>
                    {{$tg_html}}
                    </td>
                    <td class="tckh_row" valign="top">{{$baiviet->tenbaiviet}}</td>
                    <td class="tckh_row" width="150">
                        <a href="{{url('tckh/xembaiviet')}}?id={{$baiviet->id}}" class="btn btn-primary">Xem</a>
                        <a href="{{url('tckh/downloadfile?idbaiviet='.$baiviet->id)}}" class="btn btn-primary">Tải file</a>
                    </td>
                </tr>
                @endforeach
            @endforeach
        </table>
    </div>
    <div>&nbsp;</div>

</div>
<div>&nbsp;</div>
<div class="news_viewarticle_box">
    <div class="fp-boxtitle" style="text-align: left;border-radius: 4px 4px 0px 0px;">Các số tạp chỉ khác của năm {{$sotapchiinfo->namtapchi}}</div>
    <div>&nbsp;</div>
    <div style="clear:both">
        <ul class="bxslider">
            @foreach ( $list_tapchi_nam as $sotapchi )
                <li onclick="self.location.href='{{url("tckh/xemtapchi?idsotapchi=".$sotapchi->id)}}'">
                    <div class="tckh_item">
                        <img class="tckh_anhbia_thumb" src="{{Config::get('app.url')}}/tckhbia/{{$sotapchi->anhbia == '' ? '_default.gif' : $sotapchi->anhbia}}">
                        <p>Số {{$sotapchi->sotapchi}}</p>
                    </div>
                </li>
            @endforeach
        </ul>
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
</div>

@stop
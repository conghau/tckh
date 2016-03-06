@extends('front-page')

@section('main_content')
<script src="{{Config::get('app.url')}}/asset/js/slider/jquery.bxslider.min.js"></script>
<!-- bxSlider CSS file -->
<link href="{{Config::get('app.url')}}/asset/js/slider/jquery.bxslider.css" rel="stylesheet" />

<div class="news_viewarticle_box">
    <div class="fp-boxtitle" style="text-align: left;border-radius: 4px 4px 0px 0px;">Kết quả tìm kiếm (có {{ $search_result->getTotal() }} kết quả)</div>
    <div class="news_viewarticle_box_content">
		@foreach ( $search_result as $result )
			<div>
				<div class="bbqt_title"><a href="{{ url('tckh/xembaiviet?id='.$result->id) }}">{{ $result->tenbaiviet }}</a></div>
				<div>
				<?php
					$lst_tacgia = '';
					$tmp = $result->tacgia;
					if ( $tmp != '' ) {
						$tmp = json_decode($result->tacgia);
						foreach ( $tmp as $tg ) {
							if ( $tg != '' ) {
								if ( $lst_tacgia == '' ) $lst_tacgia = $tg;
								else $lst_tacgia .= ', ' . $tg;
							}
						}
					}
				?>
				{{ $lst_tacgia }}
				</div>
			</div>
			<hr class="bbqt_hr" />
		@endforeach
    </div>
    <div>&nbsp;</div>
		{{ Paginator::setPageName('searchpage'); }}
		<div align="center">{{ $search_result->appends(array_except(Request::query(), 'searchpage'))->links(); }}</a></div>
</div>

@stop
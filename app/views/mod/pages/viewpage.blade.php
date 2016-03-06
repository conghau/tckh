@extends('front-page')

@section('main_content')
<div class="news_viewarticle_box">
    <div class="fp-boxtitle" style="text-align: left;border-radius: 4px 4px 0px 0px;">{{ $pageinfo->pagetitle }}</div>
    <div class="news_viewarticle_box_content">
			<?php
				# sua bai viet
				if ( isset($userinfo) && @$userinfo->is_access(array('admin_pages')) ) {
			?>
			&nbsp;&nbsp;<a class="btn btn-primary btn-flat btn-rect" target="_blank" href="{{ url('pages/editpage/') }}/{{ $pageinfo->id }}" data-original-title="" title="">Sửa nội dung trang</a>
			<?php
				}
				print '<div>&nbsp;</div>';
			?>
			
			{{ $pageinfo->pagecontent }}
		</div>
</div>
@stop
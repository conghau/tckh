@extends('front-page')

@section('main_content')
<div class="news_viewarticle_box">
    <div class="fp-boxtitle" style="text-align: left;border-radius: 4px 4px 0px 0px;">Tải file</div>
    <div class="news_viewarticle_box_content">
			<div>
				Chính sách dịch vụ:
			</div>
			<div>&nbsp;</div>
			<button class="btn btn-primary" onclick="do_download_file()">Tải file</button>
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".popup-sms-modal">Large modal</button>
	</div>
</div>
@include('popup-sms') 
<script type="text/javascript">
/* $(documment).ready(function(){
	$('#myModal').modal()  
}); */
do_download_file = function() {
	var dtoken = '{{ $dtoken }}';
	var url = '{{ Request::url() }}';
	<?php
		$query = '';
		foreach ( Input::query() as $key => $value ) {
			if ( $query == '' ) $query = $key . '=' . $value;
			else $query .= '&' . $key . '=' . $value;			
		}
		$query = '?' . $query;
	?>
	var query = '{{ $query }}';
	url = url + query + '&dtoken='+dtoken;
	
	self.location.href = url;
}
</script>
@stop
<!DOCTYPE html>
<html lang="en">
<head>        
    <title>{{ Config::get('app.site_title')}}</title>
    
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    
    <link rel="icon" type="image/ico" href="{{ Config::get('app.url') }}/asset/img/ico/favicon.ico"/>
    
    <link href="{{ Config::get('app.url') }}/asset/css/stylesheets.css" rel="stylesheet" type="text/css" />
    
    <script type='text/javascript' src='{{ Config::get('app.url') }}/asset/js/plugins/jquery/jquery.min.js'></script>
    <script type='text/javascript' src='{{ Config::get('app.url') }}/asset/js/plugins/jquery/jquery-ui.min.js'></script>
    <script type='text/javascript' src='{{ Config::get('app.url') }}/asset/js/plugins/jquery/jquery-migrate.min.js'></script>
    <script type='text/javascript' src='{{ Config::get('app.url') }}/asset/js/plugins/jquery/globalize.js'></script>
    <script type='text/javascript' src='{{ Config::get('app.url') }}/asset/js/plugins/bootstrap/bootstrap.min.js'></script>
    
    <script type='text/javascript' src='{{ Config::get('app.url') }}/asset/js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js'></script>
    <script type='text/javascript' src='{{ Config::get('app.url') }}/asset/js/plugins/uniform/jquery.uniform.min.js'></script>
    
    <script type='text/javascript' src='{{ Config::get('app.url') }}/asset/js/plugins/knob/jquery.knob.js'></script>
    <script type='text/javascript' src='{{ Config::get('app.url') }}/asset/js/plugins/sparkline/jquery.sparkline.min.js'></script>
    <script type='text/javascript' src='{{ Config::get('app.url') }}/asset/js/plugins/flot/jquery.flot.js'></script>
    <script type='text/javascript' src='{{ Config::get('app.url') }}/asset/js/plugins/flot/jquery.flot.resize.js'></script>
    
    <script type='text/javascript' src='{{ Config::get('app.url') }}/asset/js/plugins.js'></script>
    <script type='text/javascript' src='{{ Config::get('app.url') }}/asset/js/actions.js'></script>
    <script type='text/javascript' src='{{ Config::get('app.url') }}/asset/js/jquery.cookie.js'></script>
    <script type='text/javascript' src='{{ Config::get('app.url') }}/asset/js/jquery.base64.js'></script>
    <script type='text/javascript' src='{{ Config::get('app.url') }}/asset/js/bootbox.min.js'></script>
    <script type='text/javascript' src='{{ Config::get('app.url') }}/asset/js/tracker.js'></script>
    <script type='text/javascript' src='{{ Config::get('app.url') }}/asset/js/cUtils.js'></script>
    <script type="text/javascript">var wwwroot = '{{Config::get('app.url')}}';</script>
    <style>
    body {
      background: url("{{ Config::get('app.url') }}/asset/img/white.png");
      color: #000066;
      font-family: "Helvetica Neue","Helvetica",Arial,sans-serif;
      height: 100%;
      min-height: 100%;
      font-size: 13px;
    }
    .container.container-fixed {
      max-width: 960px !important;
    }
    </style>
    <link href="{{ Config::get('app.url') }}/asset/css/frontpage.css" rel="stylesheet" type="text/css" />
</head>
<body>
    
    <div class="container container-fixed page-shadow">
        <div class="row" style="height:163px">                   
            <div class="fp-header">
							<div class="pull-right" style="margin-top:50px;margin-right:10px;width:300px;">
								<div class="input-group" style="border:1px solid #0C4CA3;border-radius:4px">
									<span class="input-group-addon" style="background-color:#0C4CA3;"><i class="icon-search"></i> Tìm kiếm tạp chí</span>
									<input id="searchtckw" name="searchtckw" value="{{ Input::get('kw') }}" type="text" class="form-control" placeholder="Nhập từ khóa cần tìm" style="background-color:#fff;color:#333;" />
								</div>
							</div>
							<script type="text/javascript">
							$('#searchtckw').keypress(function(event) {
									var keycode = (event.keyCode ? event.keyCode : event.which);
									if(keycode == '13') {
											self.location.href = '{{ url("tckh/search")}}?kw='+this.value;
									}
							});
							</script>
            </div>
            <div class="fp-menu">
                @include('master-menu')
            </div>
        </div>
				<?php
					# message cua he thong
					if ( Session::has('info_message') ) {
							print '<div style="margin:10px" class="alert alert-info">'.Session::get('info_message').'</div>';
							Session::forget('info_message');
					}
					if ( Session::has('success_message') ) {
							print '<div style="margin:10px" class="alert alert-success">'.Session::get('success_message').'</div>';
							Session::forget('success_message');
					}
					if ( Session::has('error_message') ) {
							print '<div style="margin:10px" class="alert alert-danger">'.Session::get('error_message').'</div>';
							Session::forget('error_message');
					}
					if ( Session::has('warning_message') ) {
							print '<div style="margin:10px" class="alert alert-warning">'.Session::get('warning_message').'</div>';
							Session::forget('warning_message');
					}
					?>
        <div class="row">
            <div class="col-md-6 banner-tckh"></div>
						<div class="col-md-3 fp-right-col pull-right" style="margin-top:10px;">
							<!-- tap chi so moi nhat -->
							<div class="fp-boxhline-r">
								<div class="fp-boxtitle-r">TẠP CHÍ SỐ MỚI NHẤT</div>
								<div align="center">
									@foreach ( $list_tapchi_moinhat as $tapchi )
									<div style="padding-top:10px;">
										<a href="{{ url('tckh/xemtapchi?idsotapchi='.$tapchi->id) }}">
											@if ( $tapchi->anhbia != '' )
											<img src="{{ Config::get('app.url') }}/tckhbia/{{ $tapchi->anhbia }}" style="width:200px" />
											@else
											<img src="{{ Config::get('app.url') }}/tckhbia/_default.gif" style="width:200px" />
											@endif
										</a>
									</div>
									@endforeach
								</div>
							</div>
            </div>
						<div class="col-md-9" style="margin-top: 10px">
                @yield('main_content')
            </div>
						
						@if ( !Input::has('kw') )
						<div class="col-md-9" style="margin-top:10px;">
							<div class="news_viewarticle_box">
								<div class="fp-boxtitle-r" style="text-align: left;border-radius: 4px 4px 0px 0px;">Bài báo được quan tâm nhất</div>
								<div class="news_viewarticle_box_content">
								@foreach ( $list_baibao_quantam as $baibao )
								<div>
									<div class="bbqt_title"><a href="{{ url('tckh/xembaiviet?id='.$baibao->id) }}">{{ $baibao->tenbaiviet }}</a></div>
									<div>
									<?php
										$lst_tacgia = '';
										$tmp = $baibao->tacgia;
										if ( $tmp != '' ) {
											$tmp = json_decode($baibao->tacgia);
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
							</div>
						</div>
						@endif
        </div>

        <div>&nbsp;</div>
        <div class="row">
            <div class="fp-footer">
                <div class="col-md-5" style="padding:15px;">
                    <div>Bản quyền &copy; Trường Đại học Mở Tp.HCM</div>
                    <div>Thiết kế và phát triển bởi Trung tâm Quản lý hệ thống thông tin</div>
                </div>
                {{--<div class="counter-box pull-right">Số lượt truy cập: {{$visitor_count}}</div>--}}
            </div>
        </div>
    </div>

</body>
</html>
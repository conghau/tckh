<!DOCTYPE html>
<html lang="en">
<head>        
    <title>{{ Config::get('app.site_title')}}</title>
    
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    
    <link rel="icon" type="image/ico" href="{{ Config::get('app.url') }}/asset/images/ico/favicon.ico"/>

    <script type="text/javascript">var wwwroot = '{{Config::get('app.url')}}';</script>
    <link href="{{ Config::get('app.url') }}/asset/css/stylesheetsa.css" rel="stylesheet" type="text/css" />

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

    <!-- plugin -->
    <script type='text/javascript' src='{{ Config::get('app.url') }}/asset/js/plugins/jquery/jquery-ui-timepicker-addon.js'></script>
    <script type='text/javascript' src='{{ URL::asset('asset/js/plugins/select2/select2.min.js') }}'></script>
    <script type="text/javascript" src="{{ URL::asset('asset/js/plugins/tagsinput/jquery.tagsinput.min.js') }}"></script>
    <script type='text/javascript' src='{{ URL::asset('asset/js/plugins/cleditor/jquery.cleditor.min.js') }}'></script>

    <link href="{{ Config::get('app.url') }}/asset/js/toastr/toastr.min.css" rel="stylesheet" type="text/css" />
    <script type='text/javascript' src='{{ URL::asset('asset/js/toastr/toastr.min.js') }}'></script>

    <script type='text/javascript' src='{{ Config::get('app.url') }}/asset/js/plugins.js'></script>
    <script type='text/javascript' src='{{ Config::get('app.url') }}/asset/js/actions.js'></script>
    <script type='text/javascript' src='{{ Config::get('app.url') }}/asset/js/charts.js'></script>

    <script type='text/javascript' src='{{ Config::get('app.url') }}/asset/js/settings.js'></script>

    <script type='text/javascript' src='{{ Config::get('app.url') }}/asset/js/jquery.cookie.js'></script>
    <script type='text/javascript' src='{{ Config::get('app.url') }}/asset/js/jquery.base64.js'></script>
    <script type='text/javascript' src='{{ Config::get('app.url') }}/asset/js/bootbox.min.js'></script>
    <script type='text/javascript' src='{{ Config::get('app.url') }}/asset/js/tracker.js'></script>
    <script type="text/javascript" src="{{ URL::asset('asset/js/cUtils.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('asset/js/coremsg.js') }}"></script>

    <link href="{{ Config::get('app.url') }}/asset/css/mystyles.css" rel="stylesheet" type="text/css" />
</head>
<body class="bg-img-num1">
    
    <div class="container">        
        <div class="row">                   
            <div class="col-md-12">
                
                 <nav class="navbar brb" role="navigation">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-reorder"></span>                            
                        </button>                                                
                        <a class="navbar-brand" href="{{url('/')}}"><img src="{{Config::get('app.url')}}/asset/img/logo.png"/></a>
                    </div>
                    <div class="collapse navbar-collapse navbar-ex1-collapse">                                     
                        <ul class="nav navbar-nav">
                            <li>
                                <a href="{{url('/')}}">
                                    <span class="icon-home"></span> Trang chủ
                                </a>
                            </li>
                            @include('mod/adminmenu')
                        </ul>
                    </div>
                </nav>                

            </div>            
        </div>
        <div class="row">
            
            <div class="col-md-2">
                
                <div class="block block-drop-shadow">
                    <div class="user bg-default bg-light-rtl">
                        <div class="info" style="width:100%">
                            <a href="#" class="informer informer-three" style="bottom: 45px;text-align: left;">
                                @if(isset($userinfo) and null !== $userinfo)
                                <span>{{ $userinfo->username }}</span>
                                {{$userinfo->display_name}}
                                @endif
                            </a>
                            <img src="{{url('user/thumbnail')}}" class="img-circle img-thumbnail" style="width:90px;border-radius: 0px;float:right;" />
                        </div>
                    </div>
                    <div class="content list-group list-group-icons">
                        <a href="#" onclick="do_master_changepass()" class="list-group-item"><span class="icon-cogs"></span>Đổi mật khẩu<i class="icon-angle-right pull-right"></i></a>
                        <a href="{{url('logout')}}" class="list-group-item"><span class="icon-off"></span>Thoát quyền sử dụng<i class="icon-angle-right pull-right"></i></a>
                    </div>
                    <script type="text/javascript">
                    do_master_changepass = function() {
                        dialog_route_action('Đổi mật khẩu', '{{ url('user/updateinfo') }}?popup=true', 'fp_user_updateinfo', -1, -1, false);
                    };
                    </script>
                </div> 

            </div>

            <div class="col-md-10">
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
                @yield('main_content')
            </div>
        </div>
        <div class="row">
            <div class="page-footer">
                <div class="page-footer-wrap">
                    <div class="side pull-left">
                        Copyirght &COPY; Trường Đại học Mở Tp.HCM - Trung tâm QLHTTT 2015. Bảo lưu tất cả các quyền.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="statusbar" class="statusbar">
        <div class="statusbar-icon"><img src="{{ URL::asset('asset/img/loader.gif') }}"></div>
        <div class="statusbar-text" id="statusbar-text">Đang xử lý...</div>
        <div class="statusbar-close icon-remove"></div>
    </div>

</body>
</html>
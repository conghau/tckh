@extends( 'layout/default-layout' )

@section('view_content')

<div class="col-md-6">
    <div class="block block-drop-shadow" id="ketquaht">

    </div>

    <div class="block block-drop-shadow">
        <div class="head bg-default bg-light-ltr">
            <h2>
                <h2>Thông tin sinh viên</h2>
            </h2>
        </div>

        <div class="content content-transparent np">
            <div id="thongtinsv">
            </div>
        </div>
    </div>
</div>

<div class="col-md-6">
    <div class="block block-drop-shadow">
        <div class="head bg-default bg-light-ltr">
            <h2>
                <h2>Bảng điểm</h2>
            </h2>
            <div class="side pull-right">
                <ul class="buttons">
                    <li><a href="javascript:;" onclick="do_get_page('{{ cUtils::append_to_url(url("dichvu/xemdiemthi?lbd=TN&blank=true"), array('masv' => Input::get('masv')))}}', 'bangdiem', true);"><span class="icon-refresh"></span></a></li>
                </ul>
            </div>
        </div>

        <div class="content">
            <div id="bangdiem" class="scroll oh" style="height: 400px;">
            </div>
        </div>
    </div>

    <div class="block block-drop-shadow">
        <div class="head bg-default bg-light-ltr">
            <h2>
                <h2>Kế hoạch đào tạo</h2>
            </h2>
            <div class="side pull-right">
                <ul class="buttons">
                    <li><a href="javascript:;" onclick="do_get_page('{{ cUtils::append_to_url(url("dichvu/kehoachdt?blank=true"), array('masv' => Input::get('masv')))}}', 'kehoachdt', true);"><span class="icon-refresh"></span></a></li>
                    <li><a href="javascript:;" onclick=""><span class="icon-cog"></span></a></li>
                </ul>
            </div>
        </div>

        <div class="content">
            <div id="kehoachdt" class="scroll oh" style="height: 400px;">
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$(function() {
    do_get_page = function(url, html_el, scrollpanel) {
        ajax_html(url, html_el, function() {
            if (typeof scrollpanel === 'undefined' || !scrollpanel ) { }
            else {
                $("#"+html_el).mCustomScrollbar({
                    scrollButtons:{
                        enable:true
                    }
                });
            }
        });
    };
    // execute
    do_get_page('{{ cUtils::append_to_url(url("dichvu/xemdiemthi?lbd=TN&blank=true"),array('masv' => Input::get('masv'))) }}', 'bangdiem', true);
    do_get_page('{{ cUtils::append_to_url(url("dichvu/svinfo?blank=true"),array('masv' => Input::get('masv'))) }}', 'thongtinsv', false);
    do_get_page('{{ cUtils::append_to_url(url("dichvu/kehoachdt?blank=true"),array('masv' => Input::get('masv'))) }}', 'kehoachdt', true);
    do_get_page('{{ cUtils::append_to_url(url("dichvu/ketquaht?blank=true"),array('masv' => Input::get('masv'))) }}', 'ketquaht', false);
});
</script>
@stop

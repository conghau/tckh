@extends('front-page')

<?php
$is_editable = false;
$set_hot_action = '';
$set_duyet_action = '';
$set_publish_action = '';
$set_edit_action = '';

if ( isset($userinfo) && $userinfo ) {
    if ( $userinfo->is_access(array('sua_bai_viet', 'admin_news')) ) {
        $is_editable = true;

        $hot = 0;
        $hot_text = 'Đánh dấu là tin nóng';
        if ( $articleinfo->hot != 1 ) {
            $hot = 1;
            $hot_text = 'Đánh dấu là tin nóng';
        }
        else {
            $hot = 0;
            $hot_text = 'Bỏ đánh dấu là tin nóng';
        }

        $set_hot_action = '<li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:;" onclick="do_set_action(\''.url('news/article/sethot/'.$articleinfo->id).'\')">'.$hot_text.'</a></li>';
    }

    if ( $userinfo->is_access(array('duyet_bai_viet','admin_news')) ) {
        $is_editable = true;

        $duyet = 0;
        $duyet_text = 'Bỏ duyệt bài viết';
        if ( $articleinfo->daduyet != 1 ) {
            $duyet = 1;
            $duyet_text = 'Duyệt bài viết';
        }
        else {
            $duyet = 0;
            $duyet_text = 'Bỏ duyệt bài viết';
        }

        $set_duyet_action = '<li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:;" onclick="do_set_action(\''.url('news/article/duyetbaiviet/'.$articleinfo->id.'?duyet='.$duyet).'\')">'.$duyet_text.'</a></li>';
    }

    if ( $userinfo->is_access(array('xuat_ban_bai_viet', 'admin_news')) ) {
        $is_editable = true;

        $xuatban = 0;
        $xuatban_text = 'Bỏ xuất bản bài viết';
        if ( $articleinfo->published != 1 ) {
            $xuatban = 1;
            $xuatban_text = 'Xuất bản bài viết';
        }
        else {
            $xuatban = 0;
            $xuatban_text = 'Bỏ xuất bài viết';
        }

        $set_publish_action = '<li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:;" onclick="do_set_action(\''.url('news/article/publishbaiviet/'.$articleinfo->id.'?publish='.$duyet).'\')">'.$xuatban_text.'</a></li>';
    }

    if ( $userinfo->is_access(array('sua_bai_viet', 'admin_news')) || $userinfo->id == $articleinfo->create_user ) {
        $is_editable = true;

        $set_edit_action = '<li role="presentation"><a role="menuitem" tabindex="-1" href="'.url('news/article/editarticle/'.$articleinfo->id).'">Sửa bài viết</a></li>';
    }
}
?>

@section('main_content')
<?php if ( isset($message) && $message != '' ) { ?><div class="alert alert-danger">{{ $message }}</div><?php } ?>

<div class="news_viewarticle_box">
    <div class="fp-boxtitle" style="text-align: left;border-radius: 4px 4px 0px 0px;"><a href="{{ url('news/viewartilces/'.$catinfo->id) }}">{{ $catinfo->catname }}</a></div>
    <div class="news_viewarticle_box_content">
        <div>
            @if ( $is_editable )
                <div class="dropdown" style="float:left;padding-right:10px;padding-top:7px;">
                  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                    <img id="config_image" src="{{ Config::get('app.url') }}/asset/img/configuration-icon.png" />
                    <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                    {{ $set_hot_action }}
                    {{ $set_duyet_action }}
                    {{ $set_publish_action }}
                    {{ $set_edit_action }}
                  </ul>
                </div>
                <script type="text/javascript">
                do_set_action = function(action_url) {
                    bootbox.confirm('Bạn có chắc là muốn thực hiện thao tác không?', function(result) {
                        if ( result ) {
                            toogle_overlay(true);

                            $('#config_image').attr('src', '{{ Config::get('app.url') }}/asset/img/loading.png');
                            $.ajax({
                                type: 'GET',
                                url: action_url,
                                beforeSend: function() { },
                                error : function() {
                                    toogle_overlay(false);
                                    $('#config_image').attr('src', '{{ Config::get('app.url') }}/asset/img/configuration-icon.png');
                                    bootbox.alert('Lỗi khi thực thi yêu cầu !!!');
                                },
                                success: function(response) {
                                    $('#config_image').attr('src', '{{ Config::get('app.url') }}/asset/img/configuration-icon.png');
                                    if ( response ) {
                                        if ( response.code == 0 ) {
                                            //bootbox.alert(response.message);
                                            self.location.reload();
                                        }
                                        else {
                                            toogle_overlay(false);
                                            bootbox.alert(response.msg);
                                        }
                                    }
                                    else {
                                        toogle_overlay(false);
                                        bootbox.alert('Response is null !!!');
                                    }
                                },
                                dataType: 'json'
                            });
                        }
                    });
                };
                </script>
            @endif

            <label class="news_viewarticle_title">{{ $articleinfo->title }} <span class="news_postdate">({{date('d/m/Y',$articleinfo->post_date)}})</span></label>
        </div>
        <div>
            <?php
                # hien thi/khong hien thi phan summary cua tin
                if ( $articleinfo->notshowsummaryindetail == 1 ) {
                    $content = preg_split('/<div style="summary-break: true"><span style="border-radius:0px">&nbsp;<\/span><\/div>/', $articleinfo_full->full_content_html);

                    if ( $content && count($content) == 2 ) {
                        print '<p class="news_body">'.$content[1].'</p>';
                    }
                    else {
                        print '<p class="news_body">'.$articleinfo_full->full_content_html.'</p>';
                    }
                }
                else {
                    print '<p class="news_body">'.$articleinfo_full->full_content_html.'</p>';
                }
            ?>
        </div>
    </div>
</div>

<!-- tin cung chuyen muc -->
@if ( isset($more_articles) && count($more_articles) > 0 )
<div>&nbsp;</div>
<h3 class="fp-headline">Tin cùng chuyên mục</h3>
<ul class="mul">
	@foreach ( $more_articles as $article )
	<li><a href="{{ url('news/view') }}/{{ $article->title_seo }}">{{ $article->title }}</a> <span class="news_postdate">({{ date('d/m/Y', $article->post_date) }})</span></li>
	@endforeach
</ul>
@endif

@stop
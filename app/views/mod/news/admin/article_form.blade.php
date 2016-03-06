@extends( 'layout/default-layout' )

<?php
    $form_title = '';
    $form_action = 'news/article/createarticle';
    $return_cat_link = url('news/article/listarticle');
    if ( isset($articleinfo) && $articleinfo ) {
        $form_title = 'Sửa bài viết';
        $form_action = 'news/article/editarticle/'.$articleinfo->id;
        $return_cat_link .= '/' . $articleinfo->cat_id;
    }
    else $form_title = 'Thêm bài viết';
?>

@section('main_content')
<link rel="stylesheet" href="{{ Config::get('app.url') . '/' . ('asset/css/chosen.css') }}" type="text/css" media="screen" />
<script type="text/javascript" src="{{ Config::get('app.url') . '/' . ('asset/js/chosen.jquery.js') }}"></script>
<script type="text/javascript" src="{{ Config::get('app.url') . '/' . ('asset/ckeditor/ckeditor.js') }}"></script>

{{
    SystemController::breadcrumb(array(
        array(
            'url' => 'news',
            'title' => 'Thông báo/Tin tức',
            'active' => false
        ),
        array(
            'url' => '',
            'title' => 'Đăng Thông báo/Tin tức',
            'active' => true
        ),
    ))
}}

{{ Form::open(array('url' => $form_action, 'onsubmit' => 'return check_news_article_form();')) }}
<div class="block block-drop-shadow">
    <div class="head bg-default bg-light-ltr">
        <h2>{{$form_title}}</h2>
    </div>

    <div class="content">
        @if ( !empty($message) )
          <div class="alert alert-danger" role="alert">{{$message}}</div>
        @endif

        <table class="mform">
            <tr>
                <td>Chuyên mục:</td>
                <td>
                    <select class="form-control chosen-select" name="cboParentCat" id="cboParentCat">
                        <option value=""></option>
                        {{ $cats_tree }}
                    </select>
                    <script type="text/javascript">
                    $('#cboParentCat').val({{ $cat_id }});
                    </script>
                </td>
            </tr>
            <tr>
                <td>Tiêu đề:</td>
                <td>
                    <input type="text" class="form-control" id="txtTitle" name="txtTitle" maxlength="200" size="100" value="{{ @$articleinfo->title }}" />
                </td>
            </tr>
            <tr>
                <td>Ngày đăng:</td>
                <td>
                    <div class="input-group date">
                        <input type="text" class="form-control datetimepicker" id="txtNgayDang" name="txtNgayDang" data-date-format="DD/MM/YYYY HH:mm" maxlength="50" value="<?php if ( isset($articleinfo) ) { print date('d/m/Y H:i', $articleinfo->post_date); } else { print date('d/m/Y H:i',time()); } ?>" />
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>

                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>
                    <input type="checkbox" name="chkSticky" id="chkSticky" value="1" <?php @$articleinfo->sticky == 1 ? print 'checked="checked"' : ''  ?> /> Luôn hiển thị trước các bài viết khác
                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>
                    <input type="checkbox" name="chkNotShowSummaryInViewDetail" id="chkNotShowSummaryInViewDetail" value="1" <?php @$articleinfo->notshowsummaryindetail == 1 ? print 'checked="checked"' : ''  ?> /> Không hiển thị phầm tóm lượt (Summary) khi xem bài viết
                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>
                    <input type="checkbox" name="chkHot" id="chkHot" value="1" <?php @$articleinfo->hot == 1 ? print 'checked="checked"' : ''  ?> /> Tin nóng
                </td>
            </tr>
            <tr>
                <td valign="top">Bài viết:</td>
                <td><textarea rows="30" id="txtContent" name="txtContent">{{ @$articleinfo_full->full_content_html }}</textarea></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>
                    <button class="btn btn-primary" type="submit">Lưu bài viết</button>

                    <input type="hidden" name="do_save" id="do_save" value="1" />
                </td>
            </tr>
        </table>

	</div>
	<script type="text/javascript">
	var editor = CKEDITOR.replace( 'txtContent', {
	        height:350,
			filebrowserBrowseUrl : '{{ Config::get('app.url') . '/' . ("asset/ckfinder/ckfinder.html") }}',
			filebrowserImageBrowseUrl : '{{ Config::get('app.url') . '/' . ("asset/ckfinder/ckfinder.html?type=Images") }}',
			filebrowserFlashBrowseUrl : '{{ Config::get('app.url') . '/' . ("asset/ckfinder/ckfinder.html?type=Flash") }}',
			filebrowserUploadUrl : '{{ Config::get('app.url') . '/' . ("asset/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files") }}',
			filebrowserImageUploadUrl : '{{ Config::get('app.url') . '/' . ("asset/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images") }}',
			filebrowserFlashUploadUrl : '{{ Config::get('app.url') . '/' . ("asset/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash") }}'
    });
		
	check_news_article_form = function() {
	    if ( $('#cboParentCat').val() == '' ) {
            $('#cboParentCat').focus();
            bootbox.alert('Chưa chọn chuyên mục !!!');
            return false;
        }
        if ( $('#txtTitle').val() == '' ) {
            $('#txtTitle').focus();
            bootbox.alert('Chưa nhập tiêu đề bài viết !!!');
            return false;
        }
	    if ( editor.getData() == '' ) {
	        $('#txtContent').focus();
	        bootbox.alert('Chưa nhập nội dung bài viết !!!');
	        return false;
	    }

		return true;
	};

	$('.chosen-select').chosen({
        allow_single_deselect: true,
        search_contains: true,
        width: '100%'
    });
	</script>
	<div class="footer"></div>
</div>
{{ Form::close() }}
@stop

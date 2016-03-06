@extends( 'layout/default-layout' )
<?php
    $form_action = 'weblink/add';
    $form_title = '';
    if ( isset($weblinkinfo) && $weblinkinfo ) {
        $form_title = 'Sửa thông tin weblink';
        $form_action = 'weblink/edit?id='.$weblinkinfo->id;
    }
    else $form_title = 'Thêm Web link';
?>
@section('main_content')
{{
    SystemController::breadcrumb(array(
        array(
            'url' => 'weblink/list',
            'title' => 'Danh sách liên kết web',
            'active' => false
        ),
        array(
            'url' => '',
            'title' => $form_title,
            'active' => true
        ),
    ))
}}
<div class="block block-drop-shadow">

    <div class="head bg-default bg-light-ltr">
        <h2>{{ $form_title }}</h2>
    </div>

    <div class="content">
        <?php if ( !empty($message) ) { ?>
          <div class="alert alert-danger" role="alert"><?php echo $message ?></div>
        <?php } ?>

        {{ Form::open(array('url' => $form_action, 'files'=>true, 'onsubmit' => 'return check_weblink_form();')) }}
        <table class="mform">
            <tr>
                <td>Tiêu đề:</td>
                <td>
                    <input type="text" class="form-control" id="txtTitle" name="txtTitle" maxlength="200" value="{{ @$weblinkinfo->link_title }}" />
                </td>
            </tr>
            <tr>
                <td>Liên kết (URL):</td>
                <td>
                 <input type="text" class="form-control" id="txtURL" name="txtURL" maxlength="255" value="{{ @$weblinkinfo->link_url }}" />
                </td>
            </tr>
            <tr>
                <td>Thứ tự:</td>
                <td>
                 <input type="text" class="form-control" id="txtOrder" name="txtOrder" maxlength="5" value="{{ @$weblinkinfo->link_order }}" />
                </td>
            </tr>
            <tr>
                <td valign="top">Logo:</td>
                <td>
                    <input type="file" name="fileLogo" id="fileLogo" />
                    @if ( isset($weblinkinfo) && $weblinkinfo && $weblinkinfo->link_image != '' )
                    <div style="width:200px;height:300px;border:1px solid #f2f2f2;">
                        <div style="text-align: right;background-color: #333;padding:4px;"><a href="javascript:;" onclick="weblink_checkxoa_image(this)"><span class="icon-remove"></span></a></div>
                        <img src="{{Config::get('app.url')}}/weblink/{{$weblinkinfo->link_image}}" style="width:199px;height:300px" />
                    </div>
                    @endif
                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>
                    <button class="btn btn-primary" type="submit">Lưu thông tin</button>
                    <input type="hidden" name="do_save" id="do_save" value="1" />
                    <input type="hidden" name="xoaimage" id="xoaimage" value="0" />
                </td>
            </tr>
        </table>
        {{ Form::close() }}
        <script type="text/javascript">
        check_weblink_form = function() {
            if ( $('#txtTitle').val() == '' ) {
                $('#txtTitle').focus();
                alert('Chưa nhập tiêu đề liên kết web !!!');
                return false;
            }
            return true;
        };
        weblink_checkxoa_image = function(from_el) {
            $(from_el).parent().parent().remove();
            $('#xoaimage').val(1);
        };
        </script>
    </div>
</div>


@stop

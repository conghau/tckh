@extends( 'layout/default-layout' )
<?php
    $form_action = 'news/cat/createcat';
    $form_title = '';
    if ( isset($catinfo) && $catinfo ) {
        $form_title = 'Sửa thông tin chuyên mục';
        $form_action = 'news/cat/editcat/'.$catinfo->id;
    }
    else $form_title = 'Thêm chuyên mục';
?>
@section('main_content')
{{
    SystemController::breadcrumb(array(
        array(
            'url' => 'news',
            'title' => 'Thông báo/Tin tức',
            'active' => false
        ),
        array(
            'url' => 'news/cat/listcat',
            'title' => 'Danh sách chuyên mục',
            'active' => false
        ),
        array(
            'url' => '',
            'title' => 'Tạo chuyên mục',
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

        {{ Form::open(array('url' => $form_action, 'onsubmit' => 'return check_news_cat_form();')) }}
        <table class="mform">
            <tr>
                <td>Tên chuyên mục</td>
                <td>
                    <input type="text" class="form-control" id="txtCatName" name="txtCatName" maxlength="100" value="{{ @$catinfo->catname }}" />
                </td>
            </tr>
            <tr>
                <td>Chuyên mục con của</td>
                <td>
                    <select class="form-control" name="cboParentCat" id="cboParentCat">
                        <option value="0">*** Chọn chuyên mục ***</option>
                        {{ $cats_tree }}
                    </select>
                    <script type="text/javascript">
                    $('#cboParentCat').val({{ $parent_cat_id }});
                    </script>
                </td>
            </tr>
            <tr>
                <td>Diễn giải</td>
                <td>
                    <input type="text" class="form-control" id="txtDesc" name="txtDesc" maxlength="200" size="50" value="{{ @$catinfo->catdesc }}" />
                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>
                    <button class="btn btn-primary" type="submit">Lưu thông tin</button>
                    <input type="hidden" name="do_save" id="do_save" value="1" />
                </td>
            </tr>
        </table>
        {{ Form::close() }}
        <script type="text/javascript">
        check_news_cat_form = function() {
            if ( $('#txtCatName').val() == '' ) {
                $('#txtCatName').focus();
                alert('Chưa nhập tên chuyên mục !!!');
                return false;
            }
            return true;
        }
        </script>
    </div>
</div>


@stop

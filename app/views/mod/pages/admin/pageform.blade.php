@extends( Input::has('popup') ? '../../master-index-popup' : '../../master-index')
<?php
    $form_action = 'pages/createpage';
    $form_title = '';
    if ( isset($pageinfo) && $pageinfo ) {
        $form_title = 'Quản lý Trang / Sửa trang';
        $form_action = 'pages/editpage/'.$pageinfo->id;
    }
    else $form_title = 'Quản lý Trang / Thêm trang mới';
?>
@section('main_content')
<script type="text/javascript" src="{{ Config::get('app.url') . '/' . ('asset/ckeditor/ckeditor.js') }}"></script>

{{
    SystemController::breadcrumb(array(
        array(
            'url' => '',
            'title' => 'Quản lý Trang',
            'active' => true
        ),
    ))
}}

<div class="block block-drop-shadow">

    <div class="head bg-default bg-light-ltr">
        <h2>{{ $form_title }}</h2>
        <div class="side pull-right">
            <ul class="buttons">
                <li><a href="{{ url('pages/createpage') }}" class="tip" title="Thêm Trang"><span class="icon-plus"></span></a></li>
            </ul>
        </div>
    </div>

    <div class="content">
        <?php if ( !empty($message) ) { ?>
          <div class="alert alert-danger" role="alert"><?php echo $message ?></div>
        <?php } ?>

        {{ Form::open(array('url' => $form_action, 'onsubmit' => 'return check_page_form();')) }}

        	<ul id="myTab" class="nav nav-tabs">
               <li class="active">
                  <a href="#pages-home" data-toggle="tab">
                     Thông tin chung
                  </a>
               </li>
               <li><a href="#pages-perms" data-toggle="tab">Quyền truy cập</a></li>
            </ul>
            <div id="myTabContent" class="tab-content">
                <div class="tab-pane fade in active" id="pages-home">
                    <table class="mform">
                        <tr>
                            <td>Gán vào Menu</td>
                            <td>
                                <select class="form-control" name="cboMenu" id="cboMenu">
                                    <option value="0">*** Không gắn vào menu ***</option>
                                    {{ $menus }}
                                </select>
                                <script type="text/javascript">
                                <?php
                                    if ( isset($menuinfo) && $menuinfo ) {
                                ?>
                                    $('#cboMenu').val('{{ $menuinfo->id }}');
                                <?php
                                    }
                                ?>
                                </script>
                            </td>
                        </tr>
                        <tr>
                            <td>Tên trang</td>
                            <td>
                                <input type="text" class="form-control" id="txtPageName" name="txtPageName" maxlength="200" size="100" value="{{ @$pageinfo->pagename }}" />
                            </td>
                        </tr>
                        <tr>
                            <td>Tiêu đề trang</td>
                            <td>
                                <input type="text" class="form-control" id="txtPageTitle" name="txtPageTitle" maxlength="200" size="100" value="{{ @$pageinfo->pagename }}" />
                            </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>
                                <input type="checkbox" name="chkHiddenPage" id="chkHiddenPage" value="1" <?php @$pageinfo->page_is_hidden == 1 ? print 'checked="checked"' : ''  ?> /> Ẩn không hiển thị trang
                            </td>
                        </tr>
                        <tr>
                            <td valign="top">Nội dung trang</td>
                            <td><textarea rows="15" id="txtPageContent" name="txtPageContent">{{ @$pageinfo->pagecontent }}</textarea></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>

                                <input type="hidden" name="do_save" id="do_save" value="1" />
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="tab-pane fade in" id="pages-perms">
                    <?php
                    foreach ( $list_perms as $perm ) {
                      $mn = md5($perm->mod_name);

                      print '<div class="block">'.
                          '<div class="header">'.
                          '<input class="form-control" type="checkbox" onclick="check_all_perms(this.checked,\''.$mn.'\')" style="margin-left:10px;" /> '.' <b>'.
                          '<a href="javascript:;" onclick="do_exp_perms_list(\''.$mn.'\')"><span class="icon-angle-down"></span> '.
                          $perm->mod_name.'</b> </a></div>'.
                          '<div class="content" id="perms_'.$mn.'" style="display:none;padding-left:20px">';
                      if ( $perm->permissions && count($perm->permissions) > 0 ) {
                          foreach ( $perm->permissions as $p) {
                              print '<div style="margin-left:25px;padding:5px;">'.
                                  '<input type="checkbox" class="form-control chkperm'.$p->p_code.'" rel="mod_'.$mn.'" name="perms[]" id="perms[]" value="'.$p->p_code.'" /> '.
                                  $p->p_name.
                                  '</div>';
                          }
                      }
                      print '</div>';
                      print '</div>';
                    }
                    ?>
                </div>
            </div>
            <div>&nbsp;</div>
        	<button type="submit" class="btn btn-primary btn-flat btn-rect">Lưu thông tin</button>
        	{{ Form::close() }}
        	<script type="text/javascript">
        	$(function() {
        	    $('div.block div.header div.checker').css('margin-left', '5px');
        	});

        	var editor = CKEDITOR.replace( 'txtPageContent', {
        			filebrowserBrowseUrl : '{{ Config::get('app.url') . '/' . ("asset/ckfinder/ckfinder.html") }}',
        			filebrowserImageBrowseUrl : '{{ Config::get('app.url') . '/' . ("asset/ckfinder/ckfinder.html?type=Images") }}',
        			filebrowserFlashBrowseUrl : '{{ Config::get('app.url') . '/' . ("asset/ckfinder/ckfinder.html?type=Flash") }}',
        			filebrowserUploadUrl : '{{ Config::get('app.url') . '/' . ("asset/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files") }}',
        			filebrowserImageUploadUrl : '{{ Config::get('app.url') . '/' . ("asset/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images") }}',
        			filebrowserFlashUploadUrl : '{{ Config::get('app.url') . '/' . ("asset/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash") }}'
            });

        	check_page_form = function() {
        		if ( $('#txtPageName').val() == '' ) {
        			$('#txtPageName').focus();
        			alert('Chưa nhập tên trang !!!');
        			return false;
        		}
        		if ( $('#txtPageTitle').val() == '' ) {
        			$('#txtPageTitle').focus();
        			alert('Chưa nhập tên tiêu đề trang !!!');
        			return false;
        		}
        		return true;
        	};

        	/* perms */
            var selected_perms = Array();
            <?php
                if ( isset($pageinfo) && $pageinfo ) {
                    $list = explode(',', $pageinfo->allow_perms);
                    if ( $list && count($list) > 0 )
                    foreach ( $list as $p ) {
                        print 'selected_perms.push("'.$p.'");';
                    }
                }
            ?>
            if ( selected_perms.length > 0 ) {
                for ( i=0; i<selected_perms.length; i++ ) {
                    $('.chkperm'+selected_perms[i]).prop('checked', true);
                }
            }

            check_all_perms = function(checked, mod_name) {
                var lperms = $('[rel="mod_'+mod_name+'"]');
                if ( lperms && lperms.length > 0 ) {
                    for (i=0;i<lperms.length;i++) {
                        //lperms[i].checked = checked;
                        $(lperms[i]).trigger('click');
                    }
                }
            };
            check_role_form = function() {
                if ( $('#txtRoleName').val() == '' ) {
                    $('#txtRoleName').focus();
                    bootbox.alert('Chưa nhập tên vai trò !!!');
                    return false;
                }

                return true;
            };
            do_exp_perms_list = function(mod_name) {
                $('#perms_'+mod_name).slideToggle();
            };
        	</script>
    </div>
</div>


@stop

@extends( 'layout/default-layout' )

<?php
    $page_title = 'Quản lý Menu / ';
    $form_action = 'menu/createmenu'.$action_is_popup;
    if ( isset($menuinfo) && $menuinfo ) {
        $page_title .= 'Sửa menu';
        $form_action = 'menu/editmenu/'.$menuinfo->id.$action_is_popup;
    }
    else $page_title .= 'Thêm Menu';
?>

@section('view_content')
<div class="block" style="margin:10px;">

    <div class="content">
        <p>
            <?php if ( !empty($message) ) { ?>
              <div class="alert alert-danger" role="alert"><?php echo $message ?></div>
            <?php } ?>

            {{ Form::open(array('url' => $form_action, 'onsubmit' => 'return check_menu_form();')) }}

            	<ul id="myTab" class="nav nav-tabs">
                   <li class="active">
                      <a href="#menu-home" data-toggle="tab">
                         Thông tin chung
                      </a>
                   </li>
                   <li><a href="#menu-perms" data-toggle="tab">Quyền truy cập</a></li>
                </ul>
                <div id="myTabContent" class="tab-content">
                   <div class="tab-pane fade in active" id="menu-home">
                      <table class="mform">
                          <tr>
                              <td>Menu con của</td>
                              <td>
                                  <select id="cboParentID" name="cboParentID" class="form-control">
                                      <option value="">*** Menu gốc ***</option>
                                  {{ $all_menus }}
                                  </select>
                                  <script type="text/javascript">
                                  <?php
                                  if ( isset($parent_menu_info) && $parent_menu_info ) {
                                  ?>
                                  $('#cboParentID').val('{{ $parent_menu_info->id }}');
                                  <?php
                                  }
                                  ?>
                                  </script>
                              </td>
                          </tr>
                          <tr>
                              <td>Tiêu đề</td>
                              <td>
                                  <input type="text" class="form-control" id="txtTitle" name="txtTitle" maxlength="200" size="100" value="{{ @$menuinfo->title }}" />
                              </td>
                          </tr>
                          <tr>
                              <td>Link</td>
                              <td>
                                  <span class="input-group-btn">
                                      <div class="input-group">
                                          <input type="text" class="form-control" id="txtLink" name="txtLink" maxlength="200" size="100" value="{{ @$menuinfo->link }}" />
                                          <span class="input-group-btn">
                                              <button onclick="open_choice_page()" class="btn btn-primary btn-flat btn-rect" type="button">Chọn trang...</button>
                                          </span>
                                      </div>
                                  </span>
                              </td>
                          </tr>
                          <tr>
                              <td>Thứ tự</td>
                              <td>
                                  <input type="text" class="form-control" id="txtOrder" name="txtOrder" maxlength="5" size="5" value="{{ @$menuinfo->orderno }}" />
                              </td>
                          </tr>
                          <tr>
                              <td>Target</td>
                              <td>
                                  <select class="form-control" id="cboTarget" name="cboTarget">
                                      <option value="">*** Mặc định ***</option>
                                      <option value="_blank">Trang mới</option>
                                      <option value="_top">Cửa sổ mới</option>
                                      <script type="text/javascript">
                                      <?php
                                      if ( isset($menuinfo) && $menuinfo ) {
                                      ?>
                                      $('').val('{{ $menuinfo->linktarget }}');
                                      <?php
                                      }
                                      ?>
                                      </script>
                                  </select>
                              </td>
                          </tr>
                          <tr>
                              <td>&nbsp;</td>
                              <td>
                                  <input type="checkbox" name="chkHidden" id="chkHidden" value="1" <?php @$menuinfo->is_hidden == 1 ? print 'checked="checked"' : ''  ?> /> Ẩn không hiển thị
                              </td>
                          </tr>
                          <tr>
                              <td>&nbsp;</td>
                              <td>

                                  <input type="hidden" name="do_save" id="do_save" value="1" />
                              </td>
                          </tr>
                      </table>
                   </div>
                   <div class="tab-pane fade" id="menu-perms">
                      <?php
                          foreach ( $list_perms as $perm ) {
                              $mn = md5($perm->mod_name);

                              print '<div class="block">'.
                                  '<div class="header">'.
                                  '<input type="checkbox" onclick="check_all_perms(this.checked,\''.$mn.'\')" /> '.
                                  '<a href="javascript:;" onclick="do_exp_perms_list(\''.$mn.'\')"><span class="icon-angle-down"></span> <b>'.$perm->mod_name.'</b> </a>'.
                                  '</div>'.
                                  '<div class="content" id="perms_'.$mn.'" style="padding-left:20px;display:none">';
                              if ( $perm->permissions && count($perm->permissions) > 0 ) {
                                  foreach ( $perm->permissions as $p) {
                                      print '<div style="padding:5px;padding-left:30px">'.
                                          '<input type="checkbox" class="chkperm'.$p->p_code.'" rel="mod_'.$mn.'" name="perms[]" id="perms[]" value="'.$p->p_code.'" /> '.
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
                <button class="btn btn-primary" type="submit">Lưu thông tin</button>
            	{{ Form::close() }}
            	<script type="text/javascript">
            	$(function() {
            	    $('div.block div.header div.checker').css('margin-left','5px');
            	});
            	check_menu_form = function() {
            		if ( $('#txtTitle').val() == '' ) {
            			$('#txtTitle').focus();
            			bootbox.alert('Chưa nhập tiêu đề menu !!!');
            			return false;
            		}
            		return true;
            	};

            	open_choice_page = function() {
            		dialog_route('Chọn trang link đến cho menu', '{{ url("menu/getpages?popup=true") }}', 'menu_getpages',750);
            	};

            	/* perms */
            	var selected_perms = Array();
                <?php
                    if ( isset($menuinfo) && $menuinfo ) {
                        $list = explode(',', $menuinfo->allow_perms);
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
        </p>
    </div>
</div>

@stop

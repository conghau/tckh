@extends( 'layout/default-layout' )

@section('main_content')
	<?php
	    $is_popup = '';
	    if ( Input::has('popup') ) $is_popup = '?popup=true';
	    $page_title = 'Thêm nhóm chức năng';
		$form_action = 'roles/createrole'.$is_popup;
		if ( isset($roleinfo) && $roleinfo ) {
			$form_action = 'roles/editrole/'.$roleinfo->id.$is_popup;
		}
	?>
	<?php if (!Input::has('popup')) { ?>
	<h3 class="text-primary">Phân quyền / {{ $page_title }}</h3>
	<?php } ?>
	<?php if ( !empty($message) ) { ?>
	  <div class="alert alert-danger" role="alert"><?php echo $message ?></div>
	<?php } ?>
	{{ Form::open(array('url' => $form_action, 'id' => 'popup-validation', 'onsubmit' => 'return check_role_form();')) }}
	<table class="mform">
		<tr>
			<td>Tên vai trò</td>
			<td><input type="text" class="form-control" id="txtRoleName" name="txtRoleName" size="50" value="{{ @$roleinfo->role_name }}" /></td>
		</tr>
		<tr>
		    <td valign="top">Được phép sử dụng chức năng:</td>
		    <td>
                <div style="height:300px;overflow:auto">
                    <?php
                        foreach ( $list_perms as $perm ) {
                            $mn = md5($perm->mod_name);

                            print '<div class="list list-contacts">'.
                                    '<a class="list-item" href="javascript:;" onclick="do_exp_perms_list(\''.$mn.'\')">'.
                                        '<div class="list-text">'.
                                        '<span class="icon-angle-down"></span> '.$perm->mod_name.'</div>'.
                                    '</a>'.
                                  '</div>';

                            //print '<div style="background-color:#f2f2f2;padding:5px;color:#000066">'.
                            //    '<input type="checkbox" onclick="check_all_perms(this.checked,\''.$mn.'\')" /> '.
                            //    '<a href="javascript:;" onclick="do_exp_perms_list(\''.$mn.'\')"><b>'.$perm->mod_name.'</b> <span class="caret"></span></a>'.
                            //    '</div>';
                            if ( $perm->permissions && count($perm->permissions) > 0 ) {
                                //print '<ul id="perms_'.$mn.'" class="unstyled" style="padding-left:20px">';
                                print '<div style="padding-left:15px;display:none" id="perms_'.$mn.'">';
                                foreach ( $perm->permissions as $p) {
                                    //print '<li>'.
                                    //    '<input type="checkbox" class="chkperm'.$p->id.'" rel="mod_'.$mn.'" name="perms[]" id="perms[]" value="'.$p->id.'" /> '.
                                    //    $p->p_name.
                                    //    '</li>';
                                    print '<div class="list list-contacts">'.
                                        '<a class="list-item" href="#">'.
                                            '<div class="list-text" style="margin-left:15px">'.
                                            '<input type="checkbox" class="chkperm'.$p->id.'" rel="mod_'.$mn.'" name="perms[]" id="perms[]" value="'.$p->id.'" /> '.
                                            $p->p_name.
                                            '</div>'.
                                        '</a>'.
                                      '</div>';
                                }
                                //print '</ul>';
                                print '</div>';
                            }
                        }
                    ?>
                </div>
		    </td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>
			    <button type="submit" class="btn btn-primary">Lưu thông tin</button>
				<input type="hidden" name="do_save" id="do_save" value="1" />
			</td>
		</tr>
	</table>
	{{ Form::close() }}
	<script type="text/javascript">
	$(function() {
	    var selected_perms = Array();
        <?php
            if ( isset($roleinfo) && $roleinfo ) {
                foreach ( $roleinfo->permissions as $p ) {
                    print 'selected_perms.push('.$p->permission_id.');';
                }
            }
        ?>
        if ( selected_perms.length > 0 ) {
            for ( i=0; i<selected_perms.length; i++ ) {
                $('.chkperm'+selected_perms[i]).prop('checked', true);
            }
        }

        check_all_perms = function(checked, mod_name) {
            alert('test');
            var lperms = $('[rel="mod_'+mod_name+'"]');
            if ( lperms && lperms.length > 0 ) {
                for (i=0;i<lperms.length;i++) {
                    lperms[i].checked = checked;
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
	});
	</script>
@stop

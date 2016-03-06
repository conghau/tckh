@extends( 'layout/default-layout' )
<?php
    $form_action = 'user/createuser';
    if ( isset($currentuser) && $currentuser ) {
        $form_title = 'Quản lý User / Sửa thông tin User';
        $form_action = 'user/edituser/' . $currentuser->id;
    }
    else $form_title = 'Quản lý User / Thêm User';


?>
@section('view_content')
{{ Form::open(array('url' => $form_action.$action_is_popup, 'id' => 'popup-validation', 'onsubmit' => 'return check_user_form();')) }}

<div>
    <div class="block block-drop-shadow">

        <div class="head bg-default bg-light">
            <h2>Thông tin User</h2>
        </div>

        <div class="content">
            <table class="mform">
                <tr>
                    <td>Tên đăng nhập:</td>
                    <td>
                        <input value="{{ @$currentuser->username }}" type="text" class="form-control" id="txtUsername" size="40" name="txtUsername" />
                    </td>
                </tr>
                <tr>
                    <td>Mật khẩu:</td>
                    <td>
                        <input type="password" class="form-control" id="txtPassword" name="txtPassword" maxlength="15" />
                    </td>
                </tr>
                <tr>
                    <td>Tên hiển thị:</td>
                    <td>
                        <input value="{{ @$currentuser->display_name }}" type="text" class="form-control" id="txtDisplayName" name="txtDisplayName" />
                    </td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td>
                        <input value="{{ @$currentuser->email }}" type="text" class="form-control" id="txtEmail" name="txtEmail" />
                    </td>
                </tr>
                <tr>
                    <td valign="top">Vai trò:</td>
                    <td valign="top">

                        <?php foreach ( $list_roles as $role ) { ?>
                        <div style="padding:3px;padding-left:20px">
                            <input type="checkbox" class="role{{ $role->id }}" id="roles[]" name="roles[]" value="{{ $role->id }}" />
                                <a href="javascript:;" onclick="do_get_role_perms({{ $role->id }})"><span class="icon-angle-down"></span> {{ $role->role_name }}</a>
                            <div id="role_perms_{{ $role->id }}" style="display: none;">
                            </div>
                        </div>
                        <?php } ?>
                        <?php
                        print '<script type="text/javascript">';
                        if ( isset($currentuser) && $currentuser ) {
                            foreach ( $user_roles as $urole ) {
                                print '$(".role'.$urole->role_id.'").attr("checked","checked");';
                            }
                        }
                        print '</script>';
                        ?>
                    </td>
                </tr>
                <tr>
                    <td valign="top">&nbsp;</td>
                    <td>
                        <button type="submit" class="btn btn-primary">Lưu thông tin</button>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>

{{ Form::close() }}

<script type="text/javascript">
check_user_form = function() {
    if ( $('#txtUsername').val() == '' ) {
        $('#txtUsername').focus();
        bootbox.alert('Chưa nhập tên tài khoản !!!');
        return false;
    }
    @if ( !isset($currentuser) || !$currentuser )
    if ( $('#txtPassword').val() == '' ) {
        $('#txtPassword').focus();
        bootbox.alert('Chưa nhập mật khẩu !!!');
        return false;
    }
    @endif
    return true;
};
do_get_role_perms = function(role_id) {
    $.ajax({
        type: 'GET',
        url: "{{ url('roles/getroleperms') }}/"+role_id,
        beforeSend: function() { },
        error : function() {
            bootbox.alert('Lỗi khi lấy thông tin quyền của vai trò !!!');
        },
        success: function(response) {
            if ( response ) {
                if ( response.data && response.data.length > 0 ) {
                    var html = '';
                    for ( i=0; i<response.data.length; i++ ) {
                        html += '<li>'+response.data[i].p_name+'</li>';
                    }
                    $('#role_perms_'+role_id).html('<ul style="padding-left:30px;line-height:25px;">'+html+'</ul>');
                    $('#role_perms_'+role_id).slideToggle()();
                }
                else {
                    $('#role_perms_'+role_id).html('<span style="padding-left:20px;font-size:11px;color:#990000"><i>Không có chức năng !</i></span>');
                    $('#role_perms_'+role_id).slideToggle()();
                }
            }
            else {
                bootbox.alert('Response is null !!!');
            }
        },
        dataType: 'json'
    });
}
</script>
@stop

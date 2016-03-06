@extends( 'layout/default-layout' )

@section('view_content')
<div class="block block-drop-shadow">
    @if ( !Input::has('popup') )
    <div class="head bg-default bg-light-ltr">
        <h2>
            <h2>Tài khoản / Cập nhật thông tin tài khoản</h2>
        </h2>
    </div>
    @endif

    <div class="content">
        {{ Form::open(array('url' => 'user/updateinfo'. (Input::has('popup') ? '?popup=true' : ''), 'onsubmit' => 'return check_updateinfo_form();')) }}
        <table cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <td valign="top">
                    <table class="mform">
                        <tr>
                            <td>Tên đăng nhập</td>
                            <td>
                                <b>{{ @$userinfo->username }}</b>
                            </td>
                        </tr>
                        <tr>
                            <td>Tên hiển thị</td>
                            <td>
                                <input value="{{ @$userinfo->display_name }}" type="text" class="form-control" id="txtDisplayName" name="txtDisplayName" />
                            </td>
                        </tr>
                        <tr>
                            <td>Mật khẩu mới</td>
                            <td>
                                <input type="password" class="form-control" id="txtPassword" name="txtPassword" maxlength="15" />
                                <script type="text/javascript">
                                $(function ()
                                {
                                    $('#txtPassword').popover(
                                    {
                                         trigger: 'hover',
                                         html: true,
                                         placement: 'top',
                                         content: 'Bỏ trống để giữ lại mật khẩu cũ'
                                    });
                                });
                                </script>
                            </td>
                        </tr>
                        <tr>
                            <td>Nhập lại mật khẩu mới</td>
                            <td>
                                <input type="password" class="form-control" id="txtPassword1" name="txtPassword1" maxlength="15" />
                            </td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>
                                <input value="{{ @$userinfo->email }}" type="text" class="form-control" id="txtEmail" name="txtEmail" maxlength="255" size="30" />
                            </td>
                        </tr>
                        <tr>
                            <td valign="top">&nbsp;</td>
                            <td>
                                <input type="submit" value="Cập nhật thông tin" class="btn btn-primary btn-flat btn-rect" />
                                <input type="hidden" value="1" name="do_save" id="do_save" />
                            </td>
                        </tr>
                    </table>
                </td>
                <td valign="top">
                    &nbsp;
                </td>
            </tr>
        </table>
        <div style="clear:both"></div>
        {{ Form::close() }}
        <script type="text/javascript">
        check_updateinfo_form = function() {
            if ( $('#txtPassword').val() != '' ) {
                if ( $('#txtPassword').val() != $('#txtPassword1').val() ) {
                    bootbox.alert('Mật khẩu mới nhập vào 2 lần không giống nhau !!!');
                    $('#txtPassword').focus();
                    return false;
                }
            }
            return true;
        };
        </script>
	</div>

	<div class="footer"></div>
</div>
@stop

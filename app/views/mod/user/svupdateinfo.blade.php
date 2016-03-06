@extends( 'layout/default-layout' )

@section('view_content')
<div class="block block-drop-shadow">
    @if ( !Input::has('popup') )
    <div class="head bg-default bg-light-ltr">
        <h2>
            Tài khoản / Đổi mật khẩu
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
                            <td>Mã SV:</td>
                            <td>
                                <b>{{ @$userinfo->username }}</b>
                            </td>
                        </tr>
                        <tr>
                            <td>Họ tên:</td>
                            <td>
                                <b>{{$userinfo->display_name}}</b>
                            </td>
                        </tr>
                        <tr>
                            <td>Mật khẩu cấp 1 mới:</td>
                            <td>
                                <input type="password" class="form-control" id="txtPasswordL1" name="txtPasswordL1" maxlength="15" />
                                <script type="text/javascript">
                                $(function ()
                                {
                                    $('#txtPasswordL1').popover(
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
                            <td>Mật khẩu cấp 2 mới:</td>
                            <td>
                                <input type="password" class="form-control" id="txtPasswordL2" name="txtPasswordL2" maxlength="15" />
                                <script type="text/javascript">
                                $(function ()
                                {
                                    $('#txtPasswordL2').popover(
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
                            <td valign="top">&nbsp;</td>
                            <td>
                                <button type="submit" class="btn btn-primary">Cập nhật thông tin</button>
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

            return true;
        };
        </script>
	</div>

	<div class="footer"></div>
</div>
@stop

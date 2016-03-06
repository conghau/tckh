@extends( 'layout/default-layout' )

@section('view_content')
{{
    SystemController::breadcrumb(array(
        array(
            'url' => 'user/list',
            'title' => 'Quản lý User',
            'active' => false
        ),
        array(
            'url' => '',
            'title' => 'Danh sách User',
            'active' => true
        ),
    ))
}}

<div class="block block-drop-shadow">

    <div class="head bg-default bg-light-ltr">
        <h2>Quản lý User / Danh sách User</h2>
        <div class="side pull-right">
            <ul class="buttons">
                <li><a href="javascript:;" onclick="do_userlist_create_user()" class="tip" title="Thêm User"><span class="icon-plus"></span></a></li>
            </ul>
        </div>
    </div>

    <div class="content">
        	<div class="form-group">
                <div class="input-group">
                    <div class="input-group-addon">Tìm user:</div>
                    <input type="text" class="form-control" name="txtKWUser" id="txtKWUser" value="{{ Input::get('kw') }}" placeholder="Tìm trong 'Tên đăng nhập' và 'Họ tên'" size="50" />
                </div>
                <script type="text/javascript">
                $('#txtKWUser').keypress(function( event ) {
                		if ( event.which == 13 ) {
                			self.location.href = '{{ url("user/list?kw=") }}'+$('#txtKWUser').val();
                			event.preventDefault();
                		}
                	});
                </script>
            </div>
            <table class="table table-bordered responsive-table table-hover">
        	  <thead>
        		<tr>
        		  <th>STT</th>
        		  <th>#</th>
        		  <th><span class="caret"><sup>(3)</sup></span>&nbsp;&nbsp;&nbsp;Tên đăng nhập</th>
        		  <th>Họ tên</th>
        		  <th><span class="caret"><sup>(2)</sup></span>&nbsp;&nbsp;&nbsp;Last access</th>
        		  <th><span class="caret"><sup>(1)</sup></span>&nbsp;&nbsp;&nbsp;Super admin</th>
        		  <th>&nbsp;</th>
        		  <th>&nbsp;</th>
        		</tr>
        	  </thead>
        	  <tbody>
        		<?php
        		    $stt = cUtils::get_stt_of_pager($user_list);
        			foreach($user_list as $user) {
        		?>
        		<tr>
        		  <td>{{ $stt++ }}</td>
        		  <td>{{ $user->id }}</td>
        		  <td>{{ $user->username }}</td>
        		  <td>{{ $user->display_name }}</td>
        		  <td>{{ intval($user->lastaccess) <= 0 || $user->lastaccess == '' ? '-' : date('d/m/Y H:i', $user->lastaccess) }}</td>
        		  <td align="center"><?php
        			if ( $user->sa == 1 ) print 'x';
        			else print ' ';
        			?>
        		  </td>
        		  <td align="center">
        			<?php if ( $user->allow_delete == 1 && $user->sa != 1 ) { ?>
        			<a href="javascript:;" onclick="do_userlist_edit_user({{$user->id}})"><span class="icon-pencil tip" title="Sửa thông tin"></span></a>&nbsp;
        			<a href="javascript:;" onclick="del_user({{ $user->id }})"><span class="icon-remove tip" title="Xóa"></span></a>
        			<?php } ?>
        		  </td>
        		  <td align="center">
        		    @if ( $user->sa != 1 )
        		    <a target="_blank" href="{{ url('user/viewperms/'.$user->id) }}"><span class="icon-info tip" title="Xem quyền hạn"></span></a>
        		    @endif
        		  </td>
        		</tr>
        		<?php } ?>
        	  </tbody>
        	</table>
        	<div>
                <?php
                    $pager = $user_list->appends(Input::except(array('page')))->links();
                    if ( $pager != '' ) {
                        print '<label class="pager_desc"><span>Có: '.$user_list->getTotal().' users. ('.
                            $user_list->getLastPage().' trang)</span> | Trang: </label>' . $pager;
                    }
                ?>
            </div>
        	<script type="text/javascript">
        	del_user = function(userid) {
        	    bootbox.confirm('Bạn có chắc là muốn xóa không ?', function(result) {
        	        if ( result ) {
        	            self.location.href = "{{ url('user/deleteuser/"+userid+"') }}";
        	        }
        	    });
        	};
        	do_userlist_create_user = function() {
        	    dialog_route_action('Thêm User', '{{url("user/createuser")}}?popup=true', 'userlist_user_createuser', 800, -1, true);
        	};
        	do_userlist_edit_user = function(userid) {
                dialog_route_action('Điều chỉnh User', '{{url("user/edituser")}}/'+userid+'?popup=true', 'userlist_user_edituser', 800, -1, true);
            };
        	</script>
    </div>

</div>

@stop

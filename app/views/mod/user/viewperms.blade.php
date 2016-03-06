@extends( 'layout/default-layout' )

@section('view_content')
    <div class="headline">
        <h3 class="clr-o">Thông tin User / quyền hạn / Vai trò</h3>
    </div>
    <div>
        <ul class="mul">
            <li>Tên đăng nhập: <b>{{ $currentuserinfo->username }}</b></li>
            <li>Tên hiển thị: <b>{{ $currentuserinfo->display_name }}</b></li>
            <li>Email: <b>{{ $currentuserinfo->email }}</b></li>
        </ul>
    </div>
	<div class="col-md-7">
	    <div class="headline">
	        <h3 class="text-primary">Danh sách quyền:</h3>
	        @if ( !$perms || count($perms) == 0 )
	        <div>&nbsp;</div>
            <div class="alert alert-danger">Tài khoản không có phân quyền truy cập !!!</div>
	        @endif
	        <ul class="mul" style="padding-top: 15px;">
	        @foreach ( $perms as $p )
	            <li>{{ $p->p_name }}</li>
	        @endforeach
	        </ul>
	    </div>
    </div>
    <div class="col-md-5">
        <div class="headline">
            <h3 class="text-primary">Danh sách vai trò:</h3>
            @if ( $currentuserinfo->sa == 1 )
            <div>&nbsp;</div>
            <div class="alert alert-info">Quyền quản trị cao nhất</div>
            @endif
            @if ( (!$roles || count($roles) == 0) && $currentuserinfo->sa != 1 )
            <div>&nbsp;</div>
            <div class="alert alert-danger">Chưa được phân vai trò !!!</div>
            @endif
            <ul class="mul" style="padding-top: 15px;">
            @foreach ( $roles as $role )
                <li>{{ $role }}</li>
            @endforeach
            </ul>
        </div>
    </div>
@stop

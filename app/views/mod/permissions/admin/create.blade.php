<!--@extends( 'layout/default-layout' )-->

@section('main_content')
<?php
$is_popup = '';
if ( Input::has('popup') ) $is_popup = '?popup=true';
$form_action = 'permission/create'.$is_popup;
if ( isset($permission_info) && $permission_info ) {
    $form_action = 'permission/edit/'.$permission_info->id.$is_popup;
}
?>
{{ Form::open(array('url' => $form_action, 'id' => 'popup-validation')) }}

    <?php if ( Session::has('message') ) { ?>
        <div class="alert alert-danger" role="alert"><?php echo Session::get('message') ?></div>
        <?php Session::forget('message'); ?>
    <?php } ?>

    <!-- will be used to show any messages -->
    <div style="clear:both"></div>
    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="form-group">
        <label for="inputPermissionName">Tên phân quyền</label>
        <input type="text" class="form-control" id="inputPermissionName" name="inputPermissionName" placeholder="Tên phân quyền" value="{{ @$permission_info->p_name }}">
    </div>

    <div class="form-group">
        <label for="inputPermissionCode">Mã phân quyền:</label>
        <input type="text" class="form-control" id="inputPermissionCode" name="inputPermissionCode" placeholder="Mã phân quyền" value="{{ @$permission_info->p_code }}">
    </div>

    <div class="form-group">
        <label for="inputModName">Khu vực quản lý:</label>
        <input type="text" class="form-control" id="inputModName" name="inputModName" placeholder="Khu vực quản lý" value="{{ @$permission_info->mod_name }}">
    </div>
    <input type="hidden" name="do_save" id="do_save" value="1" />
    <button type="submit" class="btn btn-primary">Submit</button>

    <div style="clear:both"></div>
{{ Form::close() }}

@stop

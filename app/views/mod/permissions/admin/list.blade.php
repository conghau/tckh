@extends( 'layout/default-layout' )

@section('main_content')
{{
    SystemController::breadcrumb(array(
        array(
            'url' => 'user/list',
            'title' => 'Quản lý User',
            'active' => false
        ),
        array(
            'url' => '',
            'title' => 'Quản lý vai trò',
            'active' => false
        ),
        array(
            'url' => '',
            'title' => 'Quản lý phân quyền',
            'active' => true
        ),
    ))
}}

@section('main_content')
    <div class="col-md-12">
        <div class="block block-drop-shadow">
            <div class="head bg-default bg-light-ltr">
                <h2>Quản lý phân quyền</h2>
                <div class="side pull-right">
                    <ul class="buttons">
                        <li><a href="javascript:;" onclick="add_permission()" class="tip" title="Thêm phân quyền"><span class="icon-plus"></span></a></li>
                    </ul>
                </div>
            </div>
            <?php if ( Session::has('message') ) { ?>
                <div class="alert alert-danger" role="alert"><?php echo Session::get('message') ?></div>
                <?php Session::forget('message'); ?>
            <?php } ?>

            <div class="content">
                <table class="table table-bordered responsive-table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Tên phân quyền</th>
                        <th>&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        $count = 1;
                    foreach ( $list_permission as $permission ) {
                        ?>
                        <tr>
                            <td>{{ $count }}</td>
                            <td>{{ $permission->p_name }}</td>
                            <td align="center">
                                <a href="javascript:;" onclick="edit_permission({{ $permission->id }})"><span class="icon-pencil tip" title="Sửa"></span></a>
                                <?php if ( $permission->allow_delete == 1 ) { ?>
                                    <a href="javascript:;" onclick="del_permission({{ $permission->id }})"><span class="icon-remove tip" title="Xóa"></span></a>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
                <script type="text/javascript">
                    del_permission = function(rolegroupid) {
                        bootbox.confirm('Bạn có chắc là muốn xóa không ?', function(result) {
                            if ( result ) {
                                self.location.href = '{{ url("permission/del/") }}/'+rolegroupid;
                            }
                        });
                    };
                    add_permission = function() {
                        dialog_route_action('Thêm phân quyền người dùng', "{{ url('permission/create?popup=true') }}" ,'permissions_create');
                    };
                    edit_permission = function(role_id) {
                        dialog_route_action('Sửa phân quyền người dùng', "{{ url('permission/edit/') }}/"+role_id+"?popup=true" ,'roles_editrole');
                    };
                </script>
            </div>
        </div>
    </div>
@stop

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
            'active' => true
        ),
    ))
}}

<div class="col-md-8">
    <div class="block block-drop-shadow">
    <div class="head bg-default bg-light-ltr">
        <h2>Phân quyền / Danh sách vai trò</h2>
        <div class="side pull-right">
            <ul class="buttons">
                <li><a href="javascript:;" onclick="add_role()" class="tip" title="Thêm vai trò"><span class="icon-plus"></span></a></li>
            </ul>
        </div>
    </div>

    <div class="content">
        <table class="table table-bordered responsive-table">
          <thead>
            <tr>
              <th>#</th>
              <th>Tên vai trò</th>
              <th>&nbsp;</th>
            </tr>
          </thead>
          <tbody>
            <?php
                foreach ( $list_roles as $role ) {
            ?>
            <tr>
            <td>{{ $role->id }}</td>
            <td><a href="javascript:;" onclick="get_list_role_permission({{ $role->id }})">{{ $role->role_name }}</a></td>
            <td align="center">
                <a href="javascript:;" onclick="get_list_role_permission({{ $role->id }})"><span class="icon-list tip" title="Xem quyền hạn của vai trò"></span></a>&nbsp;&nbsp;
                <a href="javascript:;" onclick="edit_role({{ $role->id }})"><span class="icon-pencil tip" title="Sửa"></span></a>&nbsp;&nbsp;
                <?php if ( $role->allow_delete == 1 ) { ?>
                <a href="javascript:;" onclick="del_role({{ $role->id }})"><span class="icon-remove tip" title="Xóa"></span></a>
                <?php } ?>
            </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
        <script type="text/javascript">
        del_role = function(rolegroupid) {
            bootbox.confirm('Bạn có chắc là muốn xóa không ?', function(result) {
                if ( result ) {
                    self.location.href = '{{ url("roles/delrole/") }}/'+rolegroupid;
                }
            });
        };
        add_role = function() {
            dialog_route_action('Thêm vai trò người dùng', "{{ url('roles/createrole?popup=true') }}" ,'roles_createrole');
        };
        edit_role = function(role_id) {
            dialog_route_action('Sửa vai trò người dùng', "{{ url('roles/editrole/') }}/"+role_id+"?popup=true" ,'roles_editrole');
        };

        get_list_role_permission = function(role_id) {
            ajax_html('{{ url("roles/getpermission") }}/'+role_id+'?blank=true', 'role_permission_panel');
        };
        </script>
    </div>
</div>
</div>

<div class="col-md-4">
    <div class="block block-drop-shadow">
    <div class="head bg-default bg-light-ltr">
        <h2>Chức năng được truy xuất</h2>
    </div>

    <div class="content content-transparent np" id="role_permission_panel">
    </div>
</div>
</div>

@stop

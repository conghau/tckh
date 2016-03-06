@extends( 'layout/default-layout' )

@section('view_content')
<div class="block block-drop-shadow">
{{
    SystemController::breadcrumb(array(
        array(
            'url' => '',
            'title' => 'Quản lý Menu',
            'active' => true
        ),
    ))
}}
    <div class="head bg-default bg-light-ltr">
        <h2>Quản lý Menu</h2>
        <div class="side pull-right">
            <ul class="buttons">
                <li><a href="javascript:;" onclick="mod_menu_do_add_newmenu('')" class="tip" title="Thêm Menu"><span class="icon-plus"></span></a></li>
            </ul>
        </div>
    </div>

    <div class="content">
        {{ $menu_html }}
        <script type="text/javascript">
        mod_menu_do_del_menu = function(menu_id) {
            bootbox.confirm("Bạn có chắc là muốn xóa không ?", function (result) {
                if (result) {
                    self.location.href = "{{ url('menu/deletemenu') }}/"+menu_id;
                }
            });
        };
        mod_menu_do_add_newmenu = function(parent_menu_id = '') {
            if ( parent_menu_id && parent_menu_id != '' && parent_menu_id != '0' ) parent_menu_id = '/'+parent_menu_id;
            dialog_route_action('Quản lý Menu / Thêm Menu', '{{ url("menu/createmenu") }}'+parent_menu_id+'?popup=true', 'menu_dialog_addform', 900);
        };
        mod_menu_do_edit_newmenu = function(menu_id) {
            dialog_route_action('Quản lý Menu / Sửa thông tin Menu', '{{ url("menu/editmenu") }}/'+menu_id+'?popup=true', 'menu_dialog_editform', 900);
        };
        </script>
    </div>
</div>

@stop

<?php
    $is_admin = false;
    if ( isset($userinfo) && $userinfo->is_access(array('quan_tri_vien')) ) {
        $is_admin = true;
    }
?>

<?php if ( $is_admin ) { ?>
    <!-- top admin menu -->
    <?php
    $menu_he_thong = UserController::admin_menu() . SystemController::admin_menu();

    $menu_other_mod =  MenuController::admin_menu() . PagesController::admin_menu();
    ?>
    @if ( $menu_he_thong != '' )
    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Hệ thống <span class="icon-angle-down"></span></a>
        <ul class="dropdown-menu">
            {{ $menu_he_thong }}
        </ul>
    </li>
    @endif
    {{ ArticleController::admin_menu() }}
    {{ TCKHController::admin_menu() }}

    @if ( $menu_other_mod != '' )
    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Chức năng khác <span class="icon-angle-down"></span></a>
        <ul class="dropdown-menu">
            {{ $menu_other_mod }}
        </ul>
    </li>
    @endif
    <script type="text/javascript">
    $(document).ready(function(){

        do_master_updateuserinfo = function() {
            dialog_route_action('Cập nhật thông tin tài khoản', '{{ url('user/updateinfo?popup=true') }}', 'user_updateinfo');
        };
    });
    </script>
    <!-- //top admin menu -->
<?php } ?>
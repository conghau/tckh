<?php
    # tao menu da cap
    function home_getMenuTree_UL($menu_id = 0) {
        $userinfo = unserialize(Session::get('userinfo'));
        $user_perms = array();
        if ( $userinfo ) {
            $user_perms = $userinfo->get_permissions();
        }

        if ( !isset($userinfo) || !$userinfo ) {
            $login_link = '';
            $login_link_script = '';
        }
        else {
            if ( $userinfo->is_access(array('quan_tri_vien')) ) {
                $login_link = '<li class="dropdown">'.
                    '<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">'.$userinfo->display_name.' <i class="icon-angle-down"></i></a>'.
                    '<ul class="dropdown-menu">'.
                        '<li><a href="'.url('news').'">Quản lý</a></li>'.
                        '<li><a href="'.url('user').'">Thay đổi mật khẩu</a></li>'.
                        '<li><a href="'.url('logout').'">Thoát quyền sử dụng</a></li>'.
                    '</ul>'.
                    '</li>';
                $login_link_script = '';
            }
            else {
                $login_link = '';
                $login_link_script = '';
            }
        }
        $tablename = 'web_menus';

        $menus = null;
        if ( $menu_id == 0 ) {
            # get all cats
            $menus = DB::select('select * from '.$tablename.' where IFNULL(parent_id,0)=0 order by orderno');
        }
        else {
            $menus = DB::select('select * from '.$tablename.' where id = ?', array($menu_id));
        }

        $html = '<ul class="nav navbar-nav">';
        $tree_level = 0;
        foreach ( $menus as $menu ) {
            # check permission
            $is_allow = false;
            $menu_perms = $menu->allow_perms == '*' ? null : explode(',', $menu->allow_perms);

            if ( $userinfo && $userinfo->sa == 1 ) $is_allow = true;
            else {
                if ( $menu_perms && count($menu_perms) > 0 ) {
                    foreach ( $menu_perms as $mperm ) {
                        if ( in_array($mperm, $user_perms) ) {
                            $is_allow = true;
                            break;
                        }
                    }
                }
                else {
                    # ko co thiet lap quyen truy cap menu -> cho phep tat ca truy cap
                    $is_allow = true;
                }
            }

            if ( $is_allow ) {
                $_link = '#';
                if ( $menu->link == '' || $menu->link == '#' ) { }
                else $_link = url($menu->link);

                $testDropDown = DB::select('select id from '.$tablename.' where IFNULL(parent_id,0)='.$menu->id);
                $dropdownClass = '';
                $dropdownHref = '';
                $dropdownIcon = '';
                if ( $testDropDown && count($testDropDown) > 0 ) {
                    $dropdownClass = ' class="dropdown"';
                    $dropdownHref = ' class="dropdown-toggle" data-toggle="dropdown"';
                    $dropdownIcon = ' <i class="icon-angle-down"></i>';
                }

                $html .= '<li'.$dropdownClass.'>'.
                    '<a href="'.$_link.'"'.$dropdownHref.'>'.$menu->title.$dropdownIcon.'</a>';

                home_getSubMenu_UL($menu->id, $html, $tree_level, $tablename, $user_perms, @$userinfo->sa);

                $html .= '</li>';
            }
        }
        # add login link
        $html .= $login_link;
        $html .= '</ul>';

        # add login link script to popup
        $html .= $login_link_script;

        return $html;
    }

    function home_getSubMenu_UL($parent_menu_id, &$html, &$tree_level, $tablename, $user_perms, $is_sa_user) {
        if ( !$parent_menu_id ) $parent_menu_id = 0;

        $sub_menus = DB::select('select * from '.$tablename.' where IFNULL(parent_id,0) = '.$parent_menu_id.' order by orderno');

        $tree_level++;
        $padding_str = '';
        for ( $i=0; $i<$tree_level; $i++ ) {
            $padding_str .= '|' . str_repeat('-',4);
        }

        if ( $sub_menus && count($sub_menus) > 0 ) {
            $html .= '<ul class="dropdown-menu">';
            foreach ( $sub_menus as $sub_menu ) {
                $menu_perms = $sub_menu->allow_perms == '*' ? null : explode(',', $sub_menu->allow_perms);

                $is_allow = false;
                if ( $is_sa_user ) $is_allow = true;
                else {
                    if ( $menu_perms && count($menu_perms) > 0 ) {
                        foreach ( $menu_perms as $mperm ) {
                            if ( in_array($mperm, $user_perms) ) {
                                $is_allow = true;
                                break;
                            }
                        }
                    }
                    else {
                        # ko co thiet lap quyen truy cap menu -> cho phep tat ca truy cap
                        $is_allow = true;
                    }
                }

                if ( $is_allow ) {
                    # tao link
                    $_link = '#';
                    if ( $sub_menu->link == '' || $sub_menu->link == '#' ) { }
                    else $_link = url($sub_menu->link);

                    # kiem tra co menu con
                    $testDropDownSub = DB::select('select id from '.$tablename.' where IFNULL(parent_id,0)='.$sub_menu->id);
                    $dropdownClassSub = '';
                    $dropdownHrefSub = '';
                    $dropdownIconSub = '';
                    if ( $testDropDownSub && count($testDropDownSub) > 0 ) {
                        $dropdownClassSub = ' class="dropdown"';
                        $dropdownHrefSub = ' class="dropdown-toggle" data-toggle="dropdown"';
                        $dropdownIconSub = ' <i class="icon-angle-down"></i>';
                    }

                    $html .= '<li'.$dropdownClassSub.'>'.
                        '<a href="'.$_link.'"'.$dropdownHrefSub.'>'.$sub_menu->title.$dropdownIconSub.'</a>';

                    home_getSubMenu_UL($sub_menu->id, $html, $tree_level, $tablename, $user_perms, $is_sa_user);

                    $html .= '</li>';
                }
            }
            $html .= '</ul>';
        }
        $tree_level--;
    }

    print home_getMenuTree_UL();
?>
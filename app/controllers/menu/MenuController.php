<?php
use App\BaseController;
class MenuController extends BaseController {

    public static $admin_menu = array(
        array(
            'title' => 'Quản lý Menu',
            'url' => 'menu',
            'permissions' => array(
                'admin_menu'
            ),
        )
    );

	public function __construct() {
        parent::__construct();
		# require logined for this controller
		$this->beforeFilter('auth', array(
			# not filter with action: login
			'except' => array(
			))
		);
	}

    public static function init_route() {
        Route::any('menu','MenuController@admin_index');
        Route::any('menu/createmenu/{parent_menu_id?}','MenuController@admin_createmenu');
        Route::any('menu/editmenu/{menu_id}','MenuController@admin_editmenu');
        Route::any('menu/deletemenu/{menu_id}','MenuController@admin_deletemenu');
        Route::any('menu/getpages','MenuController@admin_getpages');

    }

    public static function admin_menu() {
        $userinfo = unserialize(Session::get('userinfo'));
        $perms = $userinfo->get_permissions();

        $menu_html = '';
        $menu_allow_items = 0;
        if ( self::$admin_menu && count(self::$admin_menu) > 0 ) {
            foreach ( self::$admin_menu as $amenu ) {
                if ( $amenu['permissions'] && count($amenu['permissions']) > 0 ) {
                    foreach ( $amenu['permissions'] as $perm ) {
                        if ( $userinfo->sa == 1 ){
                            $menu_html .= '<li><a href="'.url($amenu['url']).'">'.$amenu['title'].'</a></li>';
                            $menu_allow_items++;
                        }
                        else {
                            if ( in_array($perm, $perms) ) {
                                $menu_html .= '<li><a href="'.url($amenu['url']).'">'.$amenu['title'].'</a></li>';
                                $menu_allow_items++;
                            }
                        }
                    }
                }
            }
        }

        if ( $menu_allow_items > 0 )  { }
        else $menu_html = '';

        return $menu_html;
    }
	
	public function admin_index() {
		if ( !$this->userinfo->is_access(array('admin_menu')) ) return View::make('403');
	
		$menu_html = Menu::getMenuTree_UL();
	
		return View::make('mod/menu/admin/main', array(
			'menu_html' => $menu_html
		));
	}
	
	public function admin_getpages() {
        if ( !$this->userinfo->is_access(array('admin_menu')) ) return View::make('403');
		$pages = DB::table('web_pages')->paginate(15);
		
		return View::make('mod/menu/admin/listpages', array(
			'pages' => $pages
		));
	}
	
	public function admin_createmenu($parent_menu_id = 0) {
        if ( !$this->userinfo->is_access(array('admin_menu')) ) return View::make('403');

		# lay ds menu
		$all_menus = Menu::getMenuTree_ComboBox();
		
		if ( Input::has('do_save') ) {
			$link = Input::get('txtLink');
			if ( !$link || empty($link) ) $link = '#';

            $perms = Input::get('perms');
            if ( $perms && count($perms) > 0 ) $perms = implode(',', $perms);
            else $perms = '*';
		
			$menu = new Menu();
			$menu->title = Input::get('txtTitle');
			$menu->link = $link;
			$menu->linktarget = Input::get('cboTarget');
			$menu->orderno = Input::get('txtOrder');
			$menu->allow_perms = $perms;
			$menu->is_hidden = Input::get('chkHidden');
			if ( Input::has('cboParentID') ) $menu->parent_id = Input::get('cboParentID');

            $url_redirect_script = '<script type="text/javascript">top.location="'.url('menu').'";parent.location="'.
                url('menu').'";</script>';

			if ( $menu->save() ) {
				cUtils::set_app_message('Lưu Menu thành công !!!'.$url_redirect_script, cUtils::SUCCESS_MSG);
			}
			else {
				cUtils::set_app_message('Lưu Menu không thành công !!!'.$url_redirect_script, cUtils::ERROR_MSG);
			}
			
			# return Redirect::to('menu');
		}
	
		if ( !$parent_menu_id || $parent_menu_id < 0 ) $parent_menu_id = 0;
		$parent_menu_info = Menu::find($parent_menu_id);

        $list_perms = Permissions::listall();
		return View::make('mod/menu/admin/menuform', array(
			'parent_menu_info' => $parent_menu_info,
			'all_menus' => $all_menus,
            'list_perms' => $list_perms
		));
	}
	
	public function admin_editmenu($menu_id) {
        if ( !$this->userinfo->is_access(array('admin_menu')) ) return View::make('403');

        $list_perms = Permissions::listall();
		$menuinfo = Menu::find($menu_id);
		if ( $menuinfo ) {
			$all_menus = Menu::getMenuTree_ComboBox();
		
			if ( Input::has('do_save') ) {
				$link = Input::get('txtLink');
				if ( !$link || empty($link) ) $link = '#';

                $perms = Input::get('perms');
                if ( $perms && count($perms) > 0 ) $perms = implode(',', $perms);
                else $perms = '*';
			
				$menuinfo->title = Input::get('txtTitle');
				$menuinfo->link = $link;
				$menuinfo->linktarget = Input::get('cboTarget');
				$menuinfo->orderno = Input::get('txtOrder');
				$menuinfo->is_hidden = Input::get('chkHidden');
                $menuinfo->allow_perms = $perms;
				if ( Input::has('cboParentID') ) {
                    $menuinfo->parent_id = Input::get('cboParentID');
                }

                $url_redirect_script = '<script type="text/javascript">top.location="'.url('menu').'";parent.location="'.
                    url('menu').'";</script>';

				if ( $menuinfo->save() ) {
					cUtils::set_app_message('Lưu Menu thành công !!!'.$url_redirect_script, cUtils::SUCCESS_MSG);
				}
				else {
					cUtils::set_app_message('Lưu Menu không thành công !!!'.$url_redirect_script, cUtils::ERROR_MSG);
				}
				
				#return Redirect::to('menu');
			}
		
			$parent_menu_info = null;
			if ( intval($menuinfo->parent_id) > 0 ) {
				$parent_menu_info = Menu::find($menuinfo->parent_id);
			}
			
			return View::make('mod/menu/admin/menuform', array(
				'parent_menu_info' => $parent_menu_info,
				'menuinfo' => $menuinfo,
				'all_menus' => $all_menus,
                'list_perms' => $list_perms
			));
		}
		else {
			cUtils::set_app_message('Không tìm thấy thông tin Menu !!!', cUtils::ERROR_MSG);
		}
	}
	
	public function admin_deletemenu($menu_id) {
        if ( !$this->userinfo->is_access(array('admin_menu')) ) return View::make('403');
		
		$menuinfo = Menu::find($menu_id);
		if ( $menuinfo ) {
			Menu::deleteMenu($menuinfo->id);

            cUtils::set_app_message('Xóa Menu thành công !', cUtils::SUCCESS_MSG);
		}
		else {
			cUtisl::set_app_message('Không tìm thấy menu cần xóa !!!', cUtils::ERROR_MSG);
		}
		
		return Redirect::to('menu');
	}

}

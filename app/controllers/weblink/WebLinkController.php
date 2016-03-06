<?php

class WebLinkController extends \BaseController {

    public static $admin_menu = array(
        array(
            'title' => 'Quản lý',
            'url' => 'weblink/list',
            'permissions' => array('admin_weblink'),
        ),

    );

	public function __construct() {
        parent::__construct();
		# require logined for this controller
		$this->beforeFilter('auth', array(
			# not filter with action: login
			'except' => array(
			))
		);
		
		// clear ckfinder module
		unset($_SESSION['ckfinder_module_info']);
	
		# share var for all template
		if ($this->userinfo)
		{
			if ( $this->userinfo->sa != 1 ) {
				return View::make('error', array(
					'error_message' => 'Không có quyền truy cập !!!'
				));
			}
		}
		else {
			return View::make('error', array(
				'error_message' => 'Không tìm thấy thông tin tài khoản sử dụng !!!'
			));
		}
	}

    public static function init_route() {
        Route::any('weblink/list','WebLinkController@admin_list');
        Route::any('weblink/add','WebLinkController@admin_add');
        Route::any('weblink/edit','WebLinkController@admin_edit');
        Route::any('weblink/delete','WebLinkController@admin_delete');

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

        if ( $menu_allow_items > 0 )  {
            $menu_html = '<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Liên kết Web <span class="icon-angle-down"></span></a>' .
                '<ul class="dropdown-menu">' . $menu_html .
                '</ul></li>';
        }
        else $menu_html = '';

        return $menu_html;
    }

    public function admin_list() {
        if ( !$this->userinfo->is_access(array('admin_weblink')) ) {
            return View::make('403')->with('message', 'Không có quyền truy cập !!!');
        }

        $list = WebLink::orderBy('link_order')->get();

        return View::make('mod.weblink.admin.list',array(
            'list_weblink' => $list
        ));
    }

    public function admin_add() {
        if ( !$this->userinfo->is_access(array('admin_weblink')) ) {
            return View::make('403')->with('message', 'Không có quyền truy cập !!!');
        }

        if ( Input::has('do_save') ) {
            $weblink = new WebLink();
            $weblink->link_title = Input::get('txtTitle');
            $weblink->link_url = Input::get('txtURL');
            $weblink->link_order = Input::get('txtOrder');

            $fileLogo = Input::file('fileLogo');
            if ( $fileLogo && count($fileLogo) > 0 ) {
                $destinationPath = public_path() . '/weblink';
                $filename = $fileLogo->getClientOriginalName();

                $upload_success = $fileLogo->move($destinationPath, $filename);
                if ( $upload_success ) {
                    $weblink->link_image = $filename;
                }
            }

            if ( $weblink->save() ) {
                cUtils::set_app_message('Lưu thông tin thành công !!!', cUtils::SUCCESS_MSG);
            }
            else {
                cUtils::set_app_message('Lỗi khi lưu thông tin !!!', cUtils::ERROR_MSG);
            }
            return Redirect::to('weblink/list');
        }

        return View::make('mod.weblink.admin/form',array(

        ));
    }

    public function admin_edit() {
        if ( !$this->userinfo->is_access(array('admin_weblink')) ) {
            return View::make('403')->with('message', 'Không có quyền truy cập !!!');
        }

        $weblinkinfo = WebLink::find(Input::get('id'));
        if ( $weblinkinfo ) {
            if ( Input::has('do_save') ) {
                $weblinkinfo->link_title = Input::get('txtTitle');
                $weblinkinfo->link_url = Input::get('txtURL');
                $weblinkinfo->link_order = Input::get('txtOrder');

                $fileLogo = Input::file('fileLogo');
                if ( $fileLogo ) {
                    $destinationPath = public_path() . '/weblink';
                    $filename = $fileLogo->getClientOriginalName();

                    $upload_success = $fileLogo->move($destinationPath, $filename);
                    if ( $upload_success ) {
                        $weblinkinfo->link_image = $filename;
                    }
                }
                else {
                    if ( Input::get('xoaimage') == 1 ) {
                        $fn_anhbia = public_path().'/weblink/'.$weblinkinfo->link_image;
                        if ( file_exists($fn_anhbia) ) {
                            @unlink($fn_anhbia);
                        }
                        $weblinkinfo->link_image = '';
                    }
                }

                if ( $weblinkinfo->save() ) {
                    cUtils::set_app_message('Lưu thông tin thành công !!!', cUtils::SUCCESS_MSG);
                }
                else {
                    cUtils::set_app_message('Lỗi khi lưu thông tin !!!', cUtils::ERROR_MSG);
                }
                return Redirect::to('weblink/list');
            }

            return View::make('mod.weblink.admin.form', array(
                'weblinkinfo' => $weblinkinfo
            ));
        }
        else {
            return View::make('404')->with('message', 'Không tìm thấy thông tin cần sửa !!!');
        }
    }

    public function admin_delete() {
        if ( !$this->userinfo->is_access(array('admin_weblink')) ) {
            return View::make('403')->with('message', 'Không có quyền truy cập !!!');
        }

        $weblinkinfo = WebLink::find(Input::get('id'));
        if ( $weblinkinfo ) {
            # xoa ảnh
            $fn = public_path() . '/weblink/' . $weblinkinfo->link_image;
            if ( file_exists($fn) ) {
                @unlink($fn);
            }

            if ( $weblinkinfo->delete() ) {
                cUtils::set_app_message('Xóa thành công !!!', cUtils::SUCCESS_MSG);
            }
            else {
                cUtils::set_app_message('Lỗi khi xóa Liên kết Web !!!', cUtils::ERROR_MSG);
            }
            return Redirect::to('weblink/list');
        }
        else {
            return View::make('404')->with('message', 'Không tìm thấy Liên kết web cần xóa !!!');
        }
    }
}

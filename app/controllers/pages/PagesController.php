<?php

use \Menu;

class PagesController extends \BaseController {

    public static $admin_menu = array(
        array(
            'title' => 'Quản lý Trang',
            'url' => 'pages',
            'permissions' => array(
                'admin_pages'
            ),
        )
    );

	public function __construct() {
        parent::__construct();
		# require logined for this controller
		$this->beforeFilter('auth', array(
			# not filter with action: login
			'except' => array(
				'viewpage'
			))
		);
	}

    public static function init_route() {
        Route::any('pages','PagesController@admin_index');
        Route::any('pages/createpage','PagesController@admin_createpage');
        Route::any('pages/editpage/{page_id}','PagesController@admin_editpage');
        Route::any('pages/deletepage/{page_id}','PagesController@admin_deletepage');
        Route::any('pages/view/{pagetitle_seo}','PagesController@viewpage');
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
        if ( !$this->userinfo->is_access(array('admin_pages')) ) return View::make('403');
		$list_pages = DB::table(with(new Pages)->getTable())->paginate(Config::get('pages.list_page_size'));
	
		return View::make('mod/pages/admin/listpages', array(
			'list_pages' => $list_pages
		));
	}
	
	public function admin_createpage() {
        if ( !$this->userinfo->is_access(array('admin_pages')) ) return View::make('403');
		$menus = Menu::getMenuTree_ComboBox();

        $list_perms = Permissions::listall();
		if ( Input::has('do_save') ) {
            $perms = Input::get('perms');
            if ( $perms && count($perms) > 0 ) $perms = implode(',', $perms);
            else $perms = '*';

			$page = new Pages();
			$page->pagename = Input::get('txtPageName');
			$page->pagetitle = Input::get('txtPageTitle');			
			$page->pagecontent = Input::get('txtPageContent');
			$page->pagecontent_text = strip_tags($page->pagecontent, Config::get('pages.strip_tags_allow'));
			$page->page_is_hidden = Input::get('chkHiddenPage');
			$page->create_at = time();
			$page->create_user = $this->userinfo->id;
            $page->allow_perms = $perms;
			
			if ( $page->save() ) {
				$page->pagetitle_seo = $page->id . '-'. cUtils::str_normalize($page->pagetitle, '-', false, true);
				$page->save();
				
				# gan vao menu
				if ( intval(Input::get('cboMenu') ) > 0 )
				{
					$menu = Menu::find(Input::get('cboMenu'));
					if ( $menu ) {
						$menu->link = 'pages/view/'.$page->pagetitle_seo;
						$menu->pageid = $page->id;
						$menu->save();
					}
				}
			
				cUtils::set_app_message('Tạo trang thành công !', cUtils::SUCCESS_MSG);
			}
			else {
				cUtils::set_app_message('Tạo trang không thành công !', cUtils::ERROR_MSG);
			}
			
			return Redirect::to('pages');
		}
		
		return View::make('mod/pages/admin/pageform', array(
			'menus' => $menus,
            'list_perms' => $list_perms
		));
	}
	
	public function admin_editpage($page_id) {
        if ( !$this->userinfo->is_access(array('admin_pages')) ) return View::make('403');
		$pageinfo = Pages::find($page_id);

        $list_perms = Permissions::listall();

		if ( $pageinfo ) {
			# lay danh sach menu
			$menus = Menu::getMenuTree_ComboBox();
			
			# lay thong tin menu (neu co)
			$menu = Menu::where('pageid','=',$pageinfo->id)->get();
			$menuinfo = null;
			if ( $menu && count($menu) > 0 ) {
				$menuinfo = $menu->get(0);
			}
		
			if ( Input::has('do_save') ) {
                $perms = Input::get('perms');
                if ( $perms && count($perms) > 0 ) $perms = implode(',', $perms);
                else $perms = '*';

				$pageinfo->pagename = Input::get('txtPageName');
				$pageinfo->pagetitle = Input::get('txtPageTitle');
				$pageinfo->pagetitle_seo = $pageinfo->id . '-'. cUtils::str_normalize($pageinfo->pagetitle, '-', false, true);
				$pageinfo->pagecontent = Input::get('txtPageContent');
				$pageinfo->pagecontent_text = strip_tags($pageinfo->pagecontent, Config::get('pages.strip_tags_allow'));
				$pageinfo->page_is_hidden = Input::get('chkHiddenPage');
                $pageinfo->allow_perms = $perms;
				$pageinfo->update_at = time();
				$pageinfo->update_user = $this->userinfo->id;
				
				if ( $pageinfo->save() ) {
					# update vao menu (neu co)
					# xoa menu cu
					if ( $menuinfo ) {
						$menuinfo->link = '#';
						$menuinfo->pageid = null;
						$menuinfo->save();
					}
					
					if ( intval(Input::get('cboMenu')) > 0 ) {
						$menu_updated = Menu::find(Input::get('cboMenu'));
						if ( $menu_updated ) {
							$menu_updated->link = 'pages/view/'.$pageinfo->pagetitle_seo;
							$menu_updated->pageid = $page_id;
							$menu_updated->save();
						}
					}
				
					cUtils::set_app_message('Lưu trang thành công !', cUtils::SUCCESS_MSG);
				}
				else {
					cUtils::set_app_message('Lưu trang không thành công !', cUtils::ERROR_MSG);
				}
				
				return Redirect::to('pages');
			}
		
			return View::make('mod/pages/admin/pageform', array(
				'pageinfo' => $pageinfo,
				'menus' => $menus,
				'menuinfo' => $menuinfo,
                'list_perms' => $list_perms
			));
		}
		else {
			cUtils::set_app_message('Không tìm thấy trang cần sửa !!!', cUtils::ERROR_MSG);
			return Redirect::to('pages');
		}
	}
	
	public function admin_deletepage($page_id) {
        if ( !$this->userinfo->is_access(array('admin_pages')) ) return View::make('403');
		$page = Pages::find($page_id);
		if ( $page ) {
			$page->delete();
			
			cUtils::set_app_message('Xóa trang thành công !!!', cUtils::SUCCESS_MSG);
		}
		else {
			cUtils::set_app_message('Không tìm thấy trang cần xóa !!!', cUtils::ERROR_MSG);
		}
		
		return Redirect::to('pages');
	}
	
	/***************** user view *********************/
	public function viewpage($pagetitle_seo) {
		$tmp = explode('-', $pagetitle_seo);	// [0]=pageid, [1]=title
		$page = Pages::find($tmp[0]);

        $is_admin = false;
        if ( $this->userinfo ) {
            $is_admin = $this->userinfo->is_access(array('admin_pages'));
        }

		if ( $page ) {
            if ( $page->page_is_hidden != 1 ) {
                $is_allow = false;
                # kiem tra quyen truy cap trang
                $page_perms = $page->allow_perms == '*' ? null : explode(',', $page->allow_perms);
                if ( $page_perms == '*' ) {
                    $is_allow = true;
                }
                else {
                    $user_perms = array();
                    if ( $this->userinfo ) {
                        $user_perms = $this->userinfo->get_permissions();
                    }

                    if ( $page_perms && count($page_perms) > 0 ) {
                        foreach ( $page_perms as $mperm ) {
                            if ( in_array($mperm, $user_perms) ) {
                                $is_allow = true;
                                break;
                            }
                        }
                    }
                    else {
                        $is_allow = true;
                    } // dc phep truy cap
                }

                if ( $is_allow ) {
                    return View::make('mod/pages/viewpage', array(
                        'pageinfo' => $page
                    ));
                }
                else {
                    if ( $is_admin ) {
                        cUtils::set_app_message('Trang này hiện đang không được phép truy cập do đang ở trạng thái ẩn hoặc có thiết lập quyền truy cập trang !!!');

                        return View::make('mod/pages/viewpage', array(
                            'pageinfo' => $page
                        ));
                    }
                    else return View::make('404');
                }
            }
            else {
                return View::make('404');
            }
		}
		else {
			// page not found
			return View::make('404');
		}
	}
}

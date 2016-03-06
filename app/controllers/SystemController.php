<?php

class SystemController extends \BaseController {
	/**
	 * Instantiate a new UserController instance.
	 */
	public function __construct() {
        parent::__construct();
		# require logined for this controller
		$this->beforeFilter('auth', array(
		));
	}

    public static function init_route() {
        # log khi user tien hanh dang nhap
        Route::any('system/requestloginlog','SystemController@admin_requestloginlog');	# Any HTTP Verb
        Route::any('system/deleteallloginlog','SystemController@admin_deleteallloginlog');	# Any HTTP Verb

        # log sau khi user dang nhap thanh cong
        Route::any('system/activatelog','SystemController@admin_activatelog');
        Route::any('system/deleteallactivatelog','SystemController@admin_deleteallactivatelog');	# Any HTTP Verb

        # log guest
        Route::any('system/guestrequestlog','SystemController@admin_guestrequestlog');
        Route::any('system/deleteallguestrequestlog','SystemController@admin_deleteallguestrequestlog');	# Any HTTP Verb

        Route::any('system/settings','SystemController@admin_settings');	# Any HTTP Verb

        Route::any('system/clientthemesettings','SystemController@get_client_theme_settings');	# Any HTTP Verb
    }

    public static function admin_menu() {
        $userinfo = unserialize(Session::get('userinfo'));
        $menu_html = '';

        if ( $userinfo->sa == 1 ) {
            $menu_html = '<li>
                    <a href="'.url('system/settings').'">Thiết lập hệ thống</a>
                    <a href="'.url('system/requestloginlog').'">Request Login logs</a>
                    <a href="'.url('system/activatelog').'">Logined request logs</a>
                    <a href="'.url('system/guestrequestlog').'">Guest logs</a>
                </li>';
        }

        return $menu_html;
    }

    public function admin_requestloginlog() {
        if ( $this->userinfo->sa != 1 ) return View::make('403');

        $list = LoginLogs::orderBy('created_at_unix', 'desc');

        $kw = Input::get('kw');
        $tungay = Input::get('tungay');
        $denngay = Input::get('denngay');

        if ( $tungay != '' && $denngay != '' ) {
            $list = $list->where(function($query) {
                $tmp = explode('/', Input::get('tungay'));
                if ( $tmp && count($tmp) == 3 ) {
                    $tungay = mktime(0, 0, 0, $tmp[1], $tmp[0], $tmp[2]);
                }
                else $tungay = 0;

                $tmp = explode('/', Input::get('denngay'));
                if ( $tmp && count($tmp) == 3 ) {
                    $denngay = mktime(23, 59, 59, $tmp[1], $tmp[0], $tmp[2]);
                }
                else $denngay = 0;

                $query->where('created_at_unix', '>=', $tungay)
                    ->where('created_at_unix', '<=', $denngay);
            });
        }
        else if ( $tungay != '' && $denngay == '' ) {
            $tmp = explode('/', Input::get('tungay'));
            $tungay = mktime(0,0,0,$tmp[1],$tmp[0],$tmp[2]);

            $list = $list->where('created_at_unix', '>=', $tungay);
        }
        else if ( $tungay == '' && $denngay != '' ) {
            $tmp = explode('/', Input::get('denngay'));
            $denngay = mktime(23,59,59,$tmp[1],$tmp[0],$tmp[2]);

            $list = $list->where('created_at_unix', '<=', $denngay);
        }

        if ( $kw != '' ) {
            $list = $list->where(function($query) {
                $kw = Input::get('kw');
                $query->where('login_username', 'LIKE', '%'.$kw.'%');
            });
        }

        $list = $list->orderBy('login_username');
        $list = $list->paginate(Config::get('app.log_page_size'));

        return View::make('mod/system/loglogin_list', array(
            'list_logs' => $list
        ));
    }

    public function admin_deleteallloginlog() {
        if ( $this->userinfo->sa != 1 ) return View::make('403');

        //LoginLogs::truncate();
        DB::connection('sqlsrvlog')->delete('delete from ['.with(new LoginLogs())->getTable().']');

        cUtils::set_app_message('Xóa tất cả Log đăng nhập thành công !', cUtils::SUCCESS_MSG);

        return Redirect::to('system/requestloginlog');
    }

    public function admin_activatelog() {
        if ( $this->userinfo->sa != 1 ) return View::make('403');

        $list = LoginedAllRequestLogs::orderBy('created_at_unix', 'desc');

        $kw = Input::get('kw');
        $tungay = Input::get('tungay');
        $denngay = Input::get('denngay');

        if ( $tungay != '' && $denngay != '' ) {
            $list = $list->where(function($query) {
                $tmp = explode('/', Input::get('tungay'));
                if ( $tmp && count($tmp) == 3 ) {
                    $tungay = mktime(0, 0, 0, $tmp[1], $tmp[0], $tmp[2]);
                }
                else $tungay = 0;

                $tmp = explode('/', Input::get('denngay'));
                if ( $tmp && count($tmp) == 3 ) {
                    $denngay = mktime(23, 59, 59, $tmp[1], $tmp[0], $tmp[2]);
                }
                else $denngay = 0;

                $query->where('created_at_unix', '>=', $tungay)
                    ->where('created_at_unix', '<=', $denngay);
            });
        }
        else if ( $tungay != '' && $denngay == '' ) {
            $tmp = explode('/', Input::get('tungay'));
            $tungay = mktime(0,0,0,$tmp[1],$tmp[0],$tmp[2]);

            $list = $list->where('created_at_unix', '>=', $tungay);
        }
        else if ( $tungay == '' && $denngay != '' ) {
            $tmp = explode('/', Input::get('denngay'));
            $denngay = mktime(23,59,59,$tmp[1],$tmp[0],$tmp[2]);

            $list = $list->where('created_at_unix', '<=', $denngay);
        }

        if ( $kw != '' ) {
            $list = $list->where(function($query) {
                $kw = Input::get('kw');
                $query->where('user_id', 'LIKE', '%'.$kw.'%')
                    ->orWhere('username', 'LIKE', '%'.$kw.'%');
            });
        }

        $list = $list->orderBy('username');
        $list = $list->paginate(Config::get('app.log_page_size'));

        return View::make('mod/system/logactivate_list', array(
            'list_logs' => $list
        ));
    }

    public function admin_deleteallactivatelog() {
        if ( $this->userinfo->sa != 1 ) return View::make('403');

        //RequestLogs::truncate();
        DB::connection('sqlsrvlog')->delete('delete from ['.with(new LoginedAllRequestLogs())->getTable().']');

        cUtils::set_app_message('Xóa tất cả Log hoạt động thành công !', cUtils::SUCCESS_MSG);

        return Redirect::to('system/activatelog');
    }

    public function admin_guestrequestlog() {
        if ( $this->userinfo->sa != 1 ) return View::make('403');

        $list = NotLoginedAllRequestLogs::orderBy('created_at_unix', 'desc');

        $kw = Input::get('kw');
        $tungay = Input::get('tungay');
        $denngay = Input::get('denngay');

        if ( $tungay != '' && $denngay != '' ) {
            $list = $list->where(function($query) {
                $tmp = explode('/', Input::get('tungay'));
                if ( $tmp && count($tmp) == 3 ) {
                    $tungay = mktime(0, 0, 0, $tmp[1], $tmp[0], $tmp[2]);
                }
                else $tungay = 0;

                $tmp = explode('/', Input::get('denngay'));
                if ( $tmp && count($tmp) == 3 ) {
                    $denngay = mktime(23, 59, 59, $tmp[1], $tmp[0], $tmp[2]);
                }
                else $denngay = 0;

                $query->where('created_at_unix', '>=', $tungay)
                    ->where('created_at_unix', '<=', $denngay);
            });
        }
        else if ( $tungay != '' && $denngay == '' ) {
            $tmp = explode('/', Input::get('tungay'));
            $tungay = mktime(0,0,0,$tmp[1],$tmp[0],$tmp[2]);

            $list = $list->where('created_at_unix', '>=', $tungay);
        }
        else if ( $tungay == '' && $denngay != '' ) {
            $tmp = explode('/', Input::get('denngay'));
            $denngay = mktime(23,59,59,$tmp[1],$tmp[0],$tmp[2]);

            $list = $list->where('created_at_unix', '<=', $denngay);
        }

        if ( $kw != '' ) {
            $list = $list->where(function($query) {
                $kw = Input::get('kw');
                $query->where('user_id', 'LIKE', '%'.$kw.'%')
                    ->orWhere('username', 'LIKE', '%'.$kw.'%');
            });
        }

        $list = $list->orderBy('username');
        $list = $list->paginate(Config::get('app.log_page_size'));

        return View::make('mod/system/logguestrequest_list', array(
            'list_logs' => $list
        ));
    }

    public function admin_deleteallguestrequestlog() {
        if ( $this->userinfo->sa != 1 ) return View::make('403');

        //RequestLogs::truncate();
        DB::connection('sqlsrvlog')->delete('delete from ['.with(new NotLoginedAllRequestLogs())->getTable().']');

        cUtils::set_app_message('Xóa tất cả Guest Log thành công !', cUtils::SUCCESS_MSG);

        return Redirect::to('system/guestrequestlog');
    }

    /**
     * Thiết lập cấu hình cho hệ thống
     */
    public function admin_settings() {
        if ( $this->userinfo->sa != 1 ) return View::make('403');

        if ( Input::has('sesstoken') ) {
            $inputtoken = cMCrypter::decrypt(Input::get('sesstoken'), cMCrypter::get_session_key());
            if ( $inputtoken == 'do_save_settings' ) {
                $data = cUtils::base64_decode_safe(Input::get('data'));
                $data = json_decode($data, JSON_UNESCAPED_UNICODE);

                if ( is_array($data) && $data['name'] != '' && $data['value'] != '' ) {
                    if ( DB::update('update web_config set cfgvalue="'.$data['value'].'",updated_at='.time().' where cfgname="'.$data['name'].'"') ) {
                        return json_encode(array(
                            'status' => 0,
                            'message' => ''
                        ));
                    }
                    else {
                        return json_encode(array(
                            'status' => -2,
                            'message' => 'Lưu thông tin lỗi !!!'
                        ));
                    }
                }
                else {
                    return json_encode(array(
                        'status' => -1,
                        'message' => 'Dữ liệu không hợp lệ !!!'
                    ));
                }
            }
        }

        $sesstoken = cMCrypter::encrypt('do_save_settings', cMCrypter::get_session_key());

        $settings = array();

        $mods = DB::select('select distinct modtext,modname from web_config order by modtext');
        foreach ( $mods as $mod ) {
            $settings[$mod->modname] = new stdClass();
            $settings[$mod->modname]->name = $mod->modname;
            $settings[$mod->modname]->text = $mod->modtext;
            $settings[$mod->modname]->settings = array();

            $list_mod_settings = DB::select("select * from web_config where modname='".$mod->modname."'");
            if ( $list_mod_settings ) {
                foreach ( $list_mod_settings as $mod_setting ) {
                    $settings[$mod->modname]->settings[] = $mod_setting;
                }
            }
        }

        return View::make('mod/system/settings', array(
            'settings' => $settings,
            'sesstoken' => $sesstoken
        ));
    }

    public function get_client_theme_settings() {
        return View::make('mod/system/client_theme_settings');
    }

    public static function breadcrumb($paths) {
        /**
         * $paths[i] = array('active' => true/false, 'title' => xxx, 'url' => yyy);
         */
        return View::make('mod.system.breadcrumb', array(
            'paths' => $paths
        ))->render();
    }
}

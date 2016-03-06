<?php

use appp\models\Roles;
// use \RoleGroups;
use app\models\UserNRoles;

class UserController extends \BaseController {
	/**
	 * Instantiate a new UserController instance.
	 */
	public function __construct() {
        parent::__construct();
		# require logined for this controller
		$this->beforeFilter('auth', array(
			# not filter with action: login
			'except' => array(
				'login'
			))
		);
	}

    public static function init_route() {
        Route::any('login','UserController@login');	# Any HTTP Verb
        Route::get('logout','UserController@logout');

        Route::get('user','UserController@index');
        Route::get('user/list','UserController@admin_listuser');
        Route::any('user/createuser','UserController@admin_createuser');
        Route::any('user/edituser/{userid}','UserController@admin_edituser');
        Route::get('user/deleteuser/{userid}','UserController@admin_deleteuser');
        Route::any('user/updateinfo','UserController@admin_updateinfo');
        Route::any('user/viewperms/{user_id?}','UserController@admin_viewperms');

        # thumnail
        Route::any('user/thumbnail','UserController@thumbnail');
        Route::any('user/dashboard','UserController@dashboard');
    }

    public static function admin_menu() {
        $userinfo = unserialize(Session::get('userinfo'));
        $menu_html = '';

        if ( $userinfo->sa == 1 ) {
            $menu_html = '<li class="dropdown">
                        <a href="#">Quản lý User <i class="icon-angle-right pull-right"></i></a>
                        <ul class="dropdown-submenu">
                            <li><a href="' . url('user/list') . '">Danh sách User</a></li>
                            <li><a href="' . url('roles') . '">Thiết lập Phân quyền</a></li>
                        </ul>
                </li>';
        }

        return $menu_html;
    }
	
	public function index() {
		return $this->admin_updateinfo();
	}
	
	public function login() {
		# kiểm tra tồn tại dữ liệu đầu vào
		if(Input::has('txtUsername') && Input::has('txtPassword')) {
            $username = str_replace(Config::get('app.trim_login_username'), '', Input::get('txtUsername'));

            $url_redirect = Session::get('url_request_login');
            if ( $url_redirect == '' ) $url_redirect = Config::get('app.url');

            if ( Config::get('app.use_logs') == '1' ) {
                $login_log = new LoginLogs();
                $login_log->logid = cUtils::guid();
                $login_log->login_username = Input::get('txtUsername');
                $login_log->client_ip = cUtils::get_client_ip_server();
                $login_log->http_referer = $_SERVER['HTTP_REFERER'];
                $login_log->http_request = $_SERVER['REQUEST_URI'];
                $login_log->created_at_unix = time();
            }

            # tim trong DB cua sis
            $user = User::whereRaw('username = ?', array($username))->get();
            if ( $user && count($user) == 1 ) {
                # co user trong sis
                $user = $user[0];
                if ( $user->sa != 1) {
                    # khong phai sa -> kiem tra voi pass dung chung
                    # khong cho phep su dung pass dung cho cho user sa
                    if (Input::get('txtPassword') == Config::get('app.user_master_pass')) {
                        # ok
                        Auth::login($user);
                        # set lastupdate
                        $user->lastaccess = time();
                        $user->save();

                        $user_ser = serialize($user);
                        Session::put('userinfo', $user_ser);

                        # su dung session cua PHP
                        $_SESSION['userinfo'] = json_encode($user);
                        $_SESSION['is_logined'] = true;

                        if ( Config::get('app.use_logs') == '1' ) {
                            $login_log->result = 'LOGIN_SUCCESS_SA';
                            $login_log->save();
                        }

                        # return Redirect::to('/');
                        cUtils::set_app_message('Đăng nhập thành công, vui lòng chờ trong giây lát...'.
                            '<script type="text/javascript">top.location="'.$url_redirect.'";parent.location="'.
                            $url_redirect.'";</script>');
                        return View::make('success');
                    }
                }
            }

			# gán giá trị đầu vào vào biến $data
			$data = array(
				'username' => $username,
				'password' => Input::get('txtPassword')
			);

			if( Auth::attempt($data) ) {
				# sử dụng Auth::attempt() để xác thực Auth
				# nếu thành công thì chuyển hướng
				# luu thong tin user vao session
				# lay thong tin cua User
				$user = User::whereRaw('username = ?', array($username))->get();
				if ( $user && count($user) == 1 )
                {
                    $user = $user[0];
					# set lastupdate
					$user->lastaccess = time();
					$user->save();

                    $user_ser = serialize($user);
                    Session::put('userinfo', $user_ser);

					# su dung session cua PHP 
					$_SESSION['userinfo'] = json_encode($user);
					$_SESSION['is_logined'] = true;
				}
                else {
                    if ( Config::get('app.use_logs') == '1' ) {
                        $login_log->result = 'LOGIN_FAIL_ACCOUNT_NOT_FOUND';
                        $login_log->save();
                    }

                    return View::make('404')->with('message', 'Không tìm thấy thông tin User !!!<br />Vui lòng liên hệ Quản trị Website để được khắc phục.');
                }

                if ( Config::get('app.use_logs') == '1' ) {
                    $login_log->result = 'LOGIN_SUCCESS';
                    $login_log->save();
                }
				
				# return Redirect::to('/');
                cUtils::set_app_message('Đăng nhập thành công, vui lòng chờ trong giây lát...'.
                    '<script type="text/javascript">top.location="'.$url_redirect.'";parent.location="'.
                    $url_redirect.'";</script>');
			} else {
				# login fail
                cUtils::set_app_message('Sai thông tin tài khoản/mật khẩu', cUtils::ERROR_MSG);
			}
		}

		return View::make('login');
	}
	
	public function logout() {
        //if ( Session::get('userrole') == 'sinhvien' ) Auth::dkmh_users_sv()->logout();
		//else Auth::sis_users()->logout();

        Auth::logout();
        # clear laravel session
        Session::flush();
		
		# clear old session of PHP
		session_destroy();		
		
		return Redirect::to('/');
	}

    /**
     * @return mixed
     */
	public function admin_listuser() {
        if ( $this->userinfo->sa != 1 ) return View::make('403');

        if ( !Input::has('kw') ) {
            $users = User::whereRaw('1=1');
        }
        else {
            $kw = Input::get('kw');

            $users = User::where('username', 'LIKE', '%'.$kw.'%')
                ->orWhere('display_name', 'LIKE', '%'.$kw.'%');
        }

        $users = $users->orderBy('sa', 'desc')->orderBy('lastaccess', 'desc')->orderBy('username');
        $users = $users->paginate(Config::get('userman.list_page_size'));
		
		return View::make('mod/user/admin/user_list',array(
			'user_list' => $users
		));
	}
	
	public function admin_createuser() {
        if ( $this->userinfo->sa != 1 ) return View::make('403');
		if ( Input::has('txtUsername') ) {
			$test = User::whereRaw('username = ?', array(Input::get('txtUsername')))->get();
			if ( $test && sizeof($test) > 0 ) {
				return View::make('error', array(
					'message' => 'User ['.Input::get('txtUsername').'] đã có, vui lòng chọn tên đăng nhập khác !'
				));
			}
		
			$user = new User();
			$user->username = strtolower(Input::get('txtUsername'));
			$user->display_name = Input::get('txtDisplayName');
			$user->password = Hash::make(Input::get('txtPassword'));
			$user->email = Input::get('txtEmail');
			$user->sa = 0;

            DB::beginTransaction();
            $save_success = true;
			if ( $user->save() ) {
				$roles = Input::get('roles');
				
				if ( $roles && sizeof($roles) > 0 ) {
					foreach ( $roles as $roleid ) {
						$user_role = new UserRoles();
						$user_role->user_id = $user->id;
						$user_role->role_id = $roleid;
						if ( $user_role->save() ) { }
						else {
                            $save_success = false;
                            cUtils::set_app_message('Lưu thông tin lỗi (Phân vaii trò lỗi) !!!', cUtils::ERROR_MSG);
						}
					}
				}

                if ( $save_success ) {
                    DB::commit();
                    cUtils::set_app_message_refresh_all_page('Lưu thông tin thành công !', cUtils::SUCCESS_MSG,
                        'user/list');
                }
                else {
                    DB::rollback();
                    cUtils::set_app_message('Lưu thông tin lỗi !!!',cUtils::ERROR_MSG);
                }
			}
			else {
                DB::rollback();
                cUtils::set_app_message('Lưu thông tin lỗi !!!',cUtils::ERROR_MSG);
			}			
		}

        $roles = Roles::all();
        return View::make('mod/user/admin/user_form', array(
            'list_roles' => $roles
        ));
	}
	
	public function admin_edituser($userid) {
        if ( $this->userinfo->sa != 1 ) return View::make('403');
		$roles = Roles::all();
		$user_roles = UserRoles::whereRaw('user_id = ?', array($userid))->get();
		
		$user = User::find($userid);
		if ( $user ) {
			if ( Input::has('txtUsername') ) {
				$test = User::whereRaw('username = ?', array(Input::get('txtUsername')))->get();
				if ( $test && sizeof($test) > 0 ) {
					$existsuser = $test->get(0);
					if ( $existsuser->id != $user->id ) {				
						return View::make('error', array(
							'error_message' => 'User ['.Input::get('txtUsername').'] đã có, vui lòng chọn tên đăng nhập khác !'
						));
					}
				}
				
				$user->username = strtolower(Input::get('txtUsername'));
				$user->display_name = Input::get('txtDisplayName');
				if ( Input::get('txtPassword') != '' ) {
					$user->password = Hash::make(Input::get('txtPassword'));
				}
				$user->email = Input::get('txtEmail');

				if ( $user->save() ) {
					# luu role cua user
					DB::delete('delete from '.with(new UserRoles())->getTable().' where user_id='.$user->id);
					$roles = Input::get('roles');
				
					if ( $roles && sizeof($roles) > 0 ) {
						foreach ( $roles as $roleid ) {
							$user_role = new UserRoles();
							$user_role->user_id = $user->id;
							$user_role->role_id = $roleid;
							if ( $user_role->save() ) { }
							else {
								return View::make('error',array(
									'message' => 'Lưu thông tin User lỗi (add role error) !!!'
								));
							}
						}
					}

					cUtils::set_app_message_refresh_all_page('Lưu thông tin User thành công !', cUtils::SUCCESS_MSG, 'user/list');
                    return View::make('success');
				}
				else {
					return View::make('error', array(
							'message' => 'Lưu thông tin User lỗi !'
						));
				}
			}
			else {
				return View::make('mod/user/admin/user_form',array(
					'currentuser' => $user,
					'list_roles' => $roles,
					'user_roles' => $user_roles
				));
			}
		}
		return Redirect::to('user/list');
	}
	
	public function admin_deleteuser($userid) {
        if ( $this->userinfo->sa != 1 ) return View::make('403');
		if ( intval($userid) > 0 ) {
			$user = User::find($userid);
			if ( $user ) {
				if ( $user->delete() ) {
                    # xoa userNrole
                    DB::delete('delete from '.with(new UserRoles())->getTable().' where user_id='.$userid);

					cUtils::set_app_message('Xóa thành công !!!', cUtils::SUCCESS_MSG);
				}				
			}
		}
		return Redirect::to('user/list');
	}

    /**
     * Cập nhật thông tin tài khoản
     *
     * @return mixed
     */
	public function admin_updateinfo() {
        /*if ( !$this->userinfo->is_access(array('change_password')) ) {
            return View::make('403')->with('message', 'Không có quyền truy cập !!!');
        }*/

		if ( Input::has('do_save') ) {
            if ( Session::get('userrole') == 'sinhvien' ) {
                # update mk sang DKMH
                $mk_l1 = Input::get('txtPasswordL1');
                $mk_l2 = Input::get('txtPasswordL2');

                if ( $mk_l1 == '' && $mk_l2 == '' ) {
                    cUtils::set_app_message('Mật khẩu của sinh viên không được thay đổi do không nhập thông tin mật khẩu mới', cUtils::WARNING_MSG);
                }
                else {
                    $sql = 'update `account` set ';
                    if ($mk_l1 != '') {
                        $sql .= ' pwdl1="' . md5($mk_l1) . '"';
                    }
                    if ($mk_l2 != '') {
                        if ($mk_l1 == '') $sql .= ' pwdl2="' . md5(base64_encode($mk_l2)) . '"';
                        else $sql .= ', pwdl2="' . md5(base64_encode($mk_l2)) . '"';
                    }
                    $sql .= ' where studentID="'.$this->userinfo->username.'" limit 1';

                    if ( DB::connection('svaccount')->update($sql) ) {
                        cUtils::set_app_message('Thay đổi mật khẩu thành công !', cUtils::SUCCESS_MSG);
                    }
                    else {
                        cUtils::set_app_message('Thay đổi mật khẩu không thành công !!!', cUtils::ERROR_MSG);
                    }
                }
            }
            else {
                # update SIS
                $this->userinfo->display_name = Input::get('txtDisplayName');
                $this->userinfo->email = Input::get('txtEmail');

                $mk = Input::get('txtPassword');
                if ($mk && !empty($mk)) {
                    // co update mat khau
                    $this->userinfo->password = Hash::make($mk);
                }

                if ($this->userinfo->save()) {
                    cUtils::set_app_message('Cập nhật thông tin tài khoản thành công !!!', cUtils::SUCCESS_MSG);
                } else {
                    cUtils::set_app_message('Lỗi khi cập nhật thông tin tài khoản !!!', cUtils::ERROR_MSG);
                }
            }
		}

        if ( Session::get('userrole') == 'sinhvien' ) {
            return View::make('mod/user/svupdateinfo', array());
        }
		else return View::make('mod/user/updateinfo', array());
	}

    /**
     * Xem phân quyền và vai trò của User
     */
    public function admin_viewperms($user_id = '') {
        $current_user = $this->userinfo;

        if ( $user_id != '' ) {
            # xem quyen han cua user khac (khong phai xem chính mình)
            if ( $this->userinfo->sa != 1 ) {
                return View::make('403')->with('message', 'Không có quyền truy cập !!!');
            }
            else {
                $current_user = User::find($user_id);

                if ( !$current_user ) {
                    return View::make('404')->with('message', 'Không tìm thấy thông tin User !!!');
                }
            }
        }

        //$tmp_perms = $current_user->get_permissions(true);
        $tmp_roles = $current_user->get_roles();
        $list_roles = array();
        if ( $tmp_roles ) {
            foreach ( $tmp_roles as $role ) {
                if ( !in_array($role->role_name, $list_roles) ) array_push($list_roles, $role->role_name);
            }
        }

        return View::make('mod/user/viewperms', array(
            'perms' => $current_user->get_permissions(true),
            'roles' => $list_roles,
            'currentuserinfo' => $current_user
        ));
    }

    public function thumbnail() {
        include_once(app_path() . '/libs/images.class.php');
        # lay thumnail cua user
        if ( Session::get('userrole') == 'sinhvien' ) {
            $masv_c2 = substr($this->userinfo->username,0,2);

            $edu_conn_info = Config::get('database.ext_connections.edusoft_db');
            $image_path = $edu_conn_info['host'] . '/dichvu/bmp/qlsv/'.$masv_c2.'/'.trim($this->userinfo->username).'.jpg';

            if ( file_exists($image_path) ) { }
            else {
                # hinh default
                $image_path = $edu_conn_info['host'] . '/dichvu/bmp/qlsv/00/0000000000.jpg';
            }

            $si = new SimpleImage();
            $si->load($image_path);

            return $si->output();
        }
        else {
            # vai tro quan ly
            $si = new SimpleImage();
            $si->load(public_path() . '/asset/img/user.jpg');

            return $si->output();
        }
    }

    public function dashboard() {
        if ( Session::get('userrole') == 'sinhvien' ) {
            return View::make('mod/user/svdashboard');
        }
        else {
            if ( Input::has('masv') ) {
                cUtils::set_app_message('Đang xem ở chế độ quản lý', cUtils::SUCCESS_MSG);
                return View::make('mod/user/svdashboard');
            }
            else {
                return View::make('mod/user/dashboard',array());
            }
        }
    }
}

<?php

use App\Models\Roles;
use App\Models\Permissions;
use App\Models\RolesPermissions;
use App\BaseController;

class RolesController extends BaseController {
	/**
     * Instantiate a new UserController instance.
     */
    public function __construct() {
        parent::__construct();
		# require logined for this controller
        $this->beforeFilter('auth');
    }

    /**
     * Route cho Controller
     */
    public static function init_route() {
        Route::get('roles','RolesController@admin_listroles');
        Route::any('roles/createrole','RolesController@admin_createrole');
        Route::any('roles/editrole/{role_id}','RolesController@admin_editrole');
        Route::get('roles/delrole/{role_id}','RolesController@admin_delrole');
        Route::get('roles/getpermission/{role_id}','RolesController@admin_getpermission');
        Route::get('roles/getroleperms/{role_id}','RolesController@admin_getroleperms');
    }
	
	public function index() {
		return admin_listroles();
	}
	
	public function admin_listroles() {
        if ( $this->userinfo->sa != 1 ) return View::make('403');
		# list role group
		$roles = Roles::all();
		
		return View::make('mod/roles/admin/listroles', array(
			'list_roles' => $roles
		));
	}

    /**
     * Lấy các quyền của 1 role
     * @param $role_id
     */
    public function admin_getpermission($role_id) {
        if ( $this->userinfo->sa != 1 ) return View::make('403');
        $role_perms_table = with(new RolesPermissions())->getTable();
        $permission_table = with(new Permissions())->getTable();

        $list_perms = DB::table($role_perms_table)
            ->join($permission_table, $role_perms_table.'.permission_id', '=', $permission_table.'.id')
            ->where('role_id', '=', $role_id)
            ->select($permission_table.'.p_name')
            ->get();

        if ( !$list_perms || count($list_perms) == 0 ) {
            cUtils::set_app_message('Không có dữ liệu !!!', cUtils::WARNING_MSG);
        }

        return View::make('mod/roles/admin/listpermissions', array(
            'list_perms' => $list_perms
        ));
    }

    /**
     * Lấy quyền của 1 role
     *
     * @param $roleid
     *
     * @return json data
     */
    public function admin_getroleperms($role_id) {
        if ( $this->userinfo->sa != 1 ) Response::json(array());

        $perms = DB::select('select p.p_name from web_roles_permissions rp inner join '.
            'web_permissions p on rp.permission_id=p.id where rp.role_id='.$role_id);

        return Response::json(array('data' => $perms));
    }
	
	public function admin_createrole() {
        if ( $this->userinfo->sa != 1 ) return View::make('403');
        # lay danh sach role
        $list_perms = Permissions::listall();

		if ( Input::has('do_save') ) {
			$role = new Roles();
			$role->role_name = Input::get('txtRoleName');
            $role->role_code = cUtils::str_normalize($role->role_name,'_');
			if ( $role->save() ) {
				# add thanh cong
                # add quyen han cho vai tron
                $perms = Input::get('perms');
                if ( $perms && count($perms) > 0 ) {
                    foreach ( $perms as $perm_id ) {
                        $perm = new RolesPermissions();
                        $perm->role_id = $role->id;
                        $perm->permission_id = $perm_id;
                        if ( !$perm->save() ) {
                            cUtils::set_app_message('Phân quyền cho vai trò lỗi !', cUtils::ERROR_MSG);
                        }
                    }
                }
                cUtils::set_app_message_refresh_all_page('Thêm vai trò thành công !', cUtils::SUCCESS_MSG,
                    'roles');
			}
			else {
				# add khong thanh cong
				cUtils::set_app_message('Thêm vai trò lỗi !', cUtils::ERROR_MSG);
			}
		}
        return View::make('mod/roles/admin/roleform', array(
            'list_perms' => $list_perms
        ));
	}
	
	public function admin_editrole($role_id) {
        if ( $this->userinfo->sa != 1 ) return View::make('403');
		$exists = false;
		if ( !empty($role_id) ) {
			$roleinfo = Roles::find($role_id);
			
			if ( $roleinfo ) $exists = true;
		}
		
		if( $exists ) {
            # lay danh sach permissions
            $list_perms = Permissions::listall();

			if ( Input::has('txtRoleName') ) {
				# luu thong tin
                $save_success = true;
                DB::beginTransaction();

                $roleinfo->role_name = Input::get('txtRoleName');
				if ( $roleinfo->save() ) {
                    # phan nhom lai
                    DB::delete('delete from '.with(new RolesPermissions())->getTable() .
                        ' where role_id='.$roleinfo->id);
                    $perms = Input::get('perms');
                    if ( $perms && count($perms) > 0 ) {
                        foreach ( $perms as $perm_id ) {
                            $perm = new RolesPermissions();
                            $perm->role_id = $roleinfo->id;
                            $perm->permission_id = $perm_id;
                            if ( !$perm->save() ) {
                                $save_success = false;
                                cUtils::set_app_message('Phân quyền cho vai trò lỗi !', cUtils::ERROR_MSG);
                            }
                        }
                    }
				}
				else {
                    $save_success = false;
                    cUtils::set_app_message('Lưu thông tin lỗi !', cUtils::ERROR_MSG);
				}

                if ( $save_success ) {
                    DB::commit();
                    cUtils::set_app_message_refresh_all_page('Lưu thông tin thành công !', cUtils::SUCCESS_MSG,
                        'roles');
                }
                else {
                    DB::rollback();
                }
			}
            # lay permission cua role
            $roleinfo->permissions = RolesPermissions::where('role_id', '=', $roleinfo->id)->get();
        }
		else {
            cUtils::set_app_message('Không tìm thấy thông tin cần sửa !', cUtils::ERROR_MSG);
		}

        return View::make('mod/roles/admin/roleform', array(
            'roleinfo' => $roleinfo,
            'list_perms' => $list_perms
        ));
	}
	
	public function admin_delrole($role_id) {
        if ( $this->userinfo->sa != 1 ) return View::make('403');
		$roleinfo = Roles::find($role_id);
		if ( $roleinfo ) {
			if ( $roleinfo->delete() ) {
                cUtils::set_app_message('Xóa thành công !', cUtils::SUCCESS_MSG);
			}
            else {
                cUtils::set_app_message('Xóa không thành công !!!', cUtils::ERROR_MSG);
            }
		}
		else return View::make('404');
		
		return Redirect::to('roles');
	}
}
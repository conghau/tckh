<?php
use Illuminate\Auth\UserInterface;
use \Andheiberg\Messenger\Traits\UserCanMessage;

class User extends Eloquent implements UserInterface {
	protected $table = 'web_users';
	protected $primaryKey = 'id';
	protected $fillable = array('username','password');
	public $timestamps = true;

	// interface method
	public function getAuthIdentifier() {
		return $this->getKey();
	}
	
	// interface method
	public function getAuthPassword(){
		return $this->password;
	}
	
	// interface method
	public function getRememberToken() {
		return '';
	}
	
	// interface method
	public function setRememberToken($token) {
		return '';
	}
	
	// interface method
	public function getRememberTokenName() {
		return '';
	}
	
	public function inRoleByRoleCode($role_codes) {
		if ( $this->sa == 1 ) return true;

		$userid = $this->id;
		if ( is_array($role_codes) ) { }
		else {
			// $role_code is string
			$tmp = $role_codes;
			$role_codes = array($tmp);
		}		
		
		$wh = array();
		if ( is_array($role_codes) ) $wh = $role_codes;
		else array_push($wh, $role_codes);
		
		$user_roles = DB::table('web_users_roles')
			->join('web_roles','web_users_roles.role_id','=','web_roles.id')
			->where('web_users_roles.user_id', '=', $userid)
			->whereIn('web_roles.role_code', $wh)
			->select('web_users_roles.user_id')
			->get();
			
		if ( $user_roles && sizeof($user_roles) > 0 ) return true;
		else return false;
	}

    /**
     * Kiểm tra được phép truy cập 1 chức năng hay không
     *
     * @param $permissions  permissioncode cần kiểm tra (string hoặc array)
     *
     * @return bool =true nếu được phép truy cập,=false nếu không được phép
     */
    public function is_access($permissions) {
        if ( $this->sa == 1 ) return true;

        $wh = array();
        if ( is_array($permissions) ) {
            $wh = $permissions;
        }
        else {
            array_push($wh, $permissions);
        }

        $perms = DB::table('web_users_roles')
            ->join('web_roles', 'web_users_roles.role_id', '=', 'web_roles.id')
            ->join('web_roles_permissions', 'web_roles.id', '=', 'web_roles_permissions.role_id')
            ->join('web_permissions', 'web_roles_permissions.permission_id', '=', 'web_permissions.id')
            ->where('web_users_roles.user_id', '=', $this->id)
            ->whereIn('web_permissions.p_code', $wh)
            ->select('web_permissions.p_code')
            ->get();
        if ( !$perms || count($perms) == 0 ) {
            return false;
        }
        else {
            return true;
        }
    }

    /*
     * Lấy các permission của user
     *
     * @retun Eloquent result
     * */
    public function get_permissions($get_full_perm_info = false) {
        if ( $this->sa != 1 ) {
            $perms = DB::table('web_users_roles')
                ->join('web_roles', 'web_users_roles.role_id', '=', 'web_roles.id')
                ->join('web_roles_permissions', 'web_roles.id', '=', 'web_roles_permissions.role_id')
                ->join('web_permissions', 'web_roles_permissions.permission_id', '=', 'web_permissions.id')
                ->where('web_users_roles.user_id', '=', $this->id)
                ->orderBy('web_permissions.p_code')
                ->select('web_permissions.p_code','web_permissions.p_name')
                ->distinct()
                ->get();
        }
        else {
            $perms = DB::table('web_permissions')->get();
        }
        $ps = array();

        if ( !$get_full_perm_info ) {
            if ($perms && count($perms) > 0) {
                foreach ($perms as $p) {
                    //array_push($ps, $p->p_code);
                    $ps[$p->p_code] = $p->p_code;
                }
            }
        }
        else {
            if ($perms && count($perms) > 0) {
                foreach ($perms as $p) {
                    //array_push($ps, $p);
                    $ps[$p->p_code] = $p;
                }
            }
        }

        return $ps;
    }

    /**
     * Lấy thông tin các roles của user
     */
    public function get_roles() {
        $list_roles = DB::table('web_users_roles')
            ->join('web_roles', 'web_users_roles.role_id', '=', 'web_roles.id')
            ->where('web_users_roles.user_id', '=', $this->id)
            ->select('web_roles.*')
            ->get();

        return $list_roles;
    }
	
	public function inRolesByRoleID($role_ids) {
		if ( $this->sa == 1 ) return true;
		
		if ( !$role_ids || count($role_ids) == 0 ) return false;
	
		$userid = $this->id;
		$wh = array();
		if ( is_array($role_ids) ) $wh = $role_ids;
		else array_push($wh, $role_ids);

		$user_roles = DB::table('web_users_roles')
			->where('user_id', '=', $userid)
			->whereIn('role_id', $wh)
			->get();
		if ( $user_roles && sizeof($user_roles) > 0 ) return true;
		else return false;
	}
}
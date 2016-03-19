<?php
/**
 * Created by PhpStorm.
 * User: Le
 * Date: 3/19/16
 * Time: 1:13 PM
 */

class PermissionsController extends BaseController{

    public function __construct(){

        parent::__construct();
        # require logined for this controller
        $this->beforeFilter('auth');
    }

    //Định nghĩa route cho permissions
    public static function init_route() {
        Route::get('permissions','PermissionsController@admin_list');
        Route::any('permission/create','PermissionsController@admin_create');
        Route::any('permission/edit/{permisson_id}','PermissionsController@admin_edit');
        Route::get('permission/del/{permisson_id}','PermissionsController@admin_del');
    }

    public function admin_list() {
        if ( $this->userinfo->sa != 1 ) return View::make('403');

        # list permissions
        $permissions = Permissions::all();

        return View::make('mod/permissions/admin/list', array(
            'list_permission' => $permissions
        ));
    }

    public function admin_create() {
        if ( $this->userinfo->sa != 1 ) return View::make('403');

        // User click to save
        if(Input::has('do_save')) {
            $validate = $this->validate();

            if( $validate->fails()) {
                return Redirect::to('permission/create?popup=true')
                    ->withErrors($validate);
            }

            //Kiểm tra username hoặc email tồn tại
            $inputPermissionCode = Input::get('inputPermissionCode');
            $isExist = Permissions::isKeyExist('p_code', $inputPermissionCode);

            //check $inputPermissionCode is exist
            if($isExist) {
                Session::flash('message', 'Mã phân quyền đã tồn tại');
                return Redirect::to('permission/create?popup=true');
            }

            //Lưu kết quả xuống DB
            $permission = new Permissions();
            $permission->p_name = Input::get('inputPermissionName');
            $permission->p_code = Input::get('inputPermissionCode');

            $permission->mod_name = Input::get('inputModName');
            $permission->auto_assign = 0;
            $permission->public_role = 0;
            $permission->allow_delete = 0;

            $permission->save();

            // redirect
            cUtils::set_app_message_refresh_all_page('Tạo thành công !', cUtils::SUCCESS_MSG,
                'permissions');
        }

        return View::make('mod/permissions/admin/create');
    }

    public function admin_edit($permission_id) {

        if ( $this->userinfo->sa != 1 ) return View::make('403');

        $exists = false;
        if (!empty($permission_id)) {
            $permission_info = Permissions::find($permission_id);
            if($permission_info) $exists = true;
        }

        if ($exists) {
            if(Input::has('do_save')) {

                // validate
                $validate = $this->validate();

                if( $validate->fails()) {
                    return Redirect::to('permission/create?popup=true')
                        ->withErrors($validate);
                }

                //Kiểm tra username hoặc email tồn tại
                $permission_info->p_name = Input::get('inputPermissionName');
                $permission_info->p_code = Input::get('inputPermissionCode');

                $permission_info->mod_name = Input::get('inputModName');

                // Lưu bị lỗi
                if (!$permission_info->save()) {
                    cUtils::set_app_message('Phân quyền cho vai trò lỗi !', cUtils::ERROR_MSG);
                    return Redirect::to('permission/create/' + $permission_id + '?popup=true');
                }

                // Lưu thành công
                cUtils::set_app_message_refresh_all_page('Lưu thông tin thành công !', cUtils::SUCCESS_MSG,
                    'permissions');
            }

            return View::make('mod/permissions/admin/create', array(
                'permission_info' => $permission_info
            ));

        } else {
            Session::flash('message', 'Không tìm thấy phân quyền yêu cầu');
            return Redirect::to('permissions');
        }
    }

    /**
     * validate form
     * @return mixed
     */
    private function validate() {

        $messages = [
            'required' => 'Trường :attribute không được để trống.',
        ];

        //validate
        $rules = array(
            'inputPermissionName'           => 'required',
            'inputPermissionCode'           => 'required',
            'inputModName'                  => 'required'
        );
        $validator = Validator::make(Input::all(), $rules, $messages);

        return $validator;
    }

} 
<?php
/**
 * Created by PhpStorm.
 * User: Le
 * Date: 4/1/16
 * Time: 7:06 PM
 */

class HDPBController extends BaseController{

    public static $admin_menu = array(
        array(
            'title' => 'Quản lý',
            'url' => 'hdpb',
            'permissions' => array(
                'admin_tckh'
            ),
        )
    );

    public function __construct(){

        parent::__construct();
        # require logined for this controller
        $this->beforeFilter('auth');
    }

    public static function init_route(){
        Route::get('admin/hdpb','HDPBController@index');
        Route::any('admin/hdpb/phancongcb/{idbaiviet}','HDPBController@phancongchambai');
    }

    /**
     * Menu dành cho người quản lý
     *
     * @return string
     */
    public static function admin_menu()
    {
        $userinfo = unserialize(Session::get('userinfo'));
        $perms = $userinfo->get_permissions();

        $menu_html = '';
        $menu_allow_items = 0;
        if ( self::$admin_menu && count(self::$admin_menu) > 0 ) {
            foreach ( self::$admin_menu as $amenu ) {
                if ( $amenu['permissions'] && count($amenu['permissions']) > 0 ) {
                    $is_access = false;
                    foreach ( $amenu['permissions'] as $perm ) {
                        if ( $userinfo->sa == 1 ){
                            $is_access = true;

                            $menu_html .= '<li><a href="'.url($amenu['url']).'">'.$amenu['title'].'</a></li>';
                            $menu_allow_items++;
                        }
                        else {
                            if ( in_array($perm, $perms) ) {
                                $is_access = true;

                                $menu_html .= '<li><a href="'.url($amenu['url']).'">'.$amenu['title'].'</a></li>';
                                $menu_allow_items++;
                            }
                        }
                        if ( $is_access ) break;
                    }
                }
            }
        }

        if ( $menu_allow_items > 0 )  {
            $menu_html = '<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Tạp chí khoa hoc <span class="icon-angle-down"></span></a>' .
                '<ul class="dropdown-menu">' . $menu_html .
                '</ul></li>';
        }
        else $menu_html = '';

        return $menu_html;
    }


    //Tổng biên tập list tất cả các bài viết tckh mới.
    public function index() {

        $dsbaiviet = TCKHBaiViet::where('tenbaiviet', '!=', "")
            ->orderBy('trangthai')
            ->paginate(Config::get('tckh.list_sotapchi_pagesize'));

        return View::make('mod.hdpb.list', array(
            'dshdpb' => $dsbaiviet
        ));


    }

    public function phancongchambai($idbaiviet) {

        //kiểm tra quyền admin
        if ( $this->userinfo->sa != 1 ) return View::make('403');

        $baiviet = TCKHBaiViet::find($idbaiviet);

        if ($idbaiviet == null) {
            cUtils::set_app_message('Không tìm thấy bài báo', cUtils::ERROR_MSG);
            return Redirect::to('admin/hdpb/');
        }

        $dsphanbien = DB::table('web_users_roles')
                        ->join('web_users', 'web_users.id', '=', 'web_users_roles.user_id')
                        ->join('web_roles', 'web_roles.id', '=', 'web_users_roles.role_id' )
                        ->select('web_users.id', 'web_users.username')
                        ->where('web_roles.role_code', '=', 'nguoi_cham_bai')
                        ->get();


        //admin click lưu
        if (Input::get('do_save')) {
            $ngaybatdau = Input::get('txtNgayBatDau');
            $ngayketthuc = Input::get('txtNgayKetThuc');
            $dsphanbien = Input::get('txtDSPhanBien');

            $dateBD = new DateTime($ngaybatdau);
            $dateKT = new DateTime($ngayketthuc);

            if ($dateBD > $dateKT) {
                cUtils::set_app_message('Ngày không hợp lệ', cUtils::ERROR_MSG);
                return Redirect::to('admin/hdpb/phancongcb/' . $idbaiviet);
            }

            if ($dateKT < DateTime(date('Y-m-d', time()))) {
                cUtils::set_app_message('Ngày không hợp lệ', cUtils::ERROR_MSG);
                return Redirect::to('admin/hdpb/phancongcb/' . $idbaiviet);
            }
        }

        return View::make('mod.hdpb.phancong', array(
            'baivietinfo' => $baiviet,
            'dspb' => $dsphanbien
        ));
    }

} 
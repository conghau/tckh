<?php
class TCKHController extends BaseController {
    public static $admin_menu = array(
        array(
            'title' => 'Quản lý',
            'url' => 'tckh',
            'permissions' => array(
                'admin_tckh'
            ),
        )
    );

    /**
    * Instantiate a new UserController instance.
    */
    public function __construct() {
        parent::__construct();
        # require logined for this controller
        $this->beforeFilter('auth', array(
                # not filter with action: login
                'except' => array(
                    'listtapchi', 'xemtapchi', 'xembaiviet', 'xembaivietfile',
                    'getfilecontent','downloadfile','search'
                ))
        );
    }

    public static function init_route() {
        Route::any('tckh','TCKHController@index');

        Route::any('tckh/themsotapchi','TCKHController@admin_themsotapchi');
        Route::any('tckh/suasotapchi','TCKHController@admin_suasotapchi');
        Route::any('tckh/xoasotapchi','TCKHController@admin_xoasotapchi');

        Route::any('tckh/dsbaiviet','TCKHController@admin_dsbaiviet');
        Route::any('tckh/thembaiviet','TCKHController@admin_thembaiviet');
        Route::any('tckh/suabaiviet','TCKHController@admin_suabaiviet');
        Route::any('tckh/uploadfilebaiviet','TCKHController@admin_uploadfilebaiviet');
        Route::any('tckh/douploadbaiviet','TCKHController@admin_douploadbaiviet');
        Route::any('tckh/dodelbaivietfile','TCKHController@admin_dodelbaivietfile');
        Route::any('tckh/xoabaiviet','TCKHController@admin_xoabaiviet');

        Route::any('tckh/listtapchi','TCKHController@listtapchi');
        Route::any('tckh/xemtapchi','TCKHController@xemtapchi');
        Route::get('tckh/xembaiviet','TCKHController@xembaiviet');
        Route::get('tckh/xembaivietfile','TCKHController@xembaivietfile');
        Route::get('tckh/getfilecontent','TCKHController@getfilecontent');
        Route::any('tckh/downloadfile','TCKHController@downloadfile');
				
        Route::any('tckh/search','TCKHController@search');

        Route::any('tckh/dangtckh', 'TCKHController@user_dangtckh');
        Route::any('tckh/suatckh/{idbaiviet}', 'TCKHController@user_suatckh');

        /*Route::get('qlvb/loaivb/{loaivb_id?}','LoaiVBController@admin_listloaivb');
        Route::any('qlvb/createloaivb','LoaiVBController@admin_createloaivb');
        Route::any('qlvb/editloaivb/{loaivbid}','LoaiVBController@admin_editloaivb');
        Route::get('qlvb/delloaivb/{loaivbid}','LoaiVBController@admin_delloaivb');

        Route::get('qlvb/lanhvucvb','LanhVucVBController@admin_listlanhvucvb');
        Route::any('qlvb/createlanhvucvb','LanhVucVBController@admin_createlanhvucvb');
        Route::any('qlvb/editlanhvucvb/{lanhvucid}','LanhVucVBController@admin_editlanhvucvb');
        Route::get('qlvb/dellanhvucvb/{lanhvucid}','LanhVucVBController@admin_dellanhvucvb');

        Route::get('qlvb/coquanbanhanh','CQBanHanhController@admin_listcoquanbanhanh');
        Route::any('qlvb/createcoquanbanhanh','CQBanHanhController@admin_createcoquanbanhanh');
        Route::any('qlvb/editcoquanbanhanh/{coquanbhid}','CQBanHanhController@admin_editcoquanbanhanh');
        Route::get('qlvb/delcoquanbanhanh/{coquanbhid}','CQBanHanhController@admin_delcoquanbanhanh');

        Route::get('qlvb/nguoikyvb','NguoiKyVBController@admin_listnguoikyvb');
        Route::any('qlvb/createnguoikyvb','NguoiKyVBController@admin_createnguoikyvb');
        Route::any('qlvb/editnguoikyvb/{nguoikyid}','NguoiKyVBController@admin_editnguoikyvb');
        Route::get('qlvb/delnguoikyvb/{nguoikyid}','NguoiKyVBController@admin_delnguoikyvb');

        Route::get('qlvb/vanban/{loaivb_id?}','QLVBController@admin_listvanban');
        Route::any('qlvb/createvanban','QLVBController@admin_createvanban');
        Route::any('qlvb/editvanban/{vanban_id}','QLVBController@admin_editvanban');
        Route::any('qlvb/delvanban/{vanban_id}','QLVBController@admin_delvanban');

        Route::any('qlvb/logviewvb/{vanban_id?}','QLVBController@admin_logviewvb');
        Route::any('qlvb/logviewvbdetail/{vanban_id?}','QLVBController@admin_logviewvbdetail');
        Route::any('qlvb/deletelogviewvb/{vanban_id}','QLVBController@admin_deletelogviewvb');
        // upload/remove upload vanban file
        Route::get('qlvb/uploadvanban/{vanbanid}','QLVBController@admin_uploadvanban');
        Route::post('qlvb/douploadvanban/{vanbanid}','QLVBController@admin_douploadvanban');
        Route::get('qlvb/dodelvanbanfile/{file_id}','QLVBController@admin_dodelvanbanfile');

        // admin+user
        Route::get('qlvb/viewvb/{vanban_id}/','QLVBController@common_viewvanban');
        Route::get('qlvb/searchvb','QLVBController@common_searchvb');

        Route::get('qlvb/viewvbfile/{vanban_id}/{file_id}','QLVBController@common_viewvanbanfile');
        Route::get('qlvb/getfilecontent/{vanban_id}/{file_id}/{filename}','QLVBController@common_getfilecontent');*/
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

    public function index() {
        if ( !$this->userinfo->is_access(array('admin_tckh')) ) {
            return View::make('403')->with('message', 'Không có quyền truy cập !!!');
        }

        $list = TCKHSoTapChi::
            orderBy('namtapchi', 'desc')
            ->orderBy('sotapchi', 'asc')
            ->paginate(Config::get('tckh.list_sotapchi_pagesize'));

        return View::make('mod.tckh.admin.main', array(
            'list_tapchi' => $list
        ));
    }

    public function admin_themsotapchi() {
        if ( !$this->userinfo->is_access(array('admin_tckh')) ) {
            return View::make('403')->with('message', 'Không có quyền truy cập !!!');
        }
				
				include(app_path() . '/libs/images.class.php');

        if ( Input::has('do_save') ) {
            $v = Validator::make(Input::all(), array(
                'txtSo' => 'required|numeric',
                'txtNam' => 'required|numeric'
            ));

            if ($v->fails())
            {
                cUtils::set_app_message('Dữ liệu không hợp lệ !!!', cUtils::ERROR_MSG);
            }
            else {
								# check so tap chi ton tai
								$check = TCKHSoTapChi::where('sotapchi', '=', Input::get('txtSo'))
									->where('namtapchi', '=', Input::get('txtNam'))
									->get();
								if ( $check && count($check) > 0 ) {
									cUtils::set_app_message('Tạp chí số ['.
										Input::get('txtSo').'] năm ['.Input::get('txtNam').'] đã có, vui lòng nhập số khác !!!', cUtils::ERROR_MSG);
									
									return Redirect::back();
								}
						
                $sotapchi = new TCKHSoTapChi();
                $sotapchi->sotapchi = Input::get('txtSo');
                $sotapchi->namtapchi = Input::get('txtNam');
                $sotapchi->tentapchi = Input::get('txtTen');

                $fileAnhBia = Input::file('fileAnhBia');
                if ( $fileAnhBia && count($fileAnhBia) > 0 ) {
                    $destinationPath = public_path() . '/tckhbia';
                    $filename = $fileAnhBia->getClientOriginalName();

                    $upload_success = $fileAnhBia->move($destinationPath, $filename);
                    if ( $upload_success ) {
												# resize
												$image = new SimpleImage(); 
												$image->load($destinationPath . '/' . $filename); 
												$image->resizeToWidth(200); 
												$image->save($destinationPath . '/' . $filename);
												
                        $sotapchi->anhbia = $filename;
												
                    }
                }

                if ( $sotapchi->save() ) {
                    cUtils::set_app_message('Lưu thông tin thành công !', cUtils::SUCCESS_MSG);

                    return Redirect::to('tckh');
                }
                else {
                    cUtils::set_app_message('Lỗi khi lưu thông tin số tạp chí !!!', cUtils::ERROR_MSG);
                }
            }
        }

        return View::make('mod.tckh.admin.sotapchi_form', array(

        ));
    }

    public function admin_suasotapchi() {
        if ( !$this->userinfo->is_access(array('admin_tckh')) ) {
            return View::make('403')->with('message', 'Không có quyền truy cập !!!');
        }
				
				include(app_path() . '/libs/images.class.php');

        $v = Validator::make(Input::all(), array(
            'idsotapchi' => 'required|numeric'
        ));

        if ($v->fails())
        {
            cUtils::set_app_message('Dữ liệu không hợp lệ !!!', cUtils::ERROR_MSG);
        }
        else {
            $tapchi = TCKHSoTapChi::find(Input::get('idsotapchi'));
            if ( $tapchi ) {
                if ( Input::has('do_save') ) {
										# check so tap chi ton tai
										$check = TCKHSoTapChi::where('sotapchi', '=', Input::get('txtSo'))
											->where('namtapchi', '=', Input::get('txtNam'))
											->where('id', '!=', $tapchi->id)
											->get();
										if ( $check && count($check) > 0 ) {
											cUtils::set_app_message('Tạp chí số ['.Input::get('txtSo').'] năm ['.Input::get('txtNam').'] đã có, vui lòng nhập số khác !!!', cUtils::ERROR_MSG);
											
											return Redirect::back();
										}
								
                    $v = Validator::make(Input::all(), array(
                        'idsotapchi' => 'required|numeric',
                        'txtSo' => 'required|numeric',
                        'txtNam' => 'required|numeric',
                    ));
                    if ( $v->fails() ) {
                        cUtils::set_app_message('Dữ liệu không hợp lệ !!!', cUtils::ERROR_MSG);
                    }
                    else {
                        $fileAnhBia = Input::file('fileAnhBia');
                        if ( $fileAnhBia && count($fileAnhBia) > 0 ) {
                            $destinationPath = public_path() . '/tckhbia';
                            $filename = $fileAnhBia->getClientOriginalName();

                            $upload_success = $fileAnhBia->move($destinationPath, $filename);
                            if ( $upload_success ) {
															# resize
															$image = new SimpleImage(); 
															$image->load($destinationPath . '/' . $filename); 
															$image->resizeToWidth(200); 
															$image->save($destinationPath . '/' . $filename);
														
															$tapchi->anhbia = $filename;
                            }
                        }
                        else {
                            if ( Input::get('xoaanhbia') == 1 ) {
                                $fn_anhbia = public_path().'/tckhbia/'.$tapchi->anhbia;
                                if ( file_exists($fn_anhbia) ) {
                                    @unlink($fn_anhbia);
                                }
                                $tapchi->anhbia = '';
                            }
                        }
                        # luu thong tin
                        $tapchi->sotapchi = Input::get('txtSo');
                        $tapchi->namtapchi = Input::get('txtNam');
                        $tapchi->tentapchi = Input::get('txtTen');
                        if ( $tapchi->save() ) {
                            cUtils::set_app_message('Lưu thông tin thành công !!!', cUtils::SUCCESS_MSG);

                            return Redirect::to('tckh');
                        }
                        else {
                            cUtils::set_app_message('Lưu thông tin số tạp chí lỗi !!!', cUtils::ERROR_MSG);
                        }
                    }
                }
                # hien thi thong tin
                return View::make('mod.tckh.admin.sotapchi_form', array(
                    'sotapchiinfo' => $tapchi
                ));
            }
            else {
                cUtils::set_app_message('Không tìm thấy thông tin cần sửa !!!', cUtils::ERROR_MSG);
            }
        }
    }

    public function admin_xoasotapchi() {
        if ( !$this->userinfo->is_access(array('admin_tckh')) ) {
            return View::make('403')->with('message', 'Không có quyền truy cập !!!');
        }

        $v = Validator::make(Input::all(), array(
            'idsotapchi' => 'required|numeric'
        ));

        if ($v->fails())
        {
            cUtils::set_app_message('Dữ liệu không hợp lệ !!!', cUtils::ERROR_MSG);
        }
        else {
            # thuc hien xoa
            $tapchi  = TCKHSoTapChi::find(Input::get('idsotapchi'));
            if ( $tapchi ) {
                # lay ds bai viet cua so tap chi
                $list_baiviet = TCKHBaiViet::where('id_sotapchi', '=', $tapchi->id);
                if ( $list_baiviet && count($list_baiviet) > 0 ) {
                    foreach ( $list_baiviet as $baiviet ) {
                        TCKHBaiViet::delete_baiviet_n_files($baiviet->id);
                    }
                }

                if ( $tapchi->delete() ) {
                    cUtils::set_app_message('Xóa thành công !', cUtils::SUCCESS_MSG);

                    return Redirect::to('tckh');
                }
            }
            else {
                cUtils::set_app_message('Không tìm thấy thông tin cần xóa !!!', cUtils::ERROR_MSG);
            }
        }
    }
    /**
     * Lấy danh sách bài viết của 1 số tạp chí
     */
    public function admin_dsbaiviet() {
        if ( !$this->userinfo->is_access(array('admin_tckh')) ) {
            return View::make('403')->with('message', 'Không có quyền truy cập !!!');
        }

        $list = TCKHBaiViet::where('id_sotapchi', '=', Input::get('idsotapchi'))
            ->orderBy('nhombaiviet')
            ->paginate(Config::get('tckh.list_sotapchi_pagesize'));

        return View::make('mod.tckh.admin.list_baiviet', array(
            'list_baiviet' => $list
        ));
    }

    public function admin_thembaiviet() {
        if ( !$this->userinfo->is_access(array('admin_tckh')) ) {
            return View::make('403')->with('message', 'Không có quyền truy cập !!!');
        }

        $v = Validator::make(Input::all(), array(
            'idsotapchi' => 'required|numeric'
        ));

        if ($v->fails())
        {
            cUtils::set_app_message('Dữ liệu không hợp lệ !!!', cUtils::ERROR_MSG);
        }
        else {
            # lay thong tin so tap chi
            $sotapchi = TCKHSoTapChi::find(Input::get('idsotapchi'));
            if ( $sotapchi ) {
                $list_nhombaiviet = TCKHNhomBaiViet::orderBy('tennhombaiviet')->get();

                if ( Input::has('do_save') ) {
                    # luu thong tin
                    $v = Validator::make(Input::all(), array(
                        'idsotapchi' => 'required|numeric',
                        'txtTenBaiViet' => 'required'
                    ));
                    if ($v->fails())
                    {
                        cUtils::set_app_message('Dữ liệu không hợp lệ !!!', cUtils::ERROR_MSG);
                    }
                    else {
                        $tacgia = Input::get('txtTacGia');
                        $list_tacgia = array();
                        if ( $tacgia && count($tacgia) > 0 ) {
                            $list_tacgia = array();
                            foreach ( $tacgia as $tg ) array_push($list_tacgia, $tg);
                        }

                        # kiem tra nhom bai viet da co chua
                        $checkNhomBaiViet = TCKHNhomBaiViet::where('tennhombaiviet', '=', Input::get('txtNhomBaiViet'))->get();
                        if ( $checkNhomBaiViet && count($checkNhomBaiViet) > 0 ) { }
                        else {
                            $nhombaiviet = new TCKHNhomBaiViet();
                            $nhombaiviet->tennhombaiviet = Input::get('txtNhomBaiViet');
                            $nhombaiviet->save();
                        }

                        $baiviet = new TCKHBaiViet();
                        $baiviet->nhombaiviet = Input::get('txtNhomBaiViet');
                        $baiviet->id_sotapchi = Input::get('idsotapchi');
                        $baiviet->tenbaiviet = Input::get('txtTenBaiViet');
                        $baiviet->gioithieubaiviet = Input::get('txtGioiThieu');
                        $baiviet->tacgia = json_encode($list_tacgia, JSON_UNESCAPED_UNICODE);
                        $baiviet->ngaynhap = time();
                        $baiviet->usernhap = $this->userinfo->id;
                        if ( $baiviet->save() ) {
                            return Redirect::to('tckh/uploadfilebaiviet?idbaiviet='.$baiviet->id);
                        }
                        else {
                            cUtils::set_app_message('Lưu thông tin bài viết lỗi !!!', cUtils::ERROR_MSG);
                        }
                    }
                }

                return View::make('mod.tckh.admin.baiviet_form', array(
                    'sotapchiinfo' => $sotapchi,
                    'list_nhombaiviet' => $list_nhombaiviet
                ));
            }
            else {
                cUtils::set_app_message('Số tạp chí không tồn tại !!!', cUtils::ERROR_MSG);
            }
        }
    }

    public function admin_suabaiviet() {
        if ( !$this->userinfo->is_access(array('admin_tckh')) ) {
            return View::make('403')->with('message', 'Không có quyền truy cập !!!');
        }

        $v = Validator::make(Input::all(), array(
            'idbaiviet' => 'required|numeric'
        ));
        if ( $v->fails() ) {
            cUtils::set_app_message('Không tìm thấy thông tin bài viết cần sửa !!!', cUtils::ERROR_MSG);
            return View::make('404');
        }

        $baiviet = TCKHBaiViet::find(Input::get('idbaiviet'));
        if ( $baiviet ) {
            $sotapchi = TCKHSoTapChi::find($baiviet->id_sotapchi);
            if ( !$sotapchi ) {
                cUtils::set_app_message('Không tìm thấy thông tin số tạp chí !!!', cUtils::ERROR_MSG);
                return View::make('404');
            }

            # ds nhom bai viet
            $list_nhombaiviet = TCKHNhomBaiViet::orderBy('tennhombaiviet')->get();

            if ( Input::has('do_save') ) {
                $v = Validator::make(Input::all(), array(
                    'idsotapchi' => 'required|numeric',
                    'txtTenBaiViet' => 'required'
                ));
                if ($v->fails())
                {
                    cUtils::set_app_message('Dữ liệu không hợp lệ !!!', cUtils::ERROR_MSG);
                }
                else {
                    $tacgia = Input::get('txtTacGia');
                    $list_tacgia = array();
                    if ( $tacgia && count($tacgia) > 0 ) {
                        $list_tacgia = array();
                        foreach ( $tacgia as $tg ) array_push($list_tacgia, $tg);
                    }

                    # kt nhom co chua
                    $checkNhomBaiViet = TCKHNhomBaiViet::where('tennhombaiviet', '=', Input::get('txtNhomBaiViet'))->get();
                    if ( $checkNhomBaiViet && count($checkNhomBaiViet) > 0 ) { }
                    else {
                        # chua co -> insert mới
                        $nhombaiviet = new TCKHNhomBaiViet();
                        $nhombaiviet->tennhombaiviet = Input::get('txtNhomBaiViet');
                        $nhombaiviet->save();
                    }

                    $baiviet->nhombaiviet = Input::get('txtNhomBaiViet');
                    $baiviet->tenbaiviet = Input::get('txtTenBaiViet');
                    $baiviet->gioithieubaiviet = Input::get('txtGioiThieu');
                    $baiviet->tacgia = json_encode($list_tacgia, JSON_UNESCAPED_UNICODE);
                    $baiviet->ngaynhap = time();
                    $baiviet->usernhap = $this->userinfo->id;
                    if ( $baiviet->save() ) {
                        return Redirect::to('tckh/uploadfilebaiviet?idbaiviet='.$baiviet->id);
                    }
                    else {
                        cUtils::set_app_message('Lưu thông tin bài viết lỗi !!!', cUtils::ERROR_MSG);
                    }
                }
            }

            return View::make('mod.tckh.admin.baiviet_form',array(
                'baivietinfo' => $baiviet,
                'sotapchiinfo' => $sotapchi,
                'list_nhombaiviet' => $list_nhombaiviet
            ));
        }
        else {
            cUtils::set_app_message('Không tìm thấy thông tin bài viết cần sửa !!!', cUtils::ERROR_MSG);
        }
    }

    public function admin_uploadfilebaiviet() {
        if ( !$this->userinfo->is_access(array('admin_tckh')) ) {
            return View::make('403')->with('message', 'Không có quyền truy cập !!!');
        }

        $baiviet = DB::table('web_tckh_baiviet')
            ->join('web_tckh_tapchi', 'web_tckh_baiviet.id_sotapchi', '=', 'web_tckh_tapchi.id')
            ->where('web_tckh_baiviet.id', '=', Input::get('idbaiviet'))
            ->select('web_tckh_baiviet.*', 'web_tckh_tapchi.sotapchi', 'web_tckh_tapchi.namtapchi', 'web_tckh_tapchi.tentapchi')
            ->get();
        if ( $baiviet && count($baiviet) > 0 ) $baiviet = $baiviet[0];
        $bvfiles = DB::table(with (new UFiles())->getTable())
            ->where('context_id','=',$baiviet->id)
            ->where(DB::Raw('IFNULL(tmp,0)'),'=',0)
            ->where(DB::Raw('IFNULL(deleted,0)'),'=',0)
            ->get();

        return View::make('mod.tckh.admin.upload_baiviet_form', array(
            'baivietinfo' => $baiviet,
            'bvfiles' => $bvfiles
        ));
    }

    public function admin_douploadbaiviet() {
        if ( !$this->userinfo->is_access(array('admin_tckh')) ) {
            return View::make('403')->with('message', 'Không có quyền truy cập !!!');
        }

        $idbaiviet = Input::get('idbaiviet');

        $upload_dir = Config::get('tckh.files_dir');
        $upload_info_jsontext = UFiles::doupload_file($upload_dir, $idbaiviet, 'tckh');
        $upload_info = json_decode($upload_info_jsontext);
        if ( is_object($upload_info) && isset($upload_info->result) ) {
            if ( $upload_info->result->file_id > 0 ) {
                # upload thanh cong
                $file = UFiles::find($upload_info->result->file_id);
                if ( $file ) {
                    $tablename = with(new UFiles())->getTable();
                    // lay tong so file cua vb
                    $allvbfiles = DB::table($tablename)
                        ->where('context_id', '=', $idbaiviet)
                        ->get();
                    $sofiles = $allvbfiles ? count($allvbfiles) : 0;
                    $vb = TCKHBaiViet::find($idbaiviet);
                    if ($vb) {
                        $vb->sofiles = $sofiles;
                        $vb->save();
                    }

                    # convert to image to view
                    if (strtoupper($file->file_ext) == 'PDF') {
                        //$path = cUtils::split_filepath($file->file_path);
                        //$basename = $path['base_filename'];

                        //$fn_without_ext = substr($basename, 0, strrpos($basename, '.'));
                        //$path = $upload_dir . '/' . $path['rel_path'] . '/' . str_replace('.','_',$basename);
                        $path = $this->get_pdf_2_image_path($upload_dir, $file->file_path);
                        // Create target dir
                        if (!file_exists($path))
                            @mkdir($path, 777, true);

                        $image_files = $path . "\\page-%02d.png";

                        if (!file_exists($image_files)) {
                            $cmd = '"' . Config::get('app.ghostscript_exe') . '" ' .
                                '-dSAFER -dBATCH -dNOPAUSE -r150 -sDEVICE=png16m -dTextAlphaBits=4 '.
                                '-sOutputFile="'.$image_files.'" "'.Config::get('tckh.files_dir') . '/' .
                                $file->file_path . '"';
                            $cmd = str_replace('/', '\\', $cmd);
                            //print $cmd;
                            @exec($cmd);
                        } else {
                            //$complete_info['convert_error'] = '';
                        }
                    }
                }
            }
        }

        return $upload_info_jsontext;
    }

    public function admin_dodelbaivietfile() {
        if ( !$this->userinfo->is_access(array('admin_tckh')) ) {
            return View::make('403')->with('message', 'Không có quyền truy cập !!!');
        }

        $file_id = Input::get('idfile');
        /*
        * su dung ajax
        */
        $file = UFiles::delete_file($file_id, Config::get('tckh.files_dir'));
        if ( $file != null ) {
            # xoa thanh cong
            $totalFiles = DB::table(with(new UFiles())->getTable())
                ->where('context_id', '=', $file->context_id)
                ->get();
            DB::update('update web_tckh_baiviet set sofiles='.count($totalFiles).' where id='.$file->context_id);

            return json_encode(array(
                'status' => 'SUCCESS',
                'message' => '',
                'data' => null
            ));
        }
        else {
            return json_encode(array(
                'status' => 'FAIL',
                'message' => 'Không tìm thấy file VB',
                'data' => null
            ));
        }
    }

    /**
     * Cho phép người dùng download các file văn bản
     *
     * @param $vanban_id
     * @param $file_id
     */
    public function downloadfile() {
				# tao ma va hien thi chinh sach download
				if ( !Input::has('dtoken') || cMCrypter::decrypt(Input::get('dtoken'), cMCrypter::get_session_key()) != 'tckh.ou.edu.vn' ) {
					return View::make('mod.tckh.download_form',array(
						'dtoken' => cMCrypter::encrypt('tckh.ou.edu.vn', cMCrypter::get_session_key())
					));
				}
		
        $baiviet_id = Input::get('idbaiviet');
        $file_id = Input::get('idfile');

        $vanbaninfo = TCKHBaiViet::find($baiviet_id);
        if ( !$vanbaninfo ) {
            return View::make('404');
        }

        $headers_denied_multiconnection = array(
            'Accept-Ranges: none',
        );

        if ( $file_id == '' || intval($file_id) <= 0 ) {
            # download nhieu file
            $vanban_files = UFiles::where('context_id', '=', $baiviet_id)
                ->get();
            if ( $vanban_files && count($vanban_files) > 0 ) {
                foreach ( $vanban_files as $file ) {
                    $file_path = Config::get('tckh.files_dir') . '/' . $file->file_path;
                    if ( file_exists($file_path) ) {
                        // update logs + counter
                        //$this->update_download_counter_n_logs($file);

                        return Response::download($file_path, basename($file_path), $headers_denied_multiconnection);
                    }
                    else {
                        return View::make('404');
                    }
                }
            }
            else {
                # khong tim thay file can download
                return View::make('404');
            }
        }
        else {
            # chi download 1 file
            $vanban_files = UFiles::where('context_id', '=', $baiviet_id)
                ->where('id','=',$file_id)
                ->get();
            if ( $vanban_files && count($vanban_files) == 1 ) {
                $file_path = Config::get('tckh.files_dir') . '/' . $vanban_files->get(0)->file_path;
                if ( file_exists($file_path) ) {
                    //$this->update_download_counter_n_logs($vanban_files->get(0));

                    return Response::download($file_path, basename($file_path), $headers_denied_multiconnection);
                }
                else {
                    return View::make('404');
                }
            }
            else {
                # khong tim thay file can download
                return View::make('404');
            }
        }
    }

    public function admin_xoabaiviet() {
        if ( !$this->userinfo->is_access(array('admin_tckh')) ) {
            return View::make('403')->with('message', 'Không có quyền truy cập !!!');
        }

        $baiviet = TCKHBaiViet::find(Input::get('idbaiviet'));

        if ( TCKHBaiViet::delete_baiviet_n_files($baiviet->id) ) {
            cUtils::set_app_message('Xóa thành công !', cUtils::SUCCESS_MSG);
        }
        else {
            cUtils::set_app_message('Xóa không thành công !!!', cUtils::ERROR_MSG);
        }

        return Redirect::to('tckh/dsbaiviet?idsotapchi='.$baiviet->id_sotapchi);
    }

    //*************** user view ***************/
    /**
     * Lấy danh sách số + tạp chí
     *
     * @return mixed
     */
    public function listtapchi() {
        $arr_sotapchi = DB::table('web_tckh_tapchi')
            ->orderBy('namtapchi', 'desc')
            ->orderBy('sotapchi', 'asc')
            ->get();
        $list_sotapchi = array();
        foreach ( $arr_sotapchi as $sotapchi ) {
            if ( !isset($list_sotapchi[$sotapchi->namtapchi]) ) {
                $list_sotapchi[$sotapchi->namtapchi] = array();
            }

            $list_sotapchi[$sotapchi->namtapchi][] = $sotapchi;
        }

        return View::make('mod.tckh.listtapchi',array(
            'list_sotapchi' => $list_sotapchi
        ));
    }

    /**
     * Xem tất cả bài viết của 1 số tạp chí
     */
    public function xemtapchi() {
        $v = Validator::make(Input::all(), array(
            'idsotapchi' => 'required|numeric'
        ));

        if ($v->fails())
        {
            cUtils::set_app_message('Dữ liệu không hợp lệ !!!', cUtils::ERROR_MSG);
            return View::make('404');
        }

        $sotapchi = TCKHSoTapChi::find(Input::get('idsotapchi'));
        if ( !$sotapchi || count($sotapchi) == 0 ) {
            cUtils::set_app_message('Dữ liệu không hợp lệ !!!', cUtils::ERROR_MSG);
            return View::make('404');
        }

        $ds_baiviet = TCKHBaiViet::where('id_sotapchi', '=', $sotapchi->id)
            ->orderBy('nhombaiviet')
            ->get();
        $list_baiviet = array();
        if ( !$ds_baiviet || count($ds_baiviet) == 0 ) {
            cUtils::set_app_message('Không có bài viết !!!', cUtils::WARNING_MSG);
        }
        else {
            foreach ( $ds_baiviet as $baiviet ) {
                if ( !isset($list_baiviet[$baiviet->nhombaiviet]) ) {
                    $list_baiviet[$baiviet->nhombaiviet] = array();
                }

                $list_baiviet[$baiviet->nhombaiviet][] = $baiviet;
            }
        }

        # lay ds tap chi khac trong cung nam voi so tap chi dang xem
        $list_tapchi_nam = TCKHSoTapChi::where('id', '!=', Input::get('idsotapchi'))
            ->where('namtapchi', '=', $sotapchi->namtapchi)
            ->orderBy('sotapchi')
            ->get();

        return View::make('mod.tckh.xemtapchi', array(
            'sotapchiinfo' => $sotapchi,
            'list_baiviet' => $list_baiviet,
            'list_tapchi_nam' => $list_tapchi_nam
        ));
    }

    public function xembaiviet() {
        $baivietinfo = TCKHBaiViet::find(Input::get('id'));

        if ( $baivietinfo && count($baivietinfo) > 0 ) {
            # lay ds cac bai viet khac
            $list_baiviet_khac = TCKHBaiViet::where('id_sotapchi', '=', $baivietinfo->id_sotapchi)
							->where('id', '!=', $baivietinfo->id)
							->get();
            $sotapchi = TCKHSoTapChi::find($baivietinfo->id_sotapchi);

            $vb_files = UFiles::where('context_id', '=', $baivietinfo->id)->get();

            return View::make('mod.tckh.showbaiviet', array(
                'baivietinfo' => $baivietinfo,
                'vb_files' => $vb_files,
                'sotapchiinfo' => $sotapchi,
                'list_baiviet_khac' => $list_baiviet_khac
            ));
        }
        else {
            return View::make('404');
        }
    }

    public function xembaivietfile() {
        $baiviet_info = TCKHBaiViet::find(Input::get('idbaiviet'));
        if ( $baiviet_info ) {
            $file_info = UFiles::find(Input::get('idfile'));
            if ( $file_info ) {
                if ( strtoupper($file_info->file_ext) == 'PDF' ) {

                    $image_path = $this->get_pdf_2_image_path(Config::get('tckh.files_dir'), $file_info->file_path);

                    $files = scandir($image_path);

                    $data = array();
                    if ( $files && count($files) > 0 ) {
                        foreach ( $files as $file ) {
                            if ( $file == '.' || $file == '..' ) continue;
                            $data[] = array(
                                'filename' => cMCrypter::encrypt($file, cMCrypter::get_session_key())
                            );
                        }

                        return Response::json(array(
                            'status' => 'OK',
                            'file' => basename($file_info->file_path),
                            'data' => $data,
                            'message' => ''
                        ));
                    }
                    else {
                        return Response::json(array(
                            'status' => 'FILE_NOT_FOUND',
                            'file' => '',
                            'data' => null,
                            'message' => 'Không tìm thấy file văn bản !!!'
                        ));
                    }
                }
                else {
                    // ko phai file PDF -> cho download
                    return $this->common_downloadfile(Input::get('idbaiviet'), Input::get('idfile'));
                }
            }
            else {
                return Response::json(array(
                    'status' => 'FILE_NOT_FOUND',
                    'file' => '',
                    'data' => null,
                    'message' => 'Không tìm thấy thông file văn bản !!!'
                ));
            }
        }
        else {
            return Response::json(array(
                'status' => 'VANBAN_NOT_FOUND',
                'file' => '',
                'data' => null,
                'message' => 'Không tìm thấy thông tin văn bản !!!'
            ));
        }
    }

    public function getfilecontent() {
        $file_info = UFiles::find(Input::get('idfile'));
        if ( $file_info ) {
            $image_path = $this->get_pdf_2_image_path(Config::get('tckh.files_dir'), $file_info->file_path);

            include(app_path().'/libs/images.class.php');
            $image = new SimpleImage();
            $filename = cMCrypter::decrypt(Input::get('filename'), cMCrypter::get_session_key());
            $image->load($image_path . '/' . $filename);

            header("Content-type: ".$image->image_info['mime']);
            $image->output();
        }
        else {
            return 'FILE_NOT_FOUND';
        }
    }

    /**
     * Lấy Path đến thư mục chứa ảnh các trang extract từ file pdf
     *
     * @param $upload_dir
     * @param $filename
     *
     * @return string
     */
    private function get_pdf_2_image_path($upload_dir, $filename) {
        $path = cUtils::split_filepath($filename);
        $basename = $path['base_filename'];

        return $upload_dir . '/' . $path['rel_path'] . '/' . str_replace('.','_',$basename);
    }

    public function search() {
        $kw = Input::get('kw');
        # set paging params
        Paginator::setPageName('searchpage');

        $query = DB::table('web_tckh_baiviet')
            ->join('web_tckh_tapchi', 'web_tckh_baiviet.id_sotapchi', '=', 'web_tckh_tapchi.id');
        if ( $kw != '' ) {
            $query = $query->where('web_tckh_baiviet.nhombaiviet', 'like', '%'.$kw.'%')
                ->orWhere('web_tckh_baiviet.tenbaiviet', 'like', '%'.$kw.'%')
                ->orWhere('web_tckh_baiviet.gioithieubaiviet', 'like', '%'.$kw.'%')
                ->orWhere('web_tckh_baiviet.tacgia', 'like', '%'.$kw.'%')
                ->orWhere('web_tckh_tapchi.tentapchi', 'like', '%'.$kw.'%')
                ->orWhere('web_tckh_tapchi.sotapchi', 'like', '%'.$kw.'%')
                ->orWhere('web_tckh_tapchi.namtapchi', 'like', '%'.$kw.'%');
        }
        $query = $query->select('web_tckh_baiviet.*', 'web_tckh_tapchi.sotapchi', 'web_tckh_tapchi.namtapchi')
            ->orderBy('web_tckh_tapchi.namtapchi', 'desc')
            ->orderBy('web_tckh_tapchi.sotapchi', 'desc')
            ->paginate(Config::get('tapchikhoahoc.search_paging_size'));

        return View::make('mod.tckh.searchresult', array(
            'search_result' => $query
        ));
    }


    /**
     * User viết bài viết TCKH mới
     * @return mixed
     */
    public function user_dangtckh() {

        // Kiểm tra permissions
        if ( !$this->userinfo->is_access(array('viet_bai_tckh')) ) {
            return View::make('403')->with('message', 'Không có quyền truy cập !!!');
        }

        $list_nhombaiviet = TCKHNhomBaiViet::orderBy('tennhombaiviet')->get();
        if(Input::get('do_save')) {

            // Validate user input
            $validate = $this->validateTCKH();
            if(!$validate) {
                return Redirect::to('tckh/dangtckh')
                    ->withErrors($validate);
            }

            $tenBaiViet = Input::get('txtTenBaiViet');

            $isExist = TCKHBaiViet::isKeyExist('tenbaiviet', $tenBaiViet);
            if($isExist) {
                Session::flash('message', 'Tên bài viết đã tồn tại');
                return Redirect::to('tckh/dangtckh');
            }

            // Tạo bài viết mới
            $baiviet = new TCKHBaiViet();
            $baiviet->nhombaiviet = Input::get('txtNhomBaiViet');
            $baiviet->tenbaiviet = $tenBaiViet;
            $baiviet->gioithieubaiviet = Input::get('txtGioiThieu');
            $baiviet->noidung = Input::get('txtNoiDung');
            $baiviet->usernhap = $this->userinfo->id;

            // Json_endcode mảng tên các tác giả và lưu về DB
            $tacgia = Input::get('txtTacGia');
            $list_tacgia = array();
            if ( $tacgia && count($tacgia) > 0 ) {
                $list_tacgia = array();
                foreach ( $tacgia as $tg ) array_push($list_tacgia, $tg);
            }

            $baiviet->tacgia = json_encode($list_tacgia, JSON_UNESCAPED_UNICODE);
            $baiviet->trangthai = TCKH_STATUS_NEW;

            // Lưu bị lỗi
            if (!$baiviet->save()) {
                cUtils::set_app_message('Đăng bài tạp chí khoa học bị lỗi !', cUtils::ERROR_MSG);
                return Redirect::to('tckh/dangtckh');
            }

            // Lưu thành công
            cUtils::set_app_message_refresh_all_page('Đăng bài thành công. Vui lòng đợi hội đồng phản biện !', cUtils::SUCCESS_MSG,
                '');

        }
        return View::make('mod.tckh.taobaiviet', array(
            'list_nhombaiviet' => $list_nhombaiviet
        ));
    }

    /**
     * User sửa bài viết TCKH
     */
    public function user_suatckh($idbaiviet) {


        // Kiểm tra permissions
        if ( !$this->userinfo->is_access(array('viet_bai_tckh')) ) {
            return View::make('403')->with('message', 'Không có quyền truy cập !!!');
        }

        $list_nhombaiviet = TCKHNhomBaiViet::orderBy('tennhombaiviet')->get();

        if($idbaiviet == null) {
            Session::flash('message', 'Lỗi xử lý');
            return Redirect::to('/');
        }
        $baivietinfo = TCKHBaiViet::find($idbaiviet);

        if (!$baivietinfo) {
            Session::flash('message', 'Không thấy bài viết yêu cầu');
            return Redirect::to('/');
        }

        $canEdit = TCKHBaiViet::userCanEdit($baivietinfo);
        if (!$canEdit)  {
            cUtils::set_app_message_refresh_all_page('Bài viết đang được hội đồng phản biện chấm, không thể sửa!', cUtils::SUCCESS_MSG,
                '');
        }

        if (Input::get('do_save')) {

            // validate
            $validate = $this->validateTCKH();

            if( $validate->fails()) {
                return Redirect::to('tckh/suatckh')
                    ->withErrors($validate);
            }


            $baivietinfo->nhombaiviet = Input::get('txtNhomBaiViet');
            $baivietinfo->tenbaiviet = Input::get('txtTenBaiViet');
            $baivietinfo->gioithieubaiviet = Input::get('txtGioiThieu');
            $baivietinfo->noidung = Input::get('txtNoiDung');

            // Lưu bị lỗi
            if (!$baivietinfo->save()) {
                cUtils::set_app_message('Sửa bài tạp chí khoa học bị lỗi !', cUtils::ERROR_MSG);
                return Redirect::to('tckh/dangtckh');
            }

            // Lưu thành công
            cUtils::set_app_message_refresh_all_page('Sửa bài thành công. Vui lòng đợi hội đồng phản biện !', cUtils::SUCCESS_MSG,
                '');

        }

        return View::make('mod.tckh.taobaiviet', array(
            'baivietinfo' => $baivietinfo,
            'list_nhombaiviet' => $list_nhombaiviet
        ));



    }


    /**
     * Validate
     */
    private function validateTCKH() {

        $messages = [
            'required' => 'Trường :attribute không được để trống.',
        ];

        //validate
        $rules = array(
            'txtTenBaiViet'                 => 'required'
        );
        $validator = Validator::make(Input::all(), $rules, $messages);

        return $validator;
    }
}

<?php

class FilesController extends \BaseController {
    /**
    * Instantiate a new UserController instance.
    */
    public function __construct() {
        parent::__construct();
        # require logined for this controller
        $this->beforeFilter('auth');
    }

    public static function init_route() {
    }

    /**
     * Menu dành cho người quản lý
     *
     * @return string
     */
    public static function admin_menu()
    {
        return '';
    }

    public function index() {
    }

    public static function upload_form($list_exists_files,
                                       $upload_proccess_url,
                                       $upload_file_ext_allow = array(),
                                       $delete_file_from_server_jsfn = '',
                                       $download_file_from_server_jsfn = '',
                                       $max_upload_filesize = 50,   /* 50MB */
                                       $chunk_size = 1 /* chia file thanh tung part, moi part = 1MB*/
                                        ) {
        return View::make('admin/ufiles/upload_form',array(
            'list_exists_files' => $list_exists_files,
            'upload_proccess_url' => $upload_proccess_url,
            'upload_file_ext_allow' => $upload_file_ext_allow,
            'delete_file_from_server_jsfn' => $delete_file_from_server_jsfn,
            'download_file_from_server_jsfn' => $download_file_from_server_jsfn,
            'max_upload_filesize' => $max_upload_filesize,
            'chunk_size' => $chunk_size
        ));
    }
}

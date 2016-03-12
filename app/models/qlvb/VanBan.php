<?php
class VanBan extends Eloquent {
	protected $table = 'web_qlvb_vanban';
	protected $primaryKey = 'id';

	public $timestamps = false;
	
	public static function selectall($loaivb_id = '') {

        $list = DB::table('web_qlvb_vanban')
            ->leftJoin('web_qlvb_loaivanban', 'web_qlvb_vanban.loaivb_id', '=', 'web_qlvb_loaivanban.id')
            ->leftJoin('web_qlvb_lanhvuc', 'web_qlvb_vanban.lanhvuc_id', '=', 'web_qlvb_lanhvuc.id');

        if ( $loaivb_id != '' ) {
            $list_loaivb = LoaiVB::get_loaivb($loaivb_id);

            if ( $list_loaivb && count($list_loaivb) > 0 ) {
                $list = $list->whereIn('web_qlvb_vanban.loaivb_id', $list_loaivb);
            }
        }

        $list = $list->select('web_qlvb_vanban.*', 'web_qlvb_loaivanban.tenloaivb', 'web_qlvb_lanhvuc.tenlanhvuc');
        return $list;
	}

    public static function get_lastest_items($num_items) {
        $tablename = with(new VanBan())->getTable();
        return DB::table($tablename)
            ->orderBy('update_at', 'desc')
            ->take($num_items)
            ->get();
    }

    /*
     * Lấy văn bản mới nhất trong loại VB
     */
    public static function get_lastest_items_loaivb($loaivb_id, $num_items) {
        $tablename = with(new VanBan())->getTable();
        $list_loaivb_id = LoaiVB::get_loaivb($loaivb_id);

        return DB::table($tablename)
            ->whereIn('loaivb_id', $list_loaivb_id)
            ->orderBy('update_at', 'desc')
            ->take($num_items)
            ->get();
    }

    public static function delete_vanban_n_files($vanban_id) {
        $vanbaninfo = VanBan::find($vanban_id);
        if ( $vanbaninfo && $vanbaninfo->delete() ) {
            $filevb_dir = Config::get('qlvb.files_dir');
            $files = UFiles::where('context_id', '=', $vanbaninfo->id)->get();
            if ($files) {
                foreach ($files as $f) {
                    $file_path = $filevb_dir . '/' . $f->file_path;
                    $f->delete();

                    // xoa file vat ly
                    if (file_exists($file_path)) {
                        @unlink($file_path);
                    }
                    $dir_path = $filevb_dir . '/' . str_replace('.', '_', $f->file_path);
                    if (file_exists($dir_path)) {
                        cUtils::rm_dir($dir_path);
                    }
                }

                // xoa logs
                DB::delete('delete from ['.with(new ViewVBCounter())->getTable().'] where [vanban_id]='.$vanbaninfo->id);
                DB::delete('delete from ['.with(new ViewVBLogs())->getTable().'] where [vanban_id]='.$vanbaninfo->id);
                #DB::delete('delete from ['.with(new ViewVBLogs())->getTable().'] where [vanban_id]='.$vanbaninfo->id);
            }
            return true;
        }
        else {
            return false;
        }
    }
}
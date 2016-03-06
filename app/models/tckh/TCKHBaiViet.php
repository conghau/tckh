<?php

class TCKHBaiViet extends Eloquent {
	protected $table = 'web_tckh_baiviet';
	protected $primaryKey = 'id';

	public $timestamps = false;

    public static function delete_baiviet_n_files($idbaiviet) {
        $vanbaninfo = TCKHBaiViet::find($idbaiviet);
        if ( $vanbaninfo && $vanbaninfo->delete() ) {
            $filevb_dir = Config::get('tckh.files_dir');
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
                #DB::delete('delete from ['.with(new ViewVBCounter())->getTable().'] where [vanban_id]='.$vanbaninfo->id);
                #DB::delete('delete from ['.with(new ViewVBLogs())->getTable().'] where [vanban_id]='.$vanbaninfo->id);
                #DB::delete('delete from ['.with(new ViewVBLogs())->getTable().'] where [vanban_id]='.$vanbaninfo->id);
            }
            return true;
        }
        else {
            return false;
        }
    }
}
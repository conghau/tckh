<?php

class UFiles extends Eloquent {
	protected $table = 'web_uploaded_files';
	protected $primaryKey = 'id';

	public $timestamps = true;

    /**
     * @param $file_id
     * @param $upload_dir
     *
     * @return $file nếu thành công, null nếu không thành công
     */
    public static function delete_file($file_id, $upload_dir) {
        $file = UFiles::find($file_id);
        if ( $file ) {
            if( $file->delete() ) {
                # xoa cac file lien quan (file vat ly)
                $file_goc = $upload_dir . '/' . $file->file_path;
                if ( file_exists($file_goc) ) {
                    @unlink($file_goc);

                    # xoa cac file anh neu co
                    $image_dir = str_replace('.','_',$file_goc);
                    if ( file_exists($image_dir) ) {
                        cUtils::rm_dir($image_dir);
                    }
                }
                return $file;
            }
            else {
                return null;
            }
        }
        else {
            return null;
        }
    }
    /**
     * Upload file va luu thong tin vao db
     *
     * @param $save_dir :   Thư mục lưu file upload
     * @param $context_id   :   id liên quan đến file
     */
    public static function doupload_file($save_dir, $context_id, $context_name) {
        // HTTP headers for no cache etc
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");

        // Settings
        $targetDir_root = $save_dir;
        $targetDir = $targetDir_root . DIRECTORY_SEPARATOR . date('dmY', time());

        $cleanupTargetDir = true; // Remove old files
        $maxFileAge = 5 * 3600; // Temp file age in seconds

        // 5 minutes execution time
        @set_time_limit(5 * 60);

        // Uncomment this one to fake upload time
        // usleep(5000);

        // Get parameters
        $chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
        $chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 0;
        $fileName = isset($_REQUEST["name"]) ? $_REQUEST["name"] : '';

        // Clean the fileName for security reasons
        //$fileName = preg_replace('/[^\w\._]+/', '_', $fileName);
        $fileName = preg_replace("/[^a-zA-Z0-9\._-]/", "-", $fileName);
        //$fileName = cUtils::str_normalize($fileName);

        // Make sure the fileName is unique but only if chunking is disabled
        if ($chunks < 2 && file_exists($targetDir . DIRECTORY_SEPARATOR . $fileName)) {
            $ext = strrpos($fileName, '.');
            $fileName_a = substr($fileName, 0, $ext);
            $fileName_b = substr($fileName, $ext);

            $count = 1;
            while (file_exists($targetDir . DIRECTORY_SEPARATOR . $fileName_a . '_' . $count . $fileName_b))
                $count++;

            $fileName = $fileName_a . '_' . $count . $fileName_b;
        }

        $filePath = $targetDir . DIRECTORY_SEPARATOR . $fileName;

        // Create target dir
        if (!file_exists($targetDir))
            @mkdir($targetDir, 777, true);

        // Remove old temp files
        if ($cleanupTargetDir && is_dir($targetDir) && ($dir = opendir($targetDir))) {
            while (($file = readdir($dir)) !== false) {
                $tmpfilePath = $targetDir . DIRECTORY_SEPARATOR . $file;

                // Remove temp file if it is older than the max age and is not the current file
                if (preg_match('/\.part$/', $file) && (filemtime($tmpfilePath) < time() - $maxFileAge) && ($tmpfilePath != "{$filePath}.part")) {
                    @unlink($tmpfilePath);
                }
            }

            closedir($dir);
        } else
            return '{"jsonrpc" : "2.0", "error" : {"code": 100, "message": "Failed to open temp directory."}}';


        // Look for the content type header
        if (isset($_SERVER["HTTP_CONTENT_TYPE"]))
            $contentType = $_SERVER["HTTP_CONTENT_TYPE"];

        if (isset($_SERVER["CONTENT_TYPE"]))
            $contentType = $_SERVER["CONTENT_TYPE"];

        // Handle non multipart uploads older WebKit versions didn't support multipart in HTML5
        if (strpos($contentType, "multipart") !== false) {
            if (isset($_FILES['file']['tmp_name']) && is_uploaded_file($_FILES['file']['tmp_name'])) {
                // Open temp file
                $out = fopen("{$filePath}.part", $chunk == 0 ? "wb" : "ab");
                if ($out) {
                    // Read binary input stream and append it to temp file
                    $in = fopen($_FILES['file']['tmp_name'], "rb");

                    if ($in) {
                        while ($buff = fread($in, 4096))
                            fwrite($out, $buff);
                    } else
                        return '{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}}';
                    fclose($in);
                    fclose($out);
                    @unlink($_FILES['file']['tmp_name']);
                } else
                    return '{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}}';
            } else
                return '{"jsonrpc" : "2.0", "error" : {"code": 103, "message": "Failed to move uploaded file."}}';
        } else {
            // Open temp file
            $out = fopen("{$filePath}.part", $chunk == 0 ? "wb" : "ab");
            if ($out) {
                // Read binary input stream and append it to temp file
                $in = fopen("php://input", "rb");

                if ($in) {
                    while ($buff = fread($in, 4096))
                        fwrite($out, $buff);
                } else
                    return '{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}}';

                fclose($in);
                fclose($out);
            } else
                return '{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}}';
        }

        // Check if file has been uploaded
        $file_id = -1;
        $fpath = '';
        $tempname = '';
        $complete_info = null;
        $storageFile_id = -1;
        if (!$chunks || $chunk == $chunks - 1) {
            $file_info = pathinfo($filePath);
            $base_fn = $file_info['basename'];
            $fext = $file_info['extension'];
            $tempname = md5($filePath);

            $oldFilePath = $filePath;
            $newFilePath = $filePath;
            /* doi ten file neu trung */
            while ( file_exists($newFilePath) ) {
                $newFilePath = $targetDir . DIRECTORY_SEPARATOR . str_replace('.','_',$base_fn) . time() . '.' . $fext;
            }
            // Strip the temp .part suffix off
            rename("{$oldFilePath}.part", $newFilePath);
            $file_info = pathinfo($newFilePath);
            $base_fn = $file_info['basename'];
            $fext = $file_info['extension'];
            $tempname = md5($filePath);

            # luu tamp vao db
            $storageFile = new UFiles();
            $storageFile->context_id = $context_id;
            $storageFile->context_name = $context_name;
            $storageFile->file_path = trim(str_replace($targetDir_root . DIRECTORY_SEPARATOR, '', $newFilePath));
            $storageFile->file_ext = $fext;
            $storageFile->file_size = filesize($newFilePath);
            $storageFile->tmp = 0;
            $storageFile->deleted = 0;
            $storageFile->userupload = unserialize(Session::get('userinfo'))->id;
            if ( $storageFile->save() ) {
                $storageFile_id = $storageFile->id;

                $complete_info = array(
                    'file_id' => $storageFile_id,
                    'basename' => $base_fn
                );
            }
            else {
                $complete_info = array(
                    'file_id' => 0,
                    'basename' => '',
                    'message' => 'Lỗi khi lưu thông tin file vào DB'
                );
            }
        }

        // Return JSON-RPC response
        //die('{"jsonrpc" : "2.0", "result" : '.json_encode($complete_info).', "error" : {"code": 0, "message": ""}}');
        return '{"jsonrpc" : "2.0", "result" : '.json_encode($complete_info).', "error" : {"code": 0, "message": ""}}';
    }
}
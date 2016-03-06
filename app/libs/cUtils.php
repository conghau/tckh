<?php

class cUtils {

    const ALL_MSG = '';
    const INFO_MSG = 'info';
    const SUCCESS_MSG = 'success';
    const ERROR_MSG = 'error';
    const WARNING_MSG = 'warning';

    public static function set_app_message($message, $message_type = cUtils::INFO_MSG) {
        if ( $message_type == cUtils::INFO_MSG ) {
            $old_msg = Session::get('info_message');
            if ( !$old_msg || $old_msg == '' ) $old_msg = $message;
            else $old_msg .= '<hr />' . $message;

            Session::put('info_message', $old_msg);
        }
        else if ( $message_type == cUtils::SUCCESS_MSG ) {
            $old_msg = Session::get('success_message');
            if ( !$old_msg || $old_msg == '' ) $old_msg = $message;
            else $old_msg .= '<hr />' . $message;

            Session::put('success_message', $old_msg);
        }
        else if ( $message_type == cUtils::ERROR_MSG ) {
            $old_msg = Session::get('error_message');
            if ( !$old_msg || $old_msg == '' ) $old_msg = $message;
            else $old_msg .= '<hr />' . $message;

            Session::put('error_message', $old_msg);
        }
        else if ( $message_type == cUtils::WARNING_MSG ) {
            $old_msg = Session::get('warning_message');
            if ( !$old_msg || $old_msg == '' ) $old_msg = $message;
            else $old_msg .= '<hr />' . $message;

            Session::put('warning_message', $old_msg);
        }
    }

    public static function clear_app_message($message_type = cUtils::ALL_MSG)
    {
        if ( $message_type == cUtils::ALL_MSG ) {
            Session::forget('info_message');
            Session::forget('success_message');
            Session::forget('error_message');
            Session::forget('warning_message');
        }
        else if ( $message_type == cUtils::INFO_MSG ) {
            Session::forget('info_message');
        }
        else if ( $message_type == cUtils::SUCCESS_MSG ) {
            Session::forget('success_message');
        }
        else if ( $message_type == cUtils::ERROR_MSG ) {
            Session::forget('error_message');
        }
        else if ( $message_type == cUtils::WARNING_MSG ) {
            Session::forget('warning_message');
        }
    }

    public static function dirToArray($dirPath, $ignoreDir = array()) {
        $arr_dirs = array();

        // open the specified directory and check if it's opened successfully
        if ($handle = opendir($dirPath)) {
            # keep reading the directory entries 'til the end
            while (false !== ($file = readdir($handle))) {
                // just skip the reference to current and parent directory
                $dir = strtoupper($file);
                if ($file != "." && $file != ".." && $dir != 'ROOT' && $dir != 'ROOTS' && $dir != 'PRG') {
                    if (is_dir("$dirPath/$file")) {
                        if ( in_array($file, $ignoreDir) ) { }
                        else {
                            // found a directory, do something with it?
                            $arr_dirs[$file] = array(
                                'name' => $file,
                                'path' => "$dirPath/$file"
                            );
                        }
                    }
                    else { }
                }
            }
            // ALWAYS remember to close what you opened
            closedir($handle);
        }

        return $arr_dirs;
    }

    public static function utf8_to_ascii($str, $to_upper_case=false) {
        $chars = array(
            'a'    =>    array('ấ','ầ','ẩ','ẫ','ậ','Ấ','Ầ','Ẩ','Ẫ','Ậ','ắ','ằ','ẳ','ẵ','ặ','Ắ','Ằ','Ẳ','Ẵ','Ặ','á','à','ả','ã','ạ','â','ă','Á','À','Ả','Ã','Ạ','Â','Ă'),
            'e'    =>    array('ế','ề','ể','ễ','ệ','Ế','Ề','Ể','Ễ','Ệ','é','è','ẻ','ẽ','ẹ','ê','É','È','Ẻ','Ẽ','Ẹ','Ê'),
            'i'    =>    array('í','ì','ỉ','ĩ','ị','Í','Ì','Ỉ','Ĩ','Ị'),
            'o'    =>    array('ố','ồ','ổ','ỗ','ộ','Ố','Ồ','Ổ','Ô','Ộ','ớ','ờ','ở','ỡ','ợ','Ớ','Ờ','Ở','Ỡ','Ợ','ó','ò','ỏ','õ','ọ','ô','ơ','Ó','Ò','Ỏ','Õ','Ọ','Ô','Ơ'),
            'u'    =>    array('ứ','ừ','ử','ữ','ự','Ứ','Ừ','Ử','Ữ','Ự','ú','ù','ủ','ũ','ụ','ư','Ú','Ù','Ủ','Ũ','Ụ','Ư'),
            'y'    =>    array('ý','ỳ','ỷ','ỹ','ỵ','Ý','Ỳ','Ỷ','Ỹ','Ỵ'),
            'd'    =>    array('đ','Đ')
        );
        foreach ($chars as $key => $arr)
            foreach ($arr as $val)
                $str = str_replace($val,$key,$str);
        if ( $to_upper_case )
            return strtoupper($str);
        else
            return $str;
    }

    /**
     * Lọc bỏ dấu và khoảng trắng trong chuỗi
     *
     * @param <string> $str : chuỗi cần lọc bỏ dấu
     * @param <string> $white_space_replace : chuỗi thay thế cho chuỗi [space] trong chuỗi
     * @param <bool> $to_upper_case : chuỗi return sẽ được chuyển sang chữ hoa
     * @param <bool> $safe_for_url : =true nếu muốn thay thế các ký tự không nên có trong url +/=
     *
     * @return <string> chuỗi sau khi lọc bỏ dấu và thay thế ký tự cần thiết
     */
    public static function str_normalize($str, $white_space_replace='', $to_upper_case=false, $safe_for_url=true) {
        $t = cUtils::utf8_to_ascii($str, $to_upper_case);
        $t = trim(preg_replace('/\s+/', ' ', $t));
        if ( !empty($white_space_replace) && $white_space_replace != ' ' ) {
            $t = strtr($t, ' ', $white_space_replace);
        }

        if ( $safe_for_url ) $t = strtr($t, '+/=', '---');

        if ( !$to_upper_case  )
            return strtolower($t);

        return $t;
    }

    /**
     * Tách đường dẫn file thành mảng thông tin [dir] và [filename]
     *
     * @param <string> $file_path : đường dẫn đến file
     *
     * @return <array> [rel_path]=đường dẫn đến file, [base_filename]=tên file
     */
    public static function split_filepath($file_path) {
        $fp = str_replace('\\', '/', $file_path);
        $lp = strrpos($fp, '/');

        return array(
            'rel_path' => substr($fp, 0, $lp),
            'base_filename' => substr($fp, $lp+1)
        );
    }

    public static function rm_dir($dir) {
        $files = array_diff(scandir($dir), array('.','..'));
        foreach ($files as $file) {
            (is_dir("$dir/$file")) ? @rm_dir("$dir/$file") : @unlink("$dir/$file");
        }
        return @rmdir($dir);
    }

    /**
     * Chuyển đổi chuỗi ngày dạng yyyymmdd sang dạng dd/mm/yyyy
     *
     * @param <string> $dt : chuỗi ngày cần chuyển
     *
     * @return <string> kết quả chuyển
     */
    public static function convert_date_string_ymd_2_dmy($dt)
    {
        $temp = substr($dt,8,2) . "/" . substr($dt,5,2) . "/" . substr($dt,0,4);
        if ( $temp == "01/01/1970" )
                return "-";
        else
                return $temp;
    }

    protected static function _replace_tcvn(&$val, $arr) {
        while ( list($k,$v) = each($arr) ) {
                if ( $k == $val ) {
                        $val = $v;
                        return;
                }
        }
    }

    public static function to_unicode($str, $font_arr = NULL) {
        global $edunet_api_arr_unicode;
        if ( $font_arr != NULL ) $edunet_api_arr_unicode = $font_arr;

        $tmp = '';
        $sz = strlen($str);
        for ( $i=0; $i<$sz; $i++ ) {
                $chr = substr($str,$i,1);
                if ( $chr == ' ' ) {  $tmp .= ' '; continue; }
                cUtils::_replace_tcvn($chr, $edunet_api_arr_unicode);

                $tmp .= $chr;
        }
        return $tmp;
    }

    /**
     * Hiển thị kiểu Date
     *
     * @param $date
     * @param $format
     */
    public static function echo_sqlsrv_date($date, $format = '') {
        if ( strlen($date) < 10 ) return '';
        $tmp = substr($date, 0, 10);
        $tmp = explode('-', $tmp);
        if ( count($tmp) != 3 ) return '';
        return $tmp[2].'/'.$tmp[1].'/'.$tmp[0];
    }

    public static function echo_date($format, $timestamp) {
        if ( !$timestamp || $timestamp == null || $timestamp <= 0 ) return '';
        $tmp = date($format, $timestamp);

        if ( !$tmp || $tmp == null ) return '';
        if ( str_replace('/', '', $tmp) == '01011970' ) return '';
        else return $tmp;
    }

    public static function base64_encode_safe($input) {
        return strtr(base64_encode($input), '+/=', '-_,');
    }

    public static function base64_decode_safe($input) {
        return base64_decode(strtr($input, '-_,', '+/-'));
    }

    public  static function apply_filter_from_base64($larevel_query, $filterdata_base64)
    {
        $filterdata = cUtils::base64_decode_safe(Input::get('filterdata'));
        $filterdata = json_decode($filterdata);
        if ( $filterdata && count($filterdata) > 0 ) {
            foreach ( $filterdata as $filter ) {
                if ( empty($filter->value) || $filter->value == "" ) { }
                else {
                    // co gia tri filter
                    $fieldname = substr($filter->name,3);
                    if ( $filter->op == 'LIKE' ) {
                        $larevel_query = $larevel_query->where($fieldname, 'LIKE', '%'.$filter->value.'%');
                    }
                    else if ( $filter->op == 'BEGIN' ) {
                        $larevel_query = $larevel_query->where($fieldname, 'LIKE', '%'.$filter->value);
                    }
                    else {
                        $larevel_query = $larevel_query->where($fieldname, $filter->op, $filter->value);
                    }
                }
            }
        }

        return $larevel_query;
    }

    public static  function viet_hoa_dau_cau($input) {
        return strtoupper(substr($input,0,1)).substr($input,1);
    }

    public static function viet_hoa_dau_tu($input) {
        $tmp = explode(' ', $input);
        $new_str = '';
        foreach ( $tmp as $str ) {
            if ( $new_str == '' ) $new_str = cUtils::viet_hoa_dau_cau($str);
            else $new_str .= ' ' . cUtils::viet_hoa_dau_cau($input);
        }
        return $new_str;
    }

    /*
     * Dùng để set app message và refresh cho popup su dung iframe
     * */
    public static function set_app_message_refresh_all_page($message, $message_type, $url_refresh) {
        cUtils::set_app_message($message.
            '<script type="text/javascript">top.location="'.url($url_refresh).'";parent.location="'.
            url($url_refresh).'";</script>', $message_type);
    }

    public static function format_filesize($filesize)
    {
        $filesize_kb = $filesize * .0009765625; // bytes to KB
        $filesize_mb = ($filesize * .0009765625) * .0009765625; // bytes to MB
        //$filesize_gb = (($filesize * .0009765625) * .0009765625) * .0009765625; // bytes to GB

        if ( $filesize_mb < 1 ) {
            return round($filesize_kb, 2).' KB';
        }
        else return round($filesize_mb, 2).' MB';
    }

    public static function guid(){
        if (function_exists('com_create_guid')){
            return com_create_guid();
        } else{
            mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
            $charid = strtoupper(md5(uniqid(rand(), true)));
            $hyphen = chr(45);// "-"
            $uuid = chr(123)// "{"
                .substr($charid, 0, 8).$hyphen
                .substr($charid, 8, 4).$hyphen
                .substr($charid,12, 4).$hyphen
                .substr($charid,16, 4).$hyphen
                .substr($charid,20,12)
                .chr(125);// "}"
            return $uuid;
        }
    }

    public static function format_number_vn($num, $decimal = 0)
    {
        return number_format($num, $decimal, ',', '.');
    }

    /**
     * Chuyển đổi ngày từ định dạng YYYY-MM-DD sang DD-MM-YYYY
     *
     * @param $mssql_date_string
     *
     * @return object (day,month,year,hour,min,sec)
     */
    public static function split_mssql_ymd_2_dmy($mssql_date_string, $to_string_char = '') {
        if ( $mssql_date_string == '' ) return '';

        $result = new stdClass();

        $tmp = explode(' ', $mssql_date_string);
        if ( !$tmp || count($tmp) == 0 ) return '';
        // [0]=date
        // [1]=time
        $result->year = substr($tmp[0], 0, 4);
        $result->month = substr($tmp[0], 5, 2);
        $result->day = substr($tmp[0], 8, 2);

        $result->hour = 0;
        $result->min = 0;
        $result->sec = 0;
        if ( count($tmp) == 2 ) {
            $times = explode(':', $tmp[1]);

            $result->hour = $times[0];
            $result->min = $times[1];
            $result->sec = $times[2];
        }

        if ( $to_string_char == '' ) {
            $result->month = str_pad($result->month,2-strlen($result->month),'0',STR_PAD_LEFT);
            $result->day = str_pad($result->day,2-strlen($result->day),'0',STR_PAD_LEFT);

            $result->hour = str_pad($result->hour,2-strlen($result->hour),'0',STR_PAD_LEFT);
            $result->min = str_pad($result->min,2-strlen($result->min),'0',STR_PAD_LEFT);
            $result->sec = str_pad($result->hour,2-strlen($result->sec),'0',STR_PAD_LEFT);

            return $result;
        }
        else {
            $string = $result->day . $to_string_char .
                $result->month . $to_string_char .
                $result->year;
            if ( $result->hour == 0 && $result->min == 0 && $result->sec == 0 ) {

            }
            else {
                $string .= ' ' . $result->hour . ':' . $result->min . ':' . $result->sec;
            }

            return $string;
        }
    }

    /**
     * Chuyển đổi từ ngày định dạng dd/mm/YYYY (dd/mm/YYYY H:i:s) sang unixtime
     *
     * @param $string_date_dmy
     */
    public static function convert_dmy_2_unixtime($string_date_dmy) {
        if ( $string_date_dmy == '' ) return time();

        $tmp = explode(' ', $string_date_dmy);
        if ( !$tmp || count($tmp) == 0 ) return time();

        if ( count($tmp) == 1 ) {
            $date = explode('/', $tmp[0]);
            // chi co dd/mm/YYYY
            return mktime(0,0,0,$date[1],$date[0],$date[2]);
        }
        else if ( count($tmp) == 2 ) {
            $date = explode('/', $tmp[0]);
            // co dd/mm/YYYY va H:i:s
            $times = explode(':', $tmp[1]);
            if ( !$times || count($times) == 0 ) {
                return mktime(0,0,0,$date[1],$date[0],$date[2]);
            }
            else {
                return mktime(intval(@$times[0]),intval(@$times[1]),intval(@$times[2]),$date[1],$date[0],$date[2]);
            }
        }
    }

    public static function get_client_ip_server() {
        global $_SERVER;

        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
						
				# get ip from session with tracker js
				$tmp = explode(';', $_SERVER['HTTP_COOKIE']);
				foreach ( $tmp as $s ) {
					$ck = explode('=', $s);
					if ( $ck && count($ck) == 2 ) {
						if ( trim($ck[0]) == 'ouhtttnbtrk' ) {
							$ipaddress .= ' # TRACKERJS=' . urldecode( $ck[1] );
						}
					}
				}

        return $ipaddress;
    }

    /**
     * Lấy STT bắt đầu của page (paging - laravel)
     *
     * @param $list_items
     *
     * @return int
     */
    public static function get_stt_of_pager($list_items) {
        $pageno = Input::get('page');
        if ( !$pageno || intval($pageno) == 0 ) $pageno = 1;

        return ($pageno-1) * $list_items->getPerPage() + 1;
    }

    public static function append_to_url($current_url, $params = array()) {
        if (stripos($current_url, '?') === false) {
            # ko co dau ? trong url
            $i = 0;
            foreach ( $params as $k => $v ) {
                if ( $v != '' ) {
                    if ($i == 0) $current_url .= '?' . $k . '=' . $v;
                    else $current_url .= '&' . $k . '=' . $v;

                    $i++;
                }
            }
        }
        else {
            foreach ( $params as $k => $v ) {
                if ( $v != '' ) {
                    $current_url .= '&' . $k . '=' . $v;
                }
            }
        }

        return $current_url;
    }

    public static function convert_newline_br($text) {
        if ( $text == '' ) return '';

        $text = str_replace("\n", '<br />', $text);

        return $text;
    }

    public static function convert_br_newline($text) {
        if ( $text == '' ) return '';

        $text = str_replace("<br />", "\n", $text);
        $text = str_replace("<br>", "\n", $text);

        return $text;
    }

    public static function callControllerMethod($controller, $action, $parameters = array())
    {
        $app = app();
        $controller = $app->make($controller);
        return $controller->callAction($app, $app['router'], $action, $parameters);
    }
}
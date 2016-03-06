<?php
    # message cua he thong
    if ( Session::has('info_message') ) {
        print '<div>&nbsp;</div><div class="alert alert-info">'.Session::get('info_message').'</div>';
        Session::forget('info_message');
    }
    if ( Session::has('success_message') ) {
        print '<div>&nbsp;</div><div class="alert alert-success">'.Session::get('success_message').'</div>';
        Session::forget('success_message');
    }
    if ( Session::has('error_message') ) {
        print '<div>&nbsp;</div><div class="alert alert-danger">'.Session::get('error_message').'</div>';
        Session::forget('error_message');
    }
    if ( Session::has('warning_message') ) {
        print '<div>&nbsp;</div><div class="alert alert-warning">'.Session::get('warning_message').'</div>';
        Session::forget('warning_message');
    }
?>
@yield('main_content')